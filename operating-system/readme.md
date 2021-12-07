First, we've gotta setup our toolchain. Or the cross-compiler as it's sometimes called

This is then what will build our distro for us

Our goal is to create a `bzImage` out of the kernel,
and a `cpio.gz` from our initial file system (including Toybox https://en.wikipedia.org/wiki/Toybox)


Useful commands:
```bash
docker-compose up --build
docker exec -it <image:name> sh
cd dist/x86_64
chmod +x qemu-x86_64.sh
./qemu-x86_64.sh
```

docker cp ffae17e2a6d7:/docker/workspace/dist/root/x86_64/lily-os.iso C:/Users/billgates/lily-os.iso
