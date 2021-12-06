# isPortBusy
Check if port is available, otherwise suggest nearby

```js
import isPortBusy from '@imlinus/isPortBusy'
import http from 'http'

class Server {
  constructor () {}

  async init (port = 1337) {
    const availablePort = await isPortBusy(port)
    http.listen(availablePort)
  }
}
```
