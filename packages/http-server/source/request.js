import { URL } from 'url'

function injectRequest (request) {
  request.query = (() => {
    const baseURL = 'http://' + request.headers.host + '/'
    const parsedURL = new URL(request.url, baseURL)

    // const parsedurl = url.parse(`${req.headers.host}${req.url}`)

    if (parsedURL.searchParams) {
      // const assocQueries = parsedURL.search.split('&')
      // const queries = {}

      // assocQueries.forEach(query => {
      //   const pair = query.split('=')
      //   queries[pair[0]] = pair[1]
      // })

      // console.log(queries)

      // return queries

      console.log(parsedURL.searchParams)

      return parsedURL.searchParams
    }

    return {}
  })()

  request.setParams = (params, values) => {
    request.params = {}

    if (
      params &&
      params.length > 0 &&
      values &&
      values.length === params.length
    ) {
      const vals = values.map(val => val.replace('/', ''))

      console.log("values", vals)

      params
        .map(param => param.replace(':', ''))
        .forEach((param, i) => {
          console.log("param", param)
          request.params[param] = vals[i]
        })
    }
  }

  request.getHeader = name => {
    const value = request.headers[name]
    console.log(request.headers)

    return value
  }
}

export default injectRequest
