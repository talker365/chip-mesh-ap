#!/bin/bash

# Enable 1019 (XIO-P6) & 1020 (XIO-P7)
echo 1019 > /sys/class/gpio/export
# Set Pin for Output
echo out > /sys/class/gpio/gpio1019/direction

echo 1020 > /sys/class/gpio/export
# Set Pin for Output
echo out > /sys/class/gpio/gpio1020/direction

while true
do
    
    echo 1 > /sys/class/gpio/gpio1019/value
    echo 0 > /sys/class/gpio/gpio1020/value
    
    sleep 1
    
    echo 0 > /sys/class/gpio/gpio1019/value
    echo 1 > /sys/class/gpio/gpio1020/value
    
    sleep 1
    
done
