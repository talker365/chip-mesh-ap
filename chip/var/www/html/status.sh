#!/bin/bash

getmac() {
echo $(ifconfig $1 | grep -o -E '([[:xdigit:]]{1,2}:){5}[[:xdigit:]]{1,2}')
}

host=$(hostname | awk '{print toupper($0)}')
ssid="unknown"
ch="unknown"
if [ -f "/var/www/flags/.microrouter" ]; then
	ssid=$(cat /var/www/flags/.apSSID)
	ch=$(cat /var/www/flags/.apChannel)
fi
if [ -f "/var/www/flags/.micromesh" ]; then
	ssid=$(iwconfig wlan1 | grep ESSID | cut -d '"' -f2)
	ch=$(cat /proc/net/rtl8723bs/wlan1/rf_info | awk '/cur_ch/ { print $1}' | cut -d '=' -f2 | cut -d ',' -f1)
fi
pwr=$(iwconfig wlan1 | grep Tx-Power | cut -d '=' -f2)
flash=$(df -h | grep rootfs | awk {'print $4'})
#memfree=$(cat /proc/meminfo | awk '/MemFree:/ {print $2,$3}')
memfree=$(( $(cat /proc/meminfo | awk '/MemFree:/ {print $2}') / 1024 ))
memtotal=$(( $(cat /proc/meminfo | awk '/MemTotal:/ {print $2}') / 1024))
memavail=$(( $(cat /proc/meminfo | awk '/MemAvailable:/ {print $2}') / 1024))
memused=$((${memtotal} - ${memavail}))
adapter=($(ifconfig -s | tail -n +2 | awk '{ print $1 }'))
up=$(/usr/bin/uptime | grep up | cut -d "," -f1)
clear
#echo -e "Hostname:$host<br />"

echo -e "<table data-role=\"table\" data-mode=\"columntoggle:none\" class=\"ui-responsive\" id=\"statusTable\">"
echo -e "  <thead style=\"display:none;\">"
echo -e "    <tr>"
echo -e "      <th>column1</th>"
echo -e "      <th data-priority=\"1\">column2</th>"
echo -e "    </tr>"
echo -e "  </thead>"
echo -e "  <tbody>"
echo -e "    <tr>"
echo -e "      <td>"
echo -e "         <table>"
echo -e "           <tr><td>SSID:</td><td>$ssid</td></tr>"
echo -e "    	    <tr><td>Channel:</td><td>$ch</td></tr>"
echo -e "    	    <tr><td>Power:</td><td>$pwr</td></tr>"
if [ -f "/var/www/flags/.microrouter" ]; then
	[ -f "/var/www/flags/.eth" ] && echo -e "<tr><td>Gateway:</td><td>ETH</td></tr>"
	[ -f "/var/www/flags/.wlan" ] && echo -e "<tr><td>Gateway:</td><td>WLAN</td></tr>"
fi
if [ -f "/var/www/flags/.micromesh" ]; then
	[ -f "/var/www/flags/.lan" ] && echo -e "<tr><td>Ethernet:</td><td>LAN</td></tr>"
	[ -f "/var/www/flags/.wan" ] && echo -e "<tr><td>Ethernet:</td><td>WAN</td></tr>"
fi
echo -e "         </table>"
echo -e "      </td>"
echo -e "      <td>"
echo -e "         <table>"
echo -e "           <tr><th>&nbsp;</th><th>Total</th><th>Used</th><th>Free</th></tr>"
echo -e "           <tr><td>NAND:</td>$(df -h | grep rootfs | awk {'print "<td>"$2,"</td><td>"$3,"("$5")</td><td>"$4"</td>"'})"
echo -e "    	    <tr><td>Memory:</td><td>$memtotal M</td><td>$memused M</td><td>$memfree M</td></tr>"
echo -e "         </table>"
echo -e "      </td>"
echo -e "    </tr>"
echo -e "  <tbody>"
echo -e "</table>"





#===================================
# Interfaces Table
#===================================
echo -e "<p style=\"font-weight:bold;padding-bottom:0px;margin-bottom:0px;\">Interfaces:</p>"
echo -e "<table  data-role=\"table\" data-mode=\"columntoggle:none\" class=\"ui-responsive ui-shadow\" id=\"interfacesTable\">"
echo -e "<thead><tr><th data-priority=\"1\">Interface</th>"
echo -e "<th data-priority= \"2\">IP Address</th>"
echo -e "<th data-priority=\"4\">MAC Address</th>"
echo -e "<th data-priority=\"3\">Status</th></tr></thead><tbody>"
for i in "${adapter[@]}"
do
  status=$(ifconfig $i | grep UP | awk '{ print $1 }' )
  if [ "$status" == "UP" ]; then ip=$(ifconfig $i 2>/dev/null|awk '/inet addr:/ {print $2}'|sed 's/addr://'); enabled=$(ifconfig $i | grep MULTICAST | awk '{print $3}');
  if [ "$i" == "usb0" ] || [ "$i" == "eth0" ]; then echo -en " <br />"; fi; 
  if [ "$i" != "lo" ]; then echo -en "  <tr><td>$i</td><td>$ip</td><td>$(getmac $i)</td> "
  if [[ "$enabled" == "RUNNING" ]]; then echo -e "<td>$enabled</td>"; else echo -e "<td>DOWN</td></tr>"; fi; fi; fi
done
echo -e "</tbody></table>"

