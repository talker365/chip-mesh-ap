
#!/bin/bash
#PROJECT ADS-B 

# Stop on first error
set -e

if [ "$(id -u)" != "0" ]; then
   echo "This script must be run as root" 1>&2
   exit 1
fi

echo "Performing an APT update.... "
# Update APT cache and install feeder software
apt-get update -y

echo "Installation and configuration completed!"
echo -e "/nTHIS IS ONLY A TEST"