#!/bin/sh

# ---------------
# Download source
# ---------------
download_source () {
  cd ${SOURCE_DIR} || exit

  print "Downloading source"

  wget ${MUSL_URL} -q --show-progress --progress=bar:force 2>&1
  wget ${BINUTILS_URL} -q --show-progress --progress=bar:force 2>&1
  wget ${GCC_URL} -q --show-progress --progress=bar:force 2>&1
  wget ${GMP_URL} -q --show-progress --progress=bar:force 2>&1
  wget ${MPC_URL} -q --show-progress --progress=bar:force 2>&1
  wget ${MPFR_URL} -q --show-progress --progress=bar:force 2>&1
  # wget ${ISL_URL} -q --show-progress --progress=bar:force 2>&1

  cd ..
}

# --------------
# Extract source
# --------------
extract_source () {
  cd ${SOURCE_DIR} || exit

  print "Extracting source"

  tar -xf musl-${MUSL_VERSION}.tar.gz --checkpoint=.100
  tar -xf binutils-${BINUTILS_VERSION}.tar.gz --checkpoint=.100
  tar -xf gcc-${GCC_VERSION}.tar.gz --checkpoint=.100

  echo ""

  cd ..
}

# ---------------------
# Install Linux Headers
# ---------------------
install_linux_headers () {
  cd ${SOURCE_DIR} || exit
  cd linux-${KERNEL_VERSION}

  print "Installing Linux Headers"

  make distclean
  make ARCH=$ARCH headers_check
  make ARCH=$ARCH INSTALL_HDR_PATH=$SYSROOT headers_install

  cd ..
}

# --------------
# Build binutils
# --------------
build_binutils () {
  cd ${SOURCE_DIR} || exit
  cd binutils-${BINUTILS_VERSION}

  print "Building binutils"

  mkdir build
  cd build

  ../configure --prefix=$TOOLCHAIN_DIR --target=$TARGET --with-sysroot=$SYSROOT --with-lib-path=$SYSROOT/lib --disable-werror

  make -j${CORES}
  make install # install the compiled files

  cd ../..
}

# ---------
# Build gcc
# ---------
build_gcc () {
  cd ${SOURCE_DIR} || exit
  cd gcc-${GCC_VERSION}

  print "Extracting dependencies"

  tar -xf ../mpfr* --checkpoint=.100
  tar -xf ../mpc* --checkpoint=.100
  tar -xf ../gmp* --checkpoint=.100
  tar -xf ../isl* --checkpoint=.100

  print "Moving dependencies"

  mv mpfr* mpfr
  mv mpc* mpc
  mv gmp* gmp
  mv isl* isl

  print "Building gcc"

  mkdir build
  cd build

  ../configure \
    --build=$HOST \
    --host=$HOST \
    --target=$TARGET \
    --prefix=$TOOLCHAIN_DIR \
    --with-sysroot=$SYSROOT \
    --with-native-system-header-dir=/include \
    --enable-shared \
    --enable-tls \
    --enable-languages=c,c++ \
    --enable-c99 \
    --enable-long-long \
    --disable-nls \
    --disable-libmudflap \
    --disable-libmpx \
    --disable-libsanitizer \
    --disable-multilib

  make -j${CORES} all-gcc
  make install-gcc

  cd ../..
}

install_musl_headers () {
  cd ${SOURCE_DIR} || exit
  cd musl-${MUSL_VERSION}

  ./configure CROSS_COMPILE=${TARGET}- --prefix=/ --target=${TARGET}

  make -j${CORES} DESTDIR=${SYSROOT} install-headers

  cd ..
}

# ---------------
# Build Toolchain
# ---------------
build_cross_compiler () {
  cd ${SOURCE_DIR} || exit
  cd gcc-${GCC_VERSION}

  print "Build toolchain"

  cd build

  echo "musl-libc needs libgcc"

  make -j${CORES} MAKE="make enable_shared=no" all-target-libgcc
  make -j${CORES} MAKE="make enable_shared=no" install-target-libgcc

  cd ../..

  cd ${SOURCE_DIR} || exit
  cd musl-${MUSL_VERSION}

  echo "complete musl-libc"

  make -j${CORES} CC=${TARGET}-gcc LIBCC=${TOOLCHAIN_DIR}/lib/gcc/${TARGET}/$GCC_VERSION/libgcc.a DESTDIR=${SYSROOT} all

  make DESTDIR=${SYSROOT} install

  cd ..

  cd ${SOURCE_DIR} || exit
  cd gcc-${GCC_VERSION}

  cd build

  echo "build other gcc components"

  make -j${CORES} all
  make install
}

test_compiler () {
  cd ${WORKSPACE_DIR} || exit

  print "Testing the Cross Compiler"

  cat > test.c << "EOF"

#include <stdio.h>

int main()
{
	printf("Hello, world!\n");
	return 0;
}

EOF

  # Compile our little test program
  $TARGET-gcc test.c -o test --static
}


# -----
# Build
# -----
build_toolchain () {
  download_source
  extract_source

  # Build toolchain (cross-compiler)
  install_linux_headers
  build_binutils
  build_gcc
  install_musl_headers
  build_cross_compiler
  test_compiler

  print "Toolchain done" "success"
}
