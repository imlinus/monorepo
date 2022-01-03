const methods = ['GET', 'POST', 'PUT', 'DELETE']

class Router {
  constructor () {
    this.routes = {}

    console.log(this.routes)

    methods.forEach(method => {
      if (!this.routes[method]) {
        this.routes[method] = {}
      }

      this[method.toLowerCase()] = (url, ...handlers) => {
        const params = url.match(/:([a-z]+)/gi)
        const path = url.replace(/:[a-z]+/gi, '([0-9a-z]+)')

        console.log(path)

        this.routes[method][`^${path}$`] = {
          params,
          handlers
        }
      }
    })
  }

  getHandlers (request) {
    const routesWithMethod = Object.keys(this.routes[request.method] || {})

    const paths = routesWithMethod.filter(route => {
      const re = new RegExp(route, 'ig')
      return re.test(request.url)
    })

    let tmpHandlers = undefined

    if (paths.length > 0) {
      const { params, handlers } = this.routes[request.method][paths[0]]
      const [_, ...paramsValues] = new RegExp(paths[0], 'ig').exec(request.url)

      request.setParams(params, paramsValues)
      tmpHandlers = handlers
    }

    return tmpHandlers
  }

  on404 (request, response) {
    response.status(404).end(`${request.method} ${request.url} 404 Not Found`)
  }

  on500 (request, response) {
    response.status(500).end(`${request.method} ${request.url} 500 Internal Server Error`)
  }

  async handle (request, response) {
    if (request.method.toLowerCase() === 'options') {
      response.status(200).end()
      return
    }

    const handlers = this.getHandlers(request)

    if (!handlers) {
      return this.on404(request, response)
    }

    console.log(handlers)

    for (let handler of handlers) {
      try {
        await handler(request, response)
      } catch (e) {
        if (process.env.NODE_ENV === 'development') {
          console.log(e.message)
        }

        return this.on500(request, response)
      }
    }
  }
}

export default Router
