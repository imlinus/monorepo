#!/bin/sh

BASE_DIR="$(pwd)"
DOWNLOADS_DIR="downloads"
DIST_DIR="dist"

CROSS_MAKE_VERSION="0.9.9"
SYSLINUX_VERSION="6.03"
TOYBOX_VERSION="0.8.4"
KERNEL_VERSION="5.9.11"

download_dependencies () {
  echo "Downloading dependencies"

  cd $BASE_DIR

  mkdir -p $BASE_DIR/$DOWNLOADS_DIR
  cd $BASE_DIR/$DOWNLOADS_DIR

  if [ ! -d x86_64-linux-musl-cross ]; then wget https://musl.cc/x86_64-linux-musl-cross.tgz -O - | tar -xz; fi
  if [ ! -d musl-cross-make-$CROSS_MAKE_VERSION ]; then wget https://github.com/richfelker/musl-cross-make/archive/v$CROSS_MAKE_VERSION.tar.gz -O - | tar -xz; fi
  if [ ! -d syslinux-$SYSLINUX_VERSION ]; then http://kernel.org/pub/linux/utils/boot/syslinux/syslinux-$SYSLINUX_VERSION.tar.xz -O - | tar -xJ; fi
  if [ ! -d toybox-$TOYBOX_VERSION ]; then wget https://github.com/landley/toybox/archive/$TOYBOX_VERSION.tar.gz -O - | tar -xz; fi
  if [ ! -d linux-$KERNEL_VERSION ]; then wget https://cdn.kernel.org/pub/linux/kernel/v5.x/linux-$KERNEL_VERSION.tar.xz -O - | tar -xJ; fi

  cd $BASE_DIR
}

build_toolchain () {
  if [ ! -d $BASE_DIR/$DOWNLOADS_DIR/x86_64-linux-musl-cross/bin ]; then
    echo "Toolchain already exists. Skipping.."
  else
    echo "Building toolchain"

    cd $BASE_DIR/$DOWNLOADS_DIR/musl-cross-make-$CROSS_MAKE_VERSION
    
    mv config.mak.dist config.mak
    echo 'TARGET = x86_64-linux-musl' >> config.mak
    
    make -j$(nproc)

    cd $BASE_DIR
  fi
}

build_toybox () {
  if [ ! -d $BASE_DIR/$DIST_DIR/toybox ]; then
    echo "Toybox already exists. Skipping.."
  else
    cd $BASE_DIR

    mkdir -p $BASE_DIR/$DIST_DIR
    cd $BASE_DIR/$DOWNLOADS_DIR/toybox-$TOYBOX_VERSION

    make clean
    make defconfig

    # Build static toybox with musl-cross-make gcc toolchain
    LDFLAGS="--static" CROSS_COMPILE=$BASE_DIR/$DOWNLOADS_DIR/x86_64-linux-musl-cross/bin/x86_64-linux-musl- make toy
    mv toybox $BASE_DIR/$DIST_DIR/
    exit

    # Build static with clang using musl-cross-make as sysroot
    CFLAGS="\
      -target x86_64-pc-linux-musl \
      --sysroot $BASE_DIR/downloads/x86_64-linux-musl-cross" \
    LDFLAGS="\
      -static" \
    CC=clang make toybox

    cd $BASE_DIR
  fi
}

build_root () {
  cd $BASE_DIR
  # mkdir -p ../built
  cd $BASE_DIR/$DOWNLOADS_DIR

  PATH=$(realpath .)/x86_64-linux-musl-cross/bin:$PATH
  cd toybox-$TOYBOX_VERSION
  echo $PATH

  make root CROSS_COMPILE=x86_64-linux-musl- LINUX=$BASE_DIR/$DOWNLOADS_DIR/linux-5.9.11

  # rm -r ../../built/root
  mv root $BASE_DIR/$DIST_DIR

  cd $BASE_DIR
}

build () {
  echo "hi"

  download_dependencies
  build_toolchain
  build_toybox
  build_root

  echo "done"
}
