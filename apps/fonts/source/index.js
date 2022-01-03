import fs from 'fs'
import path from 'path'
import server from '@imlinus/http-server'

const fonts = {
  'JetBrains Mono': './fonts/jetbrains-mono/style.css',
  'Comic Mono': './fonts/comic-mono/style.css'
}

server.get('/css/:family', (request, response) => {
  let root = process.cwd()
  let filePath = path.join(root, fonts[request.query.family])
  let content = fs.readFileSync(filePath, 'utf8')

  response.css(content)
})

server.listen(3000)
