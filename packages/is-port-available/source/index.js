import net from 'net'

function isPortAvailable (port) {
  return new Promise(resolve => {
    const server = net.createServer()

    server.unref()

    server.on('error', () => {
      resolve(null)
    })

    server.listen(port, () => {
      server.close(() => resolve(port))
    })
  })
}

function isPortBusy (port, limit = 5) {
  return new Promise(async (resolve, reject) => {
    const maxPort = (port + limit) - 1

    do {
      const available = await isPortAvailable(port)

      if (available.constructor === Number) {
        resolve(port)
      }

      port++

      if (port === maxPort) {
        reject()
      }
    } while (port <= maxPort)
  })
}

// module.exports = isPortBusy
export default isPortBusy
