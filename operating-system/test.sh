#!/bin/sh

# ------------------------------------
# This is the build script for Lily OS 
# ------------------------------------

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

export LABEL="${RESET}${BOLD}${MAGENTA}"
export WARNING="${YELLOW}${BOLD}"
export DANGER="${RED}${BOLD}"
export SUCCESS="${GREEN}${BOLD}✔${RESET}"

# LOGO
export LILY1="${MAGENTA}${BOLD}     _      ${RESET}"
export LILY2="${MAGENTA}${BOLD}   _(_)_    ${RESET}"
export LILY3="${MAGENTA}${BOLD}  (_)${WHITE}•${MAGENTA}${BOLD}(_)   ${RESET}"
export LILY4="${green}${BOLD}   /${RESET}${MAGENTA}${BOLD}(_)     ${RESET}"
export LILY5="${green}${BOLD}   \        ${RESET}"
export LILY6="${green}${BOLD}    \       ${RESET}"

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
    echo "${WARNING}${CORES} CPU cores, expect a long build time.${RESET}"
    sleep 1
  fi
}

print () {
	message=$1
	type=$2

	case ${type} in
		'warning')
			echo ${YELLOW}${message}${RESET}
			#echo "!. ${message}" >> ${LOG}
			;;
		'danger')
			echo ${RED}${message}${RESET}
			exit 1
			;;
		'success')
			echo ${SUCCESS} ${message}${RESET}
			;;
		'')
			echo "** "${GREEN}${message}${RESET}
			;;
	esac
}

# ---------------
# Prepare folders
# ---------------
prepare_folders () {
  print "Creating folders"

  echo "/workspace"
  [ -d "${WORKSPACE_DIR}" ] || mkdir --parents "${WORKSPACE_DIR}"

  echo "/workspace/targetfs"
  [ -d "${TARGETFS_DIR}" ] || mkdir --parents "${TARGETFS_DIR}"

  echo "/workspace/toolchain"
  [ -d "${TOOLCHAIN_DIR}" ] || mkdir --parents "${TOOLCHAIN_DIR}"

  echo "/workspace/toolchain/lib"
  [ -d "${TOOLCHAIN_DIR}/lib" ] || mkdir --parents "${TOOLCHAIN_DIR}/lib"

  echo "/workspace/toolchain/source"
  [ -d "${SOURCE_DIR}" ] || mkdir --parents "${SOURCE_DIR}"

  echo "/workspace/toolchain/${TARGET}/lib"
  [ -d "${SYSROOT}/lib" ] || mkdir --parents "${SYSROOT}/lib"

  print "Creating symlinks"
  ln -sfv ${TOOLCHAIN_DIR}/lib ${TOOLCHAIN_DIR}/lib64
  ln -sfv ${SYSROOT}/lib ${SYSROOT}/lib64
  ln -sfv . ${SYSROOT}/usr
}

