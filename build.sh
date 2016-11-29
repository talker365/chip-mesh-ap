#!/bin/bash
# =======================================================================================
#   This script will build all source files into two final installation files:
#
#   1.  install.sh - this computer-side file will set installation into motion
#   2.  VdnMeshChip.tar - this archive contains all remaining installation files
# =======================================================================================

# Capture current path...
orig=`pwd`

# Clear the deployment folder for the new build...
rm -r $orig/deploy/*

cd $orig/VdnMeshChip/packages

# tar all packages...
tar -cf $orig/deploy/packages.tar *

# move packages to main tar...
cd $orig/deploy
tar -cf VdnMeshChip.tar packages.tar
rm packages.tar

# include installation support files in main tar...
cd $orig/VdnMeshChip
tar -rf $orig/deploy/VdnMeshChip.tar push.exp
tar -rf $orig/deploy/VdnMeshChip.tar run.exp
tar -rf $orig/deploy/VdnMeshChip.tar routine

# include install script...
cp $orig/install.sh $orig/deploy/.

cd $orig

