import server from '@imlinus/static-server'

server({
  src: "dist",
  port: 3000,
  main: 'index.html'
})
