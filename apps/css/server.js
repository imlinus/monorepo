import fs from 'fs'
import path from 'path'
import server from '@imlinus/http-server'

server.get('/', (request, response) => {
  const filePath = path.join(process.cwd(), './node_modules/@imlinus/stylesheet/build/stylesheet.css')
  const stylesheet = fs.readFileSync(filePath, 'utf8')

  response.css(stylesheet)
})

server.listen(3000)
