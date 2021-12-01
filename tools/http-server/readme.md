# HTTP-server

```js
import Server from '@imlinus/http-server'
const server = new Server()

server.get('/', (req, res) => {
  res.send('hello')
})

server.listen(1337)
```
