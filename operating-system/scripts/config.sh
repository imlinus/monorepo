#!/bin/sh

# Config
export CXX_SUPPORT="true"
export LINUX_HEADERS_SUPPORT="false"
export OPENMP_SUPPORT="false"
export PARALLEL_SUPPORT="false"
export PKG_CONFIG_SUPPORT="false"

# Distro
export DISTRO_NAME="lil"
export DISTRO_VERSION="0.1.0"
export DISTRO_CODENAME="wayne"

# Package versions
export SYSLINUX_VERSION="6.03"
export KERNEL_VERSION="4.18.5"
export BUSYBOX_VERSION="1.30.0"
export MUSL_VERSION="1.2.2"
export BINUTILS_VERSION="2.30"
export GCC_VERSION="7.3.0"
export GMP_VERSION="6.1.2"
export MPC_VERSION="1.1.0"
export MPFR_VERSION="4.0.1"
export ISL_VERSION="0.24"
export PKGCONF_VERSION="1.7.3"

# Download URLs
export SYSLINUX_URL="http://kernel.org/pub/linux/utils/boot/syslinux/syslinux-${SYSLINUX_VERSION}.tar.xz"
export KERNEL_URL="https://cdn.kernel.org/pub/linux/kernel/v4.x/linux-${KERNEL_VERSION}.tar.xz"
export BUSYBOX_URL="https://busybox.net/downloads/busybox-${BUSYBOX_VERSION}.tar.bz2"
export MUSL_URL="https://musl.libc.org/releases/musl-${MUSL_VERSION}.tar.gz"
export BINUTILS_URL="https://ftp.gnu.org/gnu/binutils/binutils-${BINUTILS_VERSION}.tar.gz"
export GCC_URL="https://ftp.gnu.org/gnu/gcc/gcc-${GCC_VERSION}//gcc-${GCC_VERSION}.tar.gz" # why "//" I'll never know
export GMP_URL="https://ftp.gnu.org/pub/gnu/gmp/gmp-${GMP_VERSION}.tar.xz"
export MPC_URL="https://ftp.gnu.org/gnu/mpc/mpc-${MPC_VERSION}.tar.gz"
export MPFR_URL="https://ftp.gnu.org/gnu/mpfr/mpfr-${MPFR_VERSION}.tar.xz"
export ISL_URL="http://isl.gforge.inria.fr/isl-${ISL_VERSION}.tar.xz"
export PKGCONF_URL="https://distfiles.dereferenced.org/pkgconf/pkgconf-${PKGCONF_VERSION}.tar.xz"

# Architecture
export HOST="x86_64-cross-linux-gnu"
export TARGET="x86_64-linux-musl"
export ARCH="x86"

# Folders
export BASE_DIR="$(pwd)"
export WORKSPACE_DIR="${BASE_DIR}/workspace"
export TARGETFS_DIR="${WORKSPACE_DIR}/targetfs"
export TOOLCHAIN_DIR="${WORKSPACE_DIR}/toolchain"
export SOURCE_DIR="${TOOLCHAIN_DIR}/source"
export SYSROOT="${TOOLCHAIN_DIR}/${TARGET}"

# Configs
export KERNEL_CONFIG="/config/kernel/kernel_config"
export BUSYBOX_CONFIG="/config/busybox/busybox_config"

# Compiler flags (cores & threads)
export CORES=12
export JFLAG=4

# ISO
export ISO_FILENAME="${DISTRO_NAME}-${ARCH}-${DISTRO_VERSION}.iso"

# Path
# PATH=$TOOLCHAIN_DIR/bin:/usr/bin:/bin # test this if other doesn't work :P
PATH=$TOOLCHAIN_DIR/bin:/bin:/usr/bin
