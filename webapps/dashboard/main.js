async function readConfig () {
  try {
    const response = await fetch('config.json')
    const config = await response.json()

    document.title = config.title

    console.log(config)
  } catch (error) {
    throw new Error(error)
  }
}

readConfig()
