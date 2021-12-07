#!/bin/sh

# . ./config.sh

prepare_folders () {
  cd $BASE_DIR || exit

  if [ ! -d $WORKSPACE_DIR ]; then
    log "Creating $WORKSPACE_DIR folder"
    mkdir --parents $WORKSPACE_DIR || exit
  fi

  if [ ! -d $DOWNLOADS_DIR ]; then
    log "Creating $DOWNLOADS_DIR folder"
    mkdir --parents $DOWNLOADS_DIR || exit
  fi

  if [ ! -d $DIST_DIR ]; then
    log "Creating $DIST_DIR folder"
    mkdir --parents $DIST_DIR || exit
  fi
}

download_dependencies () {
  cd $DOWNLOADS_DIR || exit

  # Download Syslinux
  if [ -f $DOWNLOADS_DIR/syslinux-$SYSLINUX_VERSION.tar.xz ]; then
    log "syslinux-$SYSLINUX_VERSION.tar.xz already exists. Skipping.."
  else
    log "Downloading syslinux-$SYSLINUX_VERSION.tar.xz"
    wget $SYSLINUX_URL -q --show-progress --progress=bar:force 2>&1
  fi

  # Download Toybox
  if [ -f $DOWNLOADS_DIR/$TOYBOX_VERSION.tar.gz ]; then
    log "toybox-$TOYBOX_VERSION.tar.gz already exists. Skipping.."
  else
    log "Downloading toybox-$TOYBOX_VERSION.tar.gz"
    wget $TOYBOX_URL -q --show-progress --progress=bar:force 2>&1
  fi

  # Download Linux Kernel
  if [ -f $DOWNLOADS_DIR/linux-${KERNEL_VERSION}.tar.xz ]; then
    log "linux-${KERNEL_VERSION}.tar.xz already exists. Skipping.."
  else
    log "Downloading linux-${KERNEL_VERSION}.tar.xz"
    wget $KERNEL_URL -q --show-progress --progress=bar:force 2>&1
  fi

  cd $WORKSPACE_DIR || exit
}

extract_dependencies () {
  cd $DOWNLOADS_DIR || exit

  # Extract Syslinux
  if [ -d $DOWNLOADS_DIR/syslinux-$SYSLINUX_VERSION ]; then
    log "/syslinux-$SYSLINUX_VERSION already exists. Skipping.."
  else
    log "Extracting syslinux-$SYSLINUX_VERSION.tar.xz"
    tar -xf syslinux-$SYSLINUX_VERSION.tar.xz --checkpoint=.100
  fi

  # Extract Toybox
  if [ -d $DOWNLOADS_DIR/toybox-$TOYBOX_VERSION ]; then
    log "/toybox-$TOYBOX_VERSION already exists. Skipping.."
  else
    log "Extracting $TOYBOX_VERSION.tar.gz"
    tar -xf $TOYBOX_VERSION.tar.gz --checkpoint=.100
  fi

  # Extract Linux Kernel
  if [ -d $DOWNLOADS_DIR/linux-$KERNEL_VERSION ]; then
    log "/linux-$KERNEL_VERSION already exists. Skipping.."
  else
    log "Extracting linux-${KERNEL_VERSION}.tar.xz"
    tar -xf linux-${KERNEL_VERSION}.tar.xz --checkpoint=.100
  fi

  cd $WORKSPACE_DIR || exit
}

build_toybox () {
  cd $WORKSPACE_DIR || exit

  if [ ! -d $DIST_DIR/toybox ]; then
    echo "Toybox already exists. Skipping.."
  else
    cd $DOWNLOADS_DIR/toybox-$TOYBOX_VERSION || exit

    make clean
    make defconfig

    # Build static toybox with musl-cross-make gcc toolchain
    LDFLAGS="--static" CROSS_COMPILE=$DOWNLOADS_DIR/x86_64-linux-musl-cross/bin/x86_64-linux-musl- make toy
    mv toybox $DIST_DIR
    exit

    # Build static with clang using musl-cross-make as sysroot
    CFLAGS="\
      -target x86_64-pc-linux-musl \
      --sysroot $DOWNLOADS_DIR/x86_64-linux-musl-cross" \
    LDFLAGS="\
      -static" \
    CC=clang make toybox

    cd $WORKSPACE_DIR || exit
  fi
}

build_root () {
  cd $DOWNLOADS_DIR || exit

  export PATH=$(realpath .)/x86_64-linux-musl-cross/bin:$PATH

  cd toybox-$TOYBOX_VERSION
  log $PATH
  echo $PATH

  make root CROSS_COMPILE=x86_64-linux-musl- LINUX=$DOWNLOADS_DIR/linux-$KERNEL_VERSION

  setup_grub

  mv root/$ARCH/bzImage $DIST_DIR/bzImage

  # Jag tror jag borde bygga om denna med /fs mappen och egen init (från mini linux)
  # mv root/$ARCH/x86_64-linux-musl-root.cpio.gz $DIST_DIR/init.cpio.gz

  cd $WORKSPACE_DIR || exit
}

setup_grub () {
  mkdir $DIST_DIR/boot
  mkdir $DIST_DIR/boot/grub

  cat << EOF > boot/grub/grub.cfg
menuentry "Lily OS" {
  linux /boot/bzImage quiet 
  initrd /boot/init.cpio.gz
}
EOF
}

build_linux () {
  is_root_check
  cpu_check

  prepare_folders

  # download_dependencies
  # extract_dependencies

  # build_toybox
  # build_root
}
