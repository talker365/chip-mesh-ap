#!/bin/bash

decode() {
    MAGIC=`head -c 4 $1`
    if [ "$MAGIC" = "CHIP" ]; then :
        VENDOR_ID=`head -c 9 $1 | hexdump -C | sed -n 1p | cut -d " " -f 8,9,10,12`
        PRODUCT_ID=`head -c 11 $1 | hexdump -C | sed -n 1p | cut -d " " -f 13,14`
        PRODUCT_V=`head -c 12 $1 | hexdump -C | sed -n 1p | cut -d " " -f 15`
        VENDOR_NAME=`head -c 44 $1 | tail -c 32`
        PRODUCT_NAME=`head -c 67 $1 | tail -c 32`
        # Add Custom Data Parsing Here.
    else
        VENDOR_ID=
        PRODUCT_ID=
        PRODUCT_V=
        VENDOR_NAME=
        PRODUCT_NAME=
    fi
}


rm /tmp/eeprom >/dev/null 2>&1
NR=1
for e in /sys/bus/w1/devices/*/eeprom; do :
    e_SHORT=`echo $e|rev|cut -d "/" -f2|rev`
    TRY=0
    ST=1
    # avoid multiple readings
    while [ $ST -ne 0 -a $TRY -lt 10 ]; do :
        dd if=$e of=/tmp/eeprom status=none
        ST=$?
        TRY=$((TRY+1))
        if [ $ST -ne 0 ]; then
            echo ""
            echo "ERROR: Reading EEPROM failed, retry $TRY"
        elif [ $TRY -gt 1 ]; then
            echo "Reading EEPROM done"
        fi
    done
    
    echo -n "EEPROM($NR) ID:$e_SHORT: "
    decode /tmp/eeprom
    if [ "$MAGIC" = "CHIP" ]; then :
        echo "VENDOR_ID:$VENDOR_ID, $VENDOR_NAME, $PRODUCT_NAME (v$PRODUCT_V)"
    else
        echo "Not a CHIP DIP EEPROM image"
    fi
    NR=$((NR+1))
done
MAX_EEPROM=$((NR-1))


