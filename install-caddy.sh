#!/bin/sh

GREEN="$(tput setaf 2)"
RESET="$(tput sgr0)"

apt-get update
curl -sS https://webinstall.dev/caddy

export PATH="/root/.local/bin:$PATH"

webi serviceman

sudo \
  env PATH="$PATH" \
  serviceman add \
    --system \
    --username "$(whoami)" \
    --name caddy -- caddy run \
    --config ./monorepo/Caddyfile

sudo systemctl restart caddy

echo "${GREEN}Installed Caddy${RESET}"
