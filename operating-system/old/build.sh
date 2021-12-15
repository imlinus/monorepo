#!/bin/sh

. ./config.sh
. ./build-toolchain.sh
. ./build-linux.sh

# ----
# Help
# ----
help () {
  cat <<EOF
${LILY1}
${LILY2} ${GREEN}--build-all${RESET}
${LILY3} ${GREEN}--build-toolchain${RESET}
${LILY4} ${GREEN}--build-linux${RESET}
${LILY5} ${GREEN}--build-iso${RESET}
${LILY6} ${GREEN}--test${RESET}

EOF
}

# -------
# Welcome
# -------
welcome () {
  cat <<EOF
${LILY1}
${LILY2}  This is the build script for Lily OS
${LILY3}
${LILY4}  It will setup the cross-compiler toolchain
${LILY5}  Download the source and compile it for the x86_64 arch
${LILY6}

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

  welcome

  build_toolchain
  build_linux
}

# ----------------
# Initial commands
# ----------------
case "$1" in
  "--build-all") build_all ;;
  "--build-toolchain") build_toolchain ;;
  "--build-linux") build_linux ;;
  "--help") help ;;
  "") help ;;
esac
