# Project Title: ADS-B (FlightRadar 24)
# Project Desc: ADS-B Project. This line is possibly for the Projects Tab, to grab a description directly from the installation script.
#!/bin/bash

clear
# Stop on first error
set -e

if [ "$(id -u)" != "0" ]; then
   echo "This script must be run as root" 1>&2
   exit 1
fi
echo "|||||||||||||||||||||||||||||||||||||||||"
echo "|||||||                          ||||||||"
echo "||||||| INSTALLING ADS-B PROJECT ||||||||"
echo "|||||||                          ||||||||"
echo "|||||||||||||||||||||||||||||||||||||||||\n"
echo -e "Performing an APT update.... "

# Update APT cache and install feeder software
apt-get update -y

echo "Installation and configuration completed!"
echo -e "\nTHIS WAS ONLY A TEST\n"