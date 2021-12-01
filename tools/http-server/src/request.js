import url from 'url'

function injectRequest (req) {
  req.query = (() => {
    const parsedurl = url.parse(`${req.headers.host}${req.url}`)

    if (parsedurl.query) {
      const assocQueries = parsedurl.query.split('&')
      const queries = {}

      assocQueries.forEach(query => {
        const pair = query.split('=')
        queries[pair[0]] = pair[1]
      })

      return queries
    }

    return {}
  })()

  req.setParams = (params, values) => {
    req.params = {}

    if (
      params &&
      params.length > 0 &&
      values &&
      values.length === params.length
    ) {
      const vals = values.map(val => val.replace('/', ''))

      params
        .map(param => param.replace(':', ''))
        .forEach((param, i) => {
          req.params[param] = vals[i]
        })
    }
  }

  req.getHeader = name => {
    const value = req.headers[name]
    console.log(req.headers)

    return value
  }
}

export default injectRequest
