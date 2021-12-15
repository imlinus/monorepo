#!/bin/sh

# Distro
export DISTRO_NAME="Lily OS"
export DISTRO_PATHNAME="lily-os"
export DISTRO_VERSION="0.1.6"

# Package versions
export CROSS_MAKE_VERSION="0.9.9"
export SYSLINUX_VERSION="6.03"
export TOYBOX_VERSION="0.8.6"
export KERNEL_VERSION="5.15.6"

# Download URLs
export MUSL_CROSS_MAKE_URL="https://github.com/richfelker/musl-cross-make/archive/v$CROSS_MAKE_VERSION.tar.gz"
export X86_64_MUSL_CROSS_URL="https://musl.cc/x86_64-linux-musl-cross.tgz"

export SYSLINUX_URL="http://kernel.org/pub/linux/utils/boot/syslinux/syslinux-$SYSLINUX_VERSION.tar.xz"
export KERNEL_URL="https://cdn.kernel.org/pub/linux/kernel/v5.x/linux-$KERNEL_VERSION.tar.xz"
export TOYBOX_URL="https://github.com/landley/toybox/archive/$TOYBOX_VERSION.tar.gz"

# Folders
export BASE_DIR="$(pwd)"
export WORKSPACE_DIR="$BASE_DIR/workspace"
export DOWNLOADS_DIR="$WORKSPACE_DIR/downloads"
export DIST_DIR="$WORKSPACE_DIR/dist"

# Architecture
export HOST="x86_64-cross-linux-gnu"
export TARGET="x86_64-linux-musl"
export ARCH="x86_64"

# Cores / Threads
export CORES=$(nproc)
export JFLAG=4

# Filename
export FILENAME="$DISTRO_PATHNAME-$ARCH-$DISTRO_VERSION.iso"

setup_folders () {
  mkdir --parents $DOWNLOADS_DIR || exit
  mkdir --parents $DIST_DIR || exit
  mkdir --parents $WORKSPACE_DIR/iso/boot/grub || exit
}

setup_toolchain () {
  cd $DOWNLOADS_DIR || exit

  wget $MUSL_CROSS_MAKE_URL -q --show-progress --progress=bar:force 2>&1
  wget $X86_64_MUSL_CROSS_URL -q --show-progress --progress=bar:force 2>&1

  tar -xf v$CROSS_MAKE_VERSION.tar.gz --checkpoint=.100
  tar -xf x86_64-linux-musl-cross.tgz --checkpoint=.100

  # Setup toolchain
  cd $DOWNLOADS_DIR/musl-cross-make-$CROSS_MAKE_VERSION || exit

  mv config.mak.dist config.mak
  echo 'TARGET = x86_64-linux-musl' >> config.mak

  make -j$CORES
}

download_dependencies () {
  cd $DOWNLOADS_DIR || exit

  wget $KERNEL_URL -q --show-progress --progress=bar:force 2>&1
  wget $TOYBOX_URL -q --show-progress --progress=bar:force 2>&1
  wget $SYSLINUX_URL -q --show-progress --progress=bar:force 2>&1

  tar -xf linux-$KERNEL_VERSION.tar.xz --checkpoint=.100
  tar -xf $TOYBOX_VERSION.tar.gz --checkpoint=.100
  tar -xf syslinux-$SYSLINUX_VERSION.tar.xz --checkpoint=.100
}

compile_toybox () {
  cd $DOWNLOADS_DIR/toybox-$TOYBOX_VERSION || exit

  make clean
  make defconfig

  # Build static toybox with musl-cross-make gcc toolchain
  LDFLAGS="--static" CROSS_COMPILE=../x86_64-linux-musl-cross/bin/x86_64-linux-musl- make toybox
  mv toybox $DIST_DIR
  exit

  # Build static with clang using musl-cross-make as sysroot
  CFLAGS="-target x86_64-pc-linux-musl --sysroot ../x86_64-linux-musl-cross" LDFLAGS="-static" CC=clang make toybox
}

compile_kernel () {
  cd $DOWNLOADS_DIR || exit

  export PATH=$(realpath .)/x86_64-linux-musl-cross/bin:$PATH

  cd toybox-$TOYBOX_VERSION
  echo $PATH

  make root CROSS_COMPILE=x86_64-linux-musl- LINUX=$DOWNLOADS_DIR/linux-$KERNEL_VERSION

  mv root/$ARCH/bzImage $DIST_DIR/bzImage
  mv root/$ARCH/x86_64-linux-musl-root.cpio.gz $DIST_DIR/init.cpio.gz
}

build () {
  echo "gogogo"

  setup_folders
  setup_toolchain

  download_dependencies
  compile_toybox
  compile_kernel
}

build
