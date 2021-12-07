#!/bin/sh

# Distro
export DISTRO_NAME="Lily OS"
export DISTRO_PATHNAME="lily-os"
export DISTRO_VERSION="0.1.0"
export DISTRO_CODENAME="wayne"

# Package versions
export CROSS_MAKE_VERSION="0.9.9"
export SYSLINUX_VERSION="6.03"
export TOYBOX_VERSION="0.8.6"
export KERNEL_VERSION="5.15.6"

# Download URLs
export SYSLINUX_URL="http://kernel.org/pub/linux/utils/boot/syslinux/syslinux-${SYSLINUX_VERSION}.tar.xz"
export KERNEL_URL="https://cdn.kernel.org/pub/linux/kernel/v5.x/linux-${KERNEL_VERSION}.tar.xz"
export TOYBOX_URL="https://github.com/landley/toybox/archive/$TOYBOX_VERSION.tar.gz"

export MUSL_CROSS_MAKE_URL="https://github.com/richfelker/musl-cross-make/archive/v$CROSS_MAKE_VERSION.tar.gz"
export X86_64_MUSL_CROSS_URL="https://musl.cc/x86_64-linux-musl-cross.tgz"

# Folders
export BASE_DIR="$(pwd)"
export WORKSPACE_DIR="${BASE_DIR}/workspace"
export DOWNLOADS_DIR="${WORKSPACE_DIR}/downloads"
export TOOLCHAIN_DIR="${WORKSPACE_DIR}/toolchain"
export DIST_DIR="${WORKSPACE_DIR}/dist"

# Configs
export KERNEL_CONFIG="${BASE_DIR}/config/kernel_config"
export TOYBOX_CONFIG="${BASE_DIR}/config/toybox_config"

# Architecture
export HOST="x86_64-cross-linux-gnu"
export TARGET="x86_64-linux-musl"
export ARCH="x86_64"

# Cores / Threads
export CORES=$(nproc)
export JFLAG=4

# Filename
export FILENAME="${DISTRO_PATHNAME}-${ARCH}-${DISTRO_VERSION}.iso"

# ------
# Colors
# ------
if [ -x "$(command -v tput)" ]; then
	export BOLD="$(tput bold)"
	export GREEN="$(tput setaf 2)"
	export MAGENTA="$(tput setaf 5)"
	export RED="$(tput setaf 1)"
	export YELLOW="$(tput setaf 3)"
	export WHITE="$(tput setaf 7)"
	export RESET="$(tput sgr0)"
fi

# ----
# Logo
# ----
export LILY1="${MAGENTA}${BOLD}     _      ${RESET}"
export LILY2="${MAGENTA}${BOLD}   _(_)_    ${RESET}"
export LILY3="${MAGENTA}${BOLD}  (_)${WHITE}•${MAGENTA}${BOLD}(_)   ${RESET}"
export LILY4="${GREEN}${BOLD}   /${RESET}${MAGENTA}${BOLD}(_)     ${RESET}"
export LILY5="${GREEN}${BOLD}   \        ${RESET}"
export LILY6="${GREEN}${BOLD}    \       ${RESET}"

# ---------
# Utilities
# ---------
is_root_check () {
  if [ $(id -u) != 0 ]; then
    echo "${WARNING}Sorry, must be root to run this script${RESET}"
    exit 1
  fi
}

cpu_check () {
  if [ $CORES -lt 8 ]; then
    echo "${WARNING}${CORES} CPU cores, expect a long build time${RESET}"
    sleep 1
  fi
}

log () {
  echo "=>$GREEN $1 $RESET"
  echo ""
}
