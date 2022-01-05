import server from './../../libraries/static-server/source/index.js'

server({
  src: 'source',
  port: 3000,
  main: 'index.html'
})
