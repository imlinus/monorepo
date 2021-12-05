# Build ISO

**Lily JS** comes with a buildscript which you can find in [/os/build](https://github.com/yolo/lily-os/tree/main/os/build)

We are utilizing Docker for the build environment, simply because there's gonna be a lot of tools needed for the cross-compiler, and I don't want to keep that trash on your system :P

Instead, you just have to have Docker installed

Firstly, you need to have docker installed on your machine.
We're building the ISO in a container simply because it's easier to set it up with all the right things

```sh
❯ docker-compose build
```

```sh
❯ docker-compose up
```

*Fair warning:* I've got a Ryzen 5 and running this script will take a good hour :)