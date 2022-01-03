import server from '@imlinus/http-server'

server({
  src: "dist",
  port: 1305,
  main: 'index.html'
})
