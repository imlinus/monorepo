First, we've gotta setup our toolchain. Or the cross-compiler as it's sometimes called

This is then what will build our distro for us

Our goal is to create a `bzImage`
and a `cpio.gz` including (Toybox) https://en.wikipedia.org/wiki/Toybox

- Bootloader: syslinux
- Utils: toybox


Useful commands:
```bash
docker-compose up --build
docker exec -it <image:name> sh
cd dist/x86_64
chmod +x qemu-x86_64.sh
./qemu-x86_64.sh
```

docker cp b53ccef893d8:/docker/workspace/dist/lily-os.iso C:/Users/billgates/lily-os.iso
