#!/bin/sh

# Folders
export BASE_DIR="$(pwd)"

export WORKSPACE_DIR="${BASE_DIR}/workspace"
export DOWNLOADS_DIR="${WORKSPACE_DIR}/downloads"
export DIST_DIR="${WORKSPACE_DIR}/dist"

setup_folders () {
  # Create workspace folders
  if [ ! -d $WORKSPACE_DIR ]; then
    mkdir --parents $WORKSPACE_DIR || exit
    mkdir --parents $DOWNLOADS_DIR || exit
    mkdir --parents $DIST_DIR || exit

    mkdir --parents $WORKSPACE_DIR/iso || exit
    mkdir --parents $WORKSPACE_DIR/iso/boot || exit
  fi
}

build_linux () {
  # Download linux
  cd $DOWNLOADS_DIR || exit

  if [ ! -d "linux" ]; then
    echo "Cloning Linux"
    git clone https://git.kernel.org/pub/scm/linux/kernel/git/torvalds/linux.git
  fi
  
  cd linux || exit

  # Compile
  make x86_64_defconfig
  make -j $(nproc)

  # Copy bzImage to our dist folder
  cd ..
  cp linux/arch/x86/boot/bzImage $WORKSPACE_DIR/iso/boot/
}

build_init () {
  cd $BASE_DIR/init || exit

  make

  cd $BASE_DIR || exit
}

build_filesystem () {
  cd $BASE_DIR/init/ || exit

  mkdir fs
  cd fs
  mkdir dev proc sys

  cp ../init .

  find . | cpio -o -H newc | gzip > ../init.cpio.gz

  cd ..

  # Copy init.cpio.gz to our workspace
  cp init/init.cpio.gz workspace/iso/boot/

  cd $BASE_DIR || exit
}

copy_grub () {
  cd $BASE_DIR || exit
  echo "Copying GRUG config"
  cp $BASE_DIR/grub $WORKSPACE_DIR/iso/boot/
}

build_iso () {
  grub-mkrescue -o workspace/dist/lily-os.iso workspace/iso
}

build () {
  setup_folders
  build_linux
  build_init
  build_filesystem
  copy_grub
  build_iso
}

echo "Build"
build

# echo "\n\nCopying kernel and CPIO"
# cp $DIST_DIR/linux/bzImage $DIST_DIR/fs/init.cpio.gz $DIST_DIR/iso/boot/

# echo "\n\nCreating ISO"
# grub-mkrescue -o builds/lily-os.iso builds/iso
