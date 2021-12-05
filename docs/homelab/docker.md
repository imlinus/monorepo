## Useful commands

```sh
# Simple ubuntu container
docker run -it --entrypoint '/bin/sh' ubuntu

# sh
docker exec -it image:name sh

# Inspect failed build
docker run -it --rm image:tag sh

# Better docker ps
docker ps --format '{{ json .}}'
```
