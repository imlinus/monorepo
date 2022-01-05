const template = document.createElement('template')

function html (strings, ...values) {
  return strings.flatMap(string => [string].concat(values.shift()))
}

function render (component, reducer) {
  let state
  let previousState = []

  function withState (part) {
    if (typeof part === 'function') {
      return part(state).map(withState)
    }

    return part
  }

  function paint (island) {
    template.innerHTML = island.flat(Infinity).join('')
    document.getElementById(template.content.children[0].id).replaceWith(template.content)
  }

  function* diff (previous, current) {
    let queue = []
    let length = Math.max(previous.length, current.length)

    for (let i = 0; i < length; i++) {
      if (previous[i] instanceof Array && current[i] instanceof Array) {
        queue.push([previous[i], current[i]])
      } else if (previous[i] !== current[i]) {
        yield current
      }
    }

    for (let pair of queue) {
      yield * diff(...pair)
    }
  }

  function dispatch (action, ...args) {
    state = reducer(state, action, args)

    let tree = component(state).map(withState)

    for (let part of diff(previousState, tree)) {
      paint(part)
    }

    previousState = tree

    return cleanUp => cleanUp(state)
  }

  dispatch()

  return dispatch
}

function log (reducer) {
  return function (previousState, action, args) {
    console.group(action)
    console.log('Previous State', previousState)
    console.log('Action Arguments', args)

    const nextState = reducer(previousState, action, args)
    console.log('Next State', nextState)
    console.groupEnd()

    return nextState
  }
}

export default html

export { render, log }