# ---------------
# Download source
# ---------------
download_source () {
  cd ${SOURCE_DIR} || exit

  print "Downloading source"

  wget ${SYSLINUX_URL} -q --show-progress --progress=bar:force 2>&1
  wget ${KERNEL_URL} -q --show-progress --progress=bar:force 2>&1
  wget ${BUSYBOX_URL} -q --show-progress --progress=bar:force 2>&1
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

  tar -xf syslinux-${SYSLINUX_VERSION}.tar.xz --checkpoint=.100
  tar -xf linux-${KERNEL_VERSION}.tar.xz --checkpoint=.100
  tar -xf busybox-${BUSYBOX_VERSION}.tar.bz2 --checkpoint=.100
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
build_toolchain () {
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

# ----------------
# Setup Filesystem
# ----------------
setup_filesystem () {
  mkdir -p ${TARGETFS_DIR}/bin
  mkdir -p ${TARGETFS_DIR}/sbin
  mkdir -p ${TARGETFS_DIR}/dev
  mkdir -p ${TARGETFS_DIR}/proc
  mkdir -p ${TARGETFS_DIR}/sys
  mkdir -p ${TARGETFS_DIR}/lib

  mkdir -p ${TARGETFS_DIR}/etc/init.d
  mkdir -p ${TARGETFS_DIR}/var/lock
  mkdir -p ${TARGETFS_DIR}/var/log

  # Set permissions
  install -dm 0750 ${TARGETFS_DIR}/root # 0750: rwxr-x---
  install -dm 1777 ${TARGETFS_DIR}/tmp # 1777: rwxrwxrwx, with sticky bit set
  install -dm 1777 ${TARGETFS_DIR}/var/tmp # same as above

  # Link "lib64" to "lib" so all libraries can be installed in one place
  ln -sfv ${TARGETFS_DIR}/lib ${TARGETFS_DIR}/lib64
}

# -------------------
# Basic Configuration
# -------------------
basic_configuration () {
  # /etc/mtab is a file that shows a list of mounted file systems,
  # and /proc/mounts contains exactly that information, so we symlink these two together.
  ln -sfv ../proc/mounts ${TARGETFS_DIR}/etc/mtab

  # The /etc/passwd file is a text-based database of information about users,
  # Like their username, user/group ID number, login shell, and so on.
  cat > ${TARGETFS_DIR}/etc/passwd << "EOF"
root::0:0:root:/root:/bin/ash
EOF

  # /etc/group is another text-based database with the groups present on the system.
  # For now, we only have the root group.
  cat > ${TARGETFS_DIR}/etc/group << "EOF"
root:x:0:
EOF

  # The /var/log/lastlog file is used by programs like init or login
  # to record information about users that logged into the system. 
  touch ${TARGETFS_DIR}/var/log/lastlog
  chmod -v 664 ${TARGETFS_DIR}/var/log/lastlog
}

basic_initialization () {
  cat > ${TARGETFS_DIR}/etc/inittab << "EOF"

::sysinit:/etc/init.d/startup   # execute a script that we will write ourselves
::respawn:/sbin/getty -L ttyS0 9600 vt100   # start a terminal on ttyS0 (serial line)
# ::askfirst:-/bin/sh

::ctrlaltdel:/sbin/reboot   # what do do when the ctrl-alt-del keys are pressed

::shutdown:/bin/umount -a -r  # what to do during shutdown
::restart:/sbin/init  # what to do during restart

EOF

  # This is the custom "startup" script that busybox init will run when the system starts.
  cat > ${TARGETFS_DIR}/etc/init.d/startup << "EOF"
#!/bin/sh

# mount pseudo file systems
mount -t proc proc /proc
mount -t sysfs sysfs /sys
mount -t devtmpfs devtmpfs /dev

# print some messages
echo Boot took $(cut -d' ' -f1 /proc/uptime) seconds.
echo Welcome to Lily OS

EOF

chmod +x ${TARGETFS_DIR}/etc/init.d/startup
}

#
#
#
install_libgcc () {
  cd ${SOURCE_DIR} || exit
  cd gcc-${GCC_VERSION}

  tar -xf ../mpfr*
  tar -xf ../mpc*
  tar -xf ../gmp*
  tar -xf ../isl*

  mv mpfr* mpfr
  mv gmp* gmp
  mv mpc* mpc
  mv isl* isl

  mkdir build
  cd build

  ../configure \
    --prefix=${TARGETFS_DIR} \
    --host=${TARGET} \
    --target=${TARGET} \
    --disable-multilib \
    --disable-bootstrap \
    --disable-nls \
    --disable-libmpx \
    --disable-libsanitizer \
    --disable-libmudflap \
    --enable-c99 \
    --enable-long-long \
    --enable-tls \
    --enable-languages=c,c++

  make -j${CORES} all-target-libgcc	
  make install-target-libgcc

  ${TARGET}-strip ${TARGETFS_DIR}/lib/libgcc_s.so.1
  rm -r ${TARGETFS_DIR}/lib/gcc
}

# --
#
# --
install_musl_libc () {
  cd ${SOURCE_DIR} || exit
  cd musl-${MUSL_VERSION}

  ./configure \
    CROSS_COMPILE=${TARGET}- \
    --prefix=/ \
    --disable-static \
    --target=${TARGET}

  make -j4
  make DESTDIR=${TARGETFS_DIR} install-libs
}

#
#
# Settings --->
#	 Don't use /usr: Y
#  Init Utilities --->
#    linuxrc: support running init from initrd (not initramfs): N
#
#  If you are building a statically-linked busybox, select the following as well:
#  Settings --->
#    Build static binary (no shared libs): Y
#
install_busybox () {
  cd ${SOURCE_DIR} || exit
  cd busybox-${BUSYBOX_VERSION}

  make distclean
  make ARCH=${ARCH} defconfig

  make ARCH=${ARCH} menuconfig

  make -j${CORES} ARCH=${ARCH} CROSS_COMPILE=${TARGET}- CONFIG_PREFIX=${TARGETFS_DIR} install

  chmod 4755 ${TARGETFS_DIR}/bin/busybox # the leading '4' is the setuid bit

  # su	# login as root uesr
  # chown root:root -R ${TARGETFS_DIR}
  exit
}

# -----
# Build
# -----
build () {
  download_source
  extract_source

  # Build toolchain (cross-compiler)
  install_linux_headers
  build_binutils
  build_gcc
  install_musl_headers
  build_toolchain
  test_compiler

  # Setup skeleton
  # setup_filesystem
  # basic_configuration
  # basic_initialization

  # Setup basic software
  # clean_source
  # install_libgcc
  # install_musl_libc
  # install_busybox

  print "Done" "success"
}

