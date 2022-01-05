import fs from 'fs'
import path from 'path'
import server from './../../libraries/http-server/source/index.js'

const fonts = {
  'JetBrains Mono': './fonts/jetbrains-mono/style.css',
  'Comic Mono': './fonts/comic-mono/style.css'
}

server.get('/css/:family', (request, response) => {
  const filePath = path.join(process.cwd(), fonts[request.query.family])
  const stylesheet = fs.readFileSync(filePath, 'utf8')

  response.css(stylesheet)
})

server.listen(3000)
