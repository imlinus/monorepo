import util from 'util'

let colors = util.inspect.colors

colors['success'] = colors.green
colors['warning'] = colors.yellow
colors['error'] = colors.red

function palette (color, text) {
  const selected = colors[color]

  return `\x1b[${selected[0]}m${text}\x1b[${selected[1]}m`
}

function color () {
  const keys = Object.keys(colors)
  let value = {}

  for (let i = 0; i < keys.length; i++) {
    const color = keys[i]
    value[color] = text => palette(color, text)
  }

  return value
}

export default color()
