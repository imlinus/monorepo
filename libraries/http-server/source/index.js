import http from 'http'

let server = {}
let routes = []
let plugins = []

function errorTemplate (request, response) {
  return response.json({
    error: request.url + ' not found.'
  })
}

function createServer (port, options, handler) {
  return http.createServer(options, handler).listen(port)
}

function responseFunctions (response) {
  return {
    send (value) {
      return response.end(value)
    },

    status (code) {
      return response.writeHead(code)
    },

    setHeader (name, value) {
      return response.setHeader(name, value)
    },

    json (value) {
      response.setHeader('Content-Type', 'application/json')
      response.end(JSON.stringify(value))
    },

    html (value) {
      response.setHeader('Content-Type', 'text/html')
      response.end(value)
    },

    css (value) {
      response.setHeader('Content-Type', 'text/css')
      response.end(value)
    }
  }
}

function lookupRoute (url) {
  for (let i = 0; i < routes.length; i++) {
    let params = routes[i].route.match(url)

    if (params) {
      return [params, routes[i]]
    }
  }

  return [undefined, undefined]
}

function routeHandler (request, response, error) {
  const [url, query] = request.url.split('?')
  const [params, route] = lookupRoute(url)

  let index = 0

  if (
    params === undefined ||
    route === undefined ||
    request.method !== route.method
  ) {
    error(request, responseFunctions(response))
    return
  }

  request.params = params

  const baseURL = 'http://' + request.headers.host + '/'
  const parsedURL = new URL(request.url, baseURL)

  request.query = Object.fromEntries(parsedURL.searchParams)

  function activator (request, response) {
    return plugins[index](request, response, () => { 
      index++

      if (index < plugins.length) {
        activator(request, response)
      } else {
        route.handler(request, responseFunctions(response))
      }
    })
  }

  plugins.length !== 0
    ? activator(request, response)
    : route.handler(request, responseFunctions(response))
}

for (let method of http.METHODS) {
  server[method.toLowerCase()] = (route, handler) => {
    routes.push({ 
      method, 
      handler, 
      route: route
    })
  }
}

server.use = middelware => {
  return (typeof middelware === 'function')
    ? plugins.push(middelware)
    : undefined
}

server.listen = (
  port = 3000, 
  options = undefined, 
  error = errorTemplate
) => {
  return (routes && routes.length !== 0) 
    ? createServer(port, options, (request, response) => routeHandler(request, response, error)) 
    : undefined
}

export default server
