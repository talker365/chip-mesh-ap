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
b="\033[5m"
r="\033[31m"
g="\033[32m"
n="\033[0m"

echo -e "|||||||||||||||||||||||||||||||||||||||||"
echo -e "|||||||                          ||||||||"
echo -e "||||||| ${b}${r}INSTALLING${n} ${g}ADS-B PROJECT${n} ||||||||"
echo -e "|||||||                          ||||||||"
echo -e "|||||||||||||||||||||||||||||||||||||||||\n"

# Import GPG key for the APT repository
gpg --keyserver pgp.mit.edu --recv-keys 40C430F5
gpg --armor --export 40C430F5 | apt-key add -

# Add APT repository to the config file, removing older entries if exist
mv /etc/apt/sources.list /etc/apt/sources.list.bak
grep -v flightradar24 /etc/apt/sources.list.bak > /etc/apt/sources.list || echo OK
echo 'deb http://repo.feed.flightradar24.com flightradar24 raspberrypi-stable' >> /etc/apt/sources.list

echo -e "\nPerforming an APT update.... "

# Update APT cache and install feeder software
apt-get update -y
apt-get install fr24feed -y

# Stop older instances if exists
service fr24feed stop || echo OK

# Run the signup wizard
############################### Create a web based method of prompting for values vs running binary utility
### fr24feed --signup
### chmod a+rw /etc/fr24feed.ini

#### fr24feed.ini file contents.
<<fr24feed_ini_file
receiver="dvbt"
fr24key="cbcb783b796010e1"
path="/usr/lib/fr24/dump1090"
bs="yes"
raw="yes"
logmode="1"
procargs="--interactive --net --net-http-port 9100"
mlat="yes"
mlat-without-gps="yes"
fr24feed_ini_file


# Restart the feeder software
### service fr24feed restart

echo "Installation and configuration completed!"
echo -e "\nTHIS WAS ONLY A TEST\n"