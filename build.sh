#!/bin/bash
# =======================================================================================
#   This script will build all source files into two final installation files:
#
#   1.  install.sh - this computer-side file will set installation into motion
#   2.  VdnMeshChip.tar - this archive contains all remaining installation files
# =======================================================================================

# Clear the deployment folder for the new build...
rm -r deploy/*

# tar all packages...
tar -cf deploy/packages.tar VdnMeshChip/packages/*

# move packages to main tar...
tar -cf deploy/VdnMeshChip.tar deploy/packages.tar
rm deploy/packages.tar

# include installation support files in main tar...
tar -rf deploy/VdnMeshChip.tar VdnMeshChip/push.exp
tar -rf deploy/VdnMeshChip.tar VdnMeshChip/run.exp
tar -rf deploy/VdnMeshChip.tar VdnMeshChip/routine

# include install script...
cp install.sh deploy/.

