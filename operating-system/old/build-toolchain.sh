#!/bin/sh

. ./config.sh

prepare_folders () {
  cd $BASE_DIR || exit

  if [ ! -d $WORKSPACE_DIR ]; then
    log "Creating $WORKSPACE_DIR folder"
    mkdir --parents $WORKSPACE_DIR
  fi

  if [ ! -d $DOWNLOADS_DIR ]; then
    log "Creating $DOWNLOADS_DIR folder"
    mkdir --parents $DOWNLOADS_DIR
  fi
}

download_toolchain_dependencies () {
  cd $DOWNLOADS_DIR || exit

  # Download Musl Cross Make
  if [ -f $DOWNLOADS_DIR/v$CROSS_MAKE_VERSION.tar.gz ]; then
    log "v$CROSS_MAKE_VERSION.tar.gz already exists. Skipping.."
  else
    log "Downloading v$CROSS_MAKE_VERSION.tar.gz"
    wget $MUSL_CROSS_MAKE_URL -q --show-progress --progress=bar:force 2>&1
  fi

  # Download x86_64 Musl Cross
  if [ -f $DOWNLOADS_DIR/x86_64-linux-musl-cross.tgz ]; then
    log "x86_64-linux-musl-cross.tgz already exists. Skipping.."
  else
    log "Downloading x86_64-linux-musl-cross.tgz"
    wget $X86_64_MUSL_CROSS_URL -q --show-progress --progress=bar:force 2>&1
  fi

  cd $WORKSPACE_DIR || exit
}

extract_toolchain_dependencies () {
  cd $DOWNLOADS_DIR || exit

  # Extract Musl Cross Make
  if [ -d $DOWNLOADS_DIR/musl-cross-make-$CROSS_MAKE_VERSION ]; then
    log "/musl-cross-make-$CROSS_MAKE_VERSION already exists. Skipping.."
  else
    log "Extracting v$CROSS_MAKE_VERSION.tar.gz"
    tar -xf v$CROSS_MAKE_VERSION.tar.gz --checkpoint=.100
  fi

  # Extract Musl Cross Make
  if [ -d $DOWNLOADS_DIR/x86_64-linux-musl-cross ]; then
    log "/x86_64-linux-musl-cross already exists. Skipping.."
  else
    log "Extracting x86_64-linux-musl-cross.tgz"
    tar -xf x86_64-linux-musl-cross.tgz --checkpoint=.100
  fi

  cd $WORKSPACE_DIR || exit
}

build_cross_compiler () {
  cd $WORKSPACE_DIR || exit

  log "Building toolchain"

  cd $DOWNLOADS_DIR/musl-cross-make-$CROSS_MAKE_VERSION || exit

  mv config.mak.dist config.mak
  echo 'TARGET = x86_64-linux-musl' >> config.mak

  make -j$CORES

  cd $WORKSPACE_DIR || exit
}

build_toolchain () {
  is_root_check
  cpu_check

  prepare_folders

  download_toolchain_dependencies
  extract_toolchain_dependencies

  build_cross_compiler
}
