#!/bin/bash
host=$(hostname | awk '{print toupper($0)}')
ssid=$(iwconfig wlan1 | grep ESSID | cut -d '"' -f2)
ch=$(cat /proc/net/rtl8723bs/wlan1/rf_info | awk '/cur_ch/ { print $1}' | cut -d '=' -f2 | cut -d ',' -f1)
pwr=""
flash=$(df -h | grep rootfs | awk {'print $4'})
memfree=$(cat /proc/meminfo | awk '/MemFree:/ {print $2,$3}')
adapter=($(ifconfig -s | tail -n +2 | awk '{ print $1 }'))
up=$(/usr/bin/uptime | grep up | cut -d "," -f1)
clear
echo -e "Hostname:$host<br />"
echo -e "SSID: $ssid  CH:$ch @ $pwr <br />"
echo -e "<h3>Interfaces:</h3>"
echo -e "<table  data-role="table" data-mode="columntoggle:none" class="ui-responsive ui-shadow" id="interfacesTable">"
echo -e "<thead><tr><th data-priority=\"1\">Interface</th>"
echo -e "<th data-priority= \"2\">IP Address</th>"
echo -e "<th data-priority=\"4\">MAC Address</th>"
echo -e "<th data-priority=\"3\">Status</th></tr></thead><tbody>"
for i in "${adapter[@]}"
do
  status=$(ifconfig $i | grep UP | awk '{ print $1 }' )
  if [ "$status" == "UP" ]; then ip=$(ifconfig $i 2>/dev/null|awk '/inet addr:/ {print $2}'|sed 's/addr://'); enabled=$(ifconfig $i | grep MULTICAST | awk '{print $3}');
  if [ "$i" == "usb0" ] || [ "$i" == "eth0" ]; then echo -en " <br />"; fi; 
  if [ "$i" != "lo" ]; then echo -en "  <tr><td>$i</td><td>$ip</td><td>tbd</td> "
  if [[ "$enabled" == "RUNNING" ]]; then echo -e "<td>$enabled</td>"; else echo -e "<td>DOWN</td></tr>"; fi; fi; fi
done
echo -e "</tbody></table>"
echo -en "<br />"
echo -e "<h3> Free Resources: </h3>"
echo -e "NAND:$flash Memory: $memfree <br />"
echo -e "Time:$up <br />"
echo -e "------------------------------------ <br />"
