#!/bin/sh

prepare_workspace () {
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
