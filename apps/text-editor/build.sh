#!/bin/bash

platform="unix"
outfile="text-editor"
compiler="gcc"
cflags="-Wall -O3 -g -std=gnu11 -fno-strict-aliasing -Isrc -DLUA_USE_POSIX"
lflags="-lSDL2 -lm -o $outfile"


if command -v ccache >/dev/null; then
  compiler="ccache $compiler"
fi


echo "compiling ($platform)..."
for f in `find src -name "*.c"`; do
  $compiler -c $cflags $f -o "${f//\//_}.o"
  if [[ $? -ne 0 ]]; then
    got_error=true
  fi
done

if [[ ! $got_error ]]; then
  echo "linking..."
  $compiler *.o $lflags
fi

echo "cleaning up..."
rm *.o
rm res.res 2>/dev/null
echo "done"
