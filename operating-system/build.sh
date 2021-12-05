#!/bin/sh

export BASE_DIR="$(pwd)"

export RED="$(tput setaf 1)"
export GREEN="$(tput setaf 2)"
export RESET="$(tput sgr0)"

download_dependencies () {
  echo "Downloading dependencies"

  cd $BASE_DIR

  mkdir -p $BASE_DIR/downloads
  cd $BASE_DIR/downloads

  if [ ! -d x86_64-linux-musl-cross ]; then
    wget https://musl.cc/x86_64-linux-musl-cross.tgz -O - | tar -xz;
  fi

  if [ ! -d toybox-0.8.4 ]; then
    wget https://github.com/landley/toybox/archive/0.8.4.tar.gz -O - | tar -xz;
  fi

  if [ ! -d linux-5.9.11 ]; then
    wget https://cdn.kernel.org/pub/linux/kernel/v5.x/linux-5.9.11.tar.xz -O - | tar -xJ;
  fi

  if [ ! -d musl-cross-make-0.9.9 ]; then
    wget https://github.com/richfelker/musl-cross-make/archive/v0.9.9.tar.gz -O - | tar -xz;
  fi

  cd $BASE_DIR
}

build_toolchain () {
  if [ ! -d $BASE_DIR/downloads/x86_64-linux-musl-cross/bin ]; then
    echo "Toolchain already exists. Skipping.."
  else
    echo "Building toolchain"

    cd $BASE_DIR/downloads/musl-cross-make-0.9.9
    
    mv config.mak.dist config.mak
    echo 'TARGET = x86_64-linux-musl' >> config.mak
    
    make -j$(nproc)

    cd $BASE_DIR
  fi
}

build_toybox () {
  if [ ! -d $BASE_DIR/dist/toybox ]; then
    echo "Toybox already exists. Skipping.."
  else
    cd $BASE_DIR

    mkdir -p $BASE_DIR/dist
    cd $BASE_DIR/downloads/toybox-0.8.4

    make clean
    make defconfig

    # Build static toybox with musl-cross-make gcc toolchain
    LDFLAGS="--static" CROSS_COMPILE=$BASE_DIR/downloads/x86_64-linux-musl-cross/bin/x86_64-linux-musl- make toy
    mv toybox $BASE_DIR/dist/
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
  cd $BASE_DIR/downloads

  PATH=$(realpath .)/x86_64-linux-musl-cross/bin:$PATH
  cd toybox-0.8.4
  echo $PATH
  
  make root CROSS_COMPILE=x86_64-linux-musl- LINUX=$BASE_DIR/downloads/linux-5.9.11

  # rm -r ../../built/root
  mv root $BASE_DIR/dist

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

clean () {
  if [ -d $BASE_DIR/dist ]; then
    rm $BASE_DIR/dist/ -rf
  else
    echo "${RED}No dist/ folder exist${RESET}"
  fi
}

help () {
  cat <<EOF
${GREEN}build${RESET}       Build ISO
${GREEN}clean${RESET}       Clean folders
EOF
}

case "$1" in
  "build") build ;;
  "clean") clean ;;
  "") help ;;
esac
