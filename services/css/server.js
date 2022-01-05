import fs from 'fs'
import path from 'path'
import server from './../../libraries/http-server/source/index.js'

server.get('/', (request, response) => {
  const filePath = path.join(process.cwd(), './../../libraries/stylesheet/build/stylesheet.css')
  const stylesheet = fs.readFileSync(filePath, 'utf8')

  response.css(stylesheet)
})

server.listen(3000)
