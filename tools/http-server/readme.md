# HTTP-server
It's just my personal dev server, nothing fancy.

```js
const Server = require('@imlinus/http-server')

new Server({
  src: '/dist',
  port: 1337,
  main: 'index.html'
})
```

old
```js
import Server from '@imlinus/http-server'
const server = new Server()

server.get('/', (req, res) => {
  res.send('hello')
})

server.listen(1337)
```
