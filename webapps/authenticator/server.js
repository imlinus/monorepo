import server from '@imlinus/http-server'

import { URL } from 'url'
import path from 'path'

const __dirname = (() => {
  let x = path.dirname(decodeURI(new URL(import.meta.url).pathname))
  return path.resolve((process.platform == 'win32') ? x.substr(1) : x)
})()

server({
  src: __dirname, // path.join(__dirname, '/dist'),
  port: 1300,
  main: 'index.html'
})
