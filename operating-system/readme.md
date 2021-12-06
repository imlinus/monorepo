First, we've gotta setup our toolchain. Or the cross-compiler as it's sometimes called

This is then what will build our distro for us


Useful commands:
```bash
docker-compose up --build
docker exec -it <image:name> sh
cd dist/x86_64
chmod +x qemu-x86_64.sh
./qemu-x86_64.sh
```

docker cp 11074eb51d79:/docker/dist/x86_64.zip C:/Users/billgates/x86_64.zip
