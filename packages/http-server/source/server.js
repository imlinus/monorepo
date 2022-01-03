import http from 'http'
import Router from './router.js'
import injectRequest from './request.js'
import injectResponse from './response.js'

class Server extends Router {
  constructor () {
    super()

    this.server = http.createServer((request, response) => {
      const requestBody = []

      request.on('data', c => {
        requestBody.push(c)
      }).on('end', async () => {
        request.body = Buffer.concat(requestBody).toString()

        if (request.headers['content-type'] === 'application/json') {
          request.body = JSON.parse(request.body)
        }

        injectRequest(request)
        injectResponse(response)

        await this.handle(request, response)
      })
    })

    this.server.on('clientError', (_err, socket) => {
      return socket.end('HTTP/1.1 400 Bad Request\r\n\r\n')
    })
  }

  listen (port = 8080, ...args) {
    this.server.listen(port, ...args)
  }
}

export default Server
