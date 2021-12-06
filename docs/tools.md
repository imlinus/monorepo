# Git Hooks

Simple git hooks

```js
// package.json
{
  "private": true,
  "name": "@imlinus/workspaces",
  "scripts": {
    "test": "",
  },
  "devDependencies": {
    "@imlinus/git-hooks": "*"
  },
  "hooks": {
    "pre-commit": "npm test"
  }
}
```


# HTTP Server

```js
import Server from '@imlinus/http-server'

new Server({
  src: '/dist',
  port: 1337,
  main: 'index.html'
})
```
