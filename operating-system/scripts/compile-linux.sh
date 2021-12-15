#!/bin/sh

# ---------------
# Download source
# ---------------
download_source () {
  cd ${SOURCE_DIR} || exit

  print "Downloading source"

  wget ${SYSLINUX_URL} -q --show-progress --progress=bar:force 2>&1
  wget ${KERNEL_URL} -q --show-progress --progress=bar:force 2>&1
  wget ${BUSYBOX_URL} -q --show-progress --progress=bar:force 2>&1

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

  echo ""

  cd ..
}

# ----------------
# Setup filesystem
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
# Basic configuration
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

# -------------------
# Basic initialization
# -------------------
basic_initialization () {
  cat > ${TARGETFS_DIR}/etc/inittab << "EOF"

::sysinit:/etc/init.d/startup   # execute a script that we will write ourselves
::respawn:/sbin/getty -L ttyS0 9600 vt100   # start a terminal on ttyS0 (serial line)
# ::askfirst:-/bin/sh

::ctrlaltdel:/sbin/reboot   # what do do when the ctrl-alt-del keys are pressed

::shutdown:/bin/umount -a -r  # what to do during shutdown
::restart:/sbin/init  # what to do during restart

EOF

  # This is the custom "startup" script that
  # busybox init will run when the system starts.
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

  ./configure CROSS_COMPILE=${TARGET}- --prefix=/ --disable-static --target=${TARGET}

  make -j4 # had weird issues using all cores
  make DESTDIR=${TARGETFS_DIR} install-libs
}

# TODO: Replace with toybox
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

# -----------
# Build linux
# -----------
build_linux () {
  download_source
  extract_source

  setup_filesystem
  basic_configuration
  basic_initialization

  clean_source
  install_libgcc
  install_musl_libc
  install_busybox

  print "Done" "success"
}
