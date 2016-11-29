#!/bin/bash

# This is the VDN Chip Mesh Firmware installation process.  This script will untar
# the package files from VdnMeshChip.tar and move them to the chip.  After moving
# the files, the installation routine will be started remotely on the chip.

# Capture current path...
orig=`pwd`

# Create temporary directory for installation files...
mkdir /tmp/chip.install

# Untar installation files...
cp VdnMeshChip.tar /tmp/chip.install/.
cd /tmp/chip.install
tar -xf VdnMeshChip.tar

# Create remote directory for installation files...
expect run.exp "mkdir /tmp/vdn" root chip.local chip

# Push files to CHIP...
expect push.exp packages.tar /tmp/vdn/. root chip.local chip
expect push.exp web.tar /tmp/vdn/. root chip.local chip
expect push.exp routine /tmp/vdn/. root chip.local chip

# Begin installation on the CHIP...
expect run.exp "bash /tmp/vdn/routine" root chip.local chip

# Return to original directory...
cd $orig

# Clean up temporary installation directory...
rm -r /tmp/chip.install


