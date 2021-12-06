import util from 'util'
let colors = util.inspect.colors

colors['success'] = colors.green
colors['warning'] = colors.yellow
colors['error'] = colors.red

const emoji = {
  success: '🎉',
  warning: '⚠️',
  error: '🚨'
}

function palette (color, text) {
  const selected = colors[color]

  if (color === 'success' || color === 'warning' || color === 'error') {
    return `${emoji[color]}  \x1b[${selected[0]}m${text}\x1b[${selected[1]}m`
  } else {
    return `\x1b[${selected[0]}m${text}\x1b[${selected[1]}m`
  }
}

function color () {
  const keys = Object.keys(colors)
  let val = {}

  for (let i = 0; i < keys.length; i++) {
    const color = keys[i]
    val[color] = text => palette(color, text)
  }

  return val
}

export default color()
