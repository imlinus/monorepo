import server from './../../libraries/static-server/source/index.js'

server({
  src: 'build',
  port: 3000,
  main: 'index.html'
})
