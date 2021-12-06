## Useful docker commands

Build docker image
```sh
sudo docker build -t nroot .
```

Remove all docker images
```sh
docker rmi -f $(sudo docker images -a -q)
```

Run docker container
```sh
sudo docker run -it nroot
```

 2fa_2fa_1
 0.0.0.0:1337