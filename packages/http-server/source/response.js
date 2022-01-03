function injectResponse (res) {
  res.status = (code = 200) => {
    if (typeof code !== 'number' && process.env.NODE_ENV === 'development') {
      console.log('Cannot set status code with given code')
    }

    res.statusCode = code

    return res
  }

  const sendByType = (type, body) => {
    res.setHeader('Content-Type', type)
    res.end(body)
  }

  res.send = param => {
    sendByType('text/html', param)
  }

  res.json = param => {
    const json = typeof param === 'object' ? JSON.stringify(param) : param
    sendByType('application/json', json)
  }

  res.redirect = (url, code = 302) => {
    if (![301, 302].includes(code) && process.env.NODE_ENV === 'development') {
      console.log('Cannot set status code with given code')
    }

    res.statusCode = code
    res.setHeader('Location', url)
    res.end()
  }
}

export default injectResponse
