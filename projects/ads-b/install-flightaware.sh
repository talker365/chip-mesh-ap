#!/bin/bash

# Project Title: ADS-B (FlightAware)

#####  ********* Remember to change path to repository. ************
# Call the Installer by: bash -c "$(wget -O - https://github.com/talker365/chip-mesh-ap/raw/master/projects/install-flightaware.sh)"
#####

title="FlightAware"

#Colors
b="\033[5m"
r="\033[31m"
g="\033[32m"
n="\033[0m"

clear
# Stop on first error
set -e

if [ "$(id -u)" != "0" ]; then
   echo "This script must be run as root" 1>&2
   exit 1
fi

echo -e "|||||||||||||||||||||||||||||||||||||||||"
echo -e "|||||||                          ||||||||"
echo -e "||||||| ${b}${r}INSTALLING${n} ${g}$title${n} ||||||||"
echo -e "|||||||                          ||||||||"
echo -e "|||||||||||||||||||||||||||||||||||||||||\n"

wget http://flightaware.com/adsb/piaware/files/packages/pool/piaware/p/piaware-support/piaware-repository_3.5.0_all.deb
sudo dpkg -i piaware-repository_3.5.0_all.deb

# Update APT cache and install feeder software
echo -e "\n${g}Performing an APT update.... ${n}"
sudo apt-get update -y

mkdir /var/www/html/backup
cp /var/www/html/* /var/www/html/backup

echo -e "\n${g}Installing $title ${n}\n"
sudo apt-get install piaware
sudo piaware-config allow-auto-updates yes
sudo piaware-config allow-manual-updates yes
sudo apt-get install dump1090-fa

echo -e "${g}Installation and configuration completed!${n}"
echo -e "\nTHIS WAS ONLY A TEST\n"