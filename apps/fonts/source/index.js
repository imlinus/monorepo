import Server from '@imlinus/http-server'
const server = new Server()

server.get('/', (request, response) => {
  response.send('hello')
})

server.listen(1337)
