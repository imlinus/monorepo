#!/bin/sh

# ------------------------------------
# This is the build script for Lily OS 
# ------------------------------------

# 1) Prepare workspace
# 2) Build Toolchain
# 3) Setup filesystem
# 4) Compile core utilities (cp, mv, ls and so on)
# 5) Compile linux kernel
# 6) Setup bootloader (syslinux)
# 7) Build ISO

# Import scripts
. ./config.sh
. ./utilities.sh
. ./prepare-workspace.sh
. ./build-toolchain.sh
. ./build-linux.sh

clean () {
  rm -rf "${WORKSPACE_DIR}"
}

clean_source () {
  rm -rf binutils-${BINUTILS_VERSION} gcc-${GCC_VERSION} linux-${KERNEL_VERSION} musl-${MUSL_VERSION}
}

test () {
  cd ${BASEDIR}

  if [ -f ${BASEDIR}/image/${ISO_FILENAME} ]; then
    qemu-system-x86_64 -m 128M -cdrom ${BASEDIR}/image/${ISO_FILENAME} -boot d -vga std
  fi
}

help () {
  cat <<EOF
${LILY1}
${LILY2}${GREEN}--build${RESET}        Download and compile source, then create ISO
${LILY3}${GREEN}--clean${RESET}        Clean work folders
${LILY4}${GREEN}--test${RESET}         Test in Qemu
${LILY5}${GREEN}--help${RESET}         Help
${LILY6}

EOF
}

welcome () {
  cat <<EOF
${LILY1}
${LILY2}
${LILY3}  This is the build script for Lily OS
${LILY4}  
${LILY5}  It will setup the cross-compiler toolchain
${LILY6}  Download the source and build it for the selected architecture

${cpu_check}

EOF
}

# ---------
# Build all
# ---------
build_all () {
  clear
  welcome

  is_root_check
  cpu_check

  prepare_workspace
  build_toolchain
  build_linux
}

# --------
# Commands
# --------
case "$1" in
  "--prepare-workspace") prepare_workspace ;;
  "--build-toolchain") build_toolchain ;;
  "--build-linux") build_linux ;;
  "--build-all") build_all ;;
  "--clean") clean ;;
  "--help") help ;;
  "") help ;;
esac
