# Caddy
This is the reverse proxy for most of my homelab

### Install
On ubuntu server

```sh
apt-get update
curl -sS https://webinstall.dev/caddy
```

Then you need to add this line to your `.zshrc`, `.bashrc` or what it might be :P
```sh
export PATH="/root/.local/bin:$PATH"
```

And then we can continue with making it a system service
```sh
webi serviceman

sudo env PATH="$PATH" \
    serviceman add --system --username $(whoami) --name caddy -- \
        caddy run --config ./caddy/Caddyfile

sudo systemctl restart caddy
```
