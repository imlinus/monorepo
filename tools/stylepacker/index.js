const path = require('path')
const fs = require('fs')

function readAndBundle (options) {
  options.bundled = options.bundled || ''

  const filePath = path.resolve(options.relative, options.file)

  if (options.included.includes(filePath)) {
    return options.bundled
  }

  options.included.push(filePath)

  let content = fs.readFileSync(filePath, 'utf8')

  const matches = content.matchAll(/^\s*@import\s+"(.*)";\s*$/mg)
  
  for (const match of matches) {
    const relativeSubFolder = path.resolve(options.relative, path.dirname(filePath))
    const absoluteSubPath = path.resolve(relativeSubFolder, match[1])

    const subFile = readAndBundle({
      file: match[1],
      relative: path.dirname(absoluteSubPath),
      bundled: '',
      included: options.included
    })

    content = content.replace(match[0], subFile)
  }

  return options.bundled + '\n' + content
}

function modify (nestled) {
  const tokens = []
  const quotes = []
  const quoteToken = ':Q=' + (Math.random() + '=Q:').substr(2)

  nestled
    .replace(/<!\[CDATA\[([\s\S]*)]]>/g, '$1') // remove CDATA
    .replace(/(['"])(.*?[^\\])?\1|\([^)]+:\/\/[^)]+\)/g, q => quoteToken + quotes.push(q)) // store and remove quotes
    .replace(/\/\*[\s\S]*?\*\//g, '').replace(/\/\/[^\n]*/g, '') // remove remarks
    .replace(/([\s\S]*?)\s*([;{}]|$)/g, (_, g1, g2) => tokens.push.apply(tokens, [g1, g2].map(s => s.trim()).filter(s => s))) // tokenize

  return flattenRules()
    .replace(/[ \n]*\n */g, '\n')
    .replace(new RegExp(quoteToken + '(\\d+)', 'g'), (_, n) => quotes[n - 1]) // restore quotes

  function flattenRules () {
    function addRules (rules, selectors, styles) {
      rules.push([selectors, styles])

      const get = () => tokens.shift()
      let atRule = null
      let ll

      for (let token = get(); token; token = get()) {
        if (/^@/.test(token)) {
          atRule = ''
          ll = 0
        }

        if (atRule !== null) {
          if (token !== ';') {
            atRule += ' '
          }

          atRule += token

          if (token === '{') {
            ++ll
          }

          if ((token === '}' && --ll === 0) || (token === ';' && ll === 0)) {
            const parts = /^([^{]+){([\s\S]*)}$/.exec(atRule)

            if (parts && /^\s*@(media|supports|document)/.test(parts[0])) {
              atRule = parts[1] + '{' + convertNcssTextToCss(parts[2]).replace(/\n/g, ' ') + ' }'
            }

            rules.push([[], [atRule.replace(/ *\n */g, ' ')]])
            atRule = null
          }
        } else {
          if (token === '}') {
            break
          } else {
            if (tokens[0] === '{') { // next token is {
              get() // skip {
              let deeperSelectors = []

              token.split(/\s*,\s*/).forEach(tsel => selectors.forEach(sel =>
                deeperSelectors.push(
                  tsel.includes('&')
                    ? tsel.replace(/^(.*?)\s*&/, (_, prefix) => prefix ? prefix + ' ' + sel.trim() : sel)
                    : sel + ' ' + tsel
                )
              ))

              addRules(rules, deeperSelectors, [])
            } else {
              styles.push(token)
            }
          }
        }
      }

      return rules
    }

    return addRules([], [''], [])
      .filter(([selectors, styles]) => styles[0])
      .map(([selectors, styles]) => selectors + (selectors[0] ? ` { ${styles.join(' ')} }` : styles.join('\n')).replace(/ ;/g, ';'))
      .join('\n')
  }
}

function pack (entryFile) {
  const file = './' + path.basename(entryFile)

  return readAndBundle({
    file: file,
    relative: path.resolve(path.dirname(entryFile)),
    bundled: '',
    included: []
  }).trim()
}

function stylepacker (file) {
  let packed = pack(file)
  let style = modify(packed)

  return style
}

module.exports = stylepacker
