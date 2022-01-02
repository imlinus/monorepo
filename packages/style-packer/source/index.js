import path from 'path'
import fs from 'fs'
import color from '@imlinus/color'

export default class StylePacker {
	constructor (options) {
		this.rootDir = options.root || process.cwd()
		this.input = path.join(this.rootDir, options.input || 'source/stylesheet.css')
		this.output = path.join(this.rootDir, options.output || 'build/stylesheet.css')

		this.init()
  }

	readAndBundle ({
		file, // string
		relative, // string
		bundled, // string
		included // array
	}) {
		bundled = bundled || ''

		const filePath = path.join(relative, path.basename(file))

		console.log(color.blue(path.basename(filePath)))

		if (included.includes(filePath)) {
			return bundled
		}

		included.push(filePath)

		let content = fs.readFileSync(filePath, 'utf8')

		const matches = content.matchAll(/^\s*@import\s+"(.*)";\s*$/mg)

		for (const match of matches) {
			const relativeSubFolder = path.resolve(relative, path.dirname(filePath))
			const absoluteSubPath = path.resolve(relativeSubFolder, match[1])

			const subFile = this.readAndBundle({
				file: './' + path.basename(match[1]),
				relative: path.dirname(absoluteSubPath),
				bundled: '',
				included: included
			})

			content = content.replace(match[0], subFile)
		}

		return bundled + '\n' + content
	}

	pack () {
		const file = './' + path.basename(this.input)

		return this.readAndBundle({
			file: file,
			relative: path.dirname(this.input),
			bundled: '',
			included: []
		}).trim()
	}

	init () {
		console.log(color.green('Style Packer'))

		let packed = this.pack()

		fs.writeFileSync(this.output, packed)
    console.log(color.green('Written to:'), this.output)
	}
}


// function modify (nestled) {
//   const tokens = []
//   const quotes = []
//   const quoteToken = ':Q=' + (Math.random() + '=Q:').substr(2)

//   nestled
//     .replace(/<!\[CDATA\[([\s\S]*)]]>/g, '$1') // remove CDATA
//     .replace(/(['"])(.*?[^\\])?\1|\([^)]+:\/\/[^)]+\)/g, q => quoteToken + quotes.push(q)) // store and remove quotes
//     .replace(/\/\*[\s\S]*?\*\//g, '').replace(/\/\/[^\n]*/g, '') // remove remarks
//     .replace(/([\s\S]*?)\s*([;{}]|$)/g, (_, g1, g2) => tokens.push.apply(tokens, [g1, g2].map(s => s.trim()).filter(s => s))) // tokenize

//   return flattenRules()
//     .replace(/[ \n]*\n */g, '\n')
//     .replace(new RegExp(quoteToken + '(\\d+)', 'g'), (_, n) => quotes[n - 1]) // restore quotes

//   function flattenRules () {
//     function addRules (rules, selectors, styles) {
//       rules.push([selectors, styles])

//       const get = () => tokens.shift()
//       let atRule = null
//       let ll

//       for (let token = get(); token; token = get()) {
//         if (/^@/.test(token)) {
//           atRule = ''
//           ll = 0
//         }

//         if (atRule !== null) {
//           if (token !== ';') {
//             atRule += ' '
//           }

//           atRule += token

//           if (token === '{') {
//             ++ll
//           }

//           if ((token === '}' && --ll === 0) || (token === ';' && ll === 0)) {
//             const parts = /^([^{]+){([\s\S]*)}$/.exec(atRule)

//             if (parts && /^\s*@(media|supports|document)/.test(parts[0])) {
//               atRule = parts[1] + '{' + convertNcssTextToCss(parts[2]).replace(/\n/g, ' ') + ' }'
//             }

//             rules.push([[], [atRule.replace(/ *\n */g, ' ')]])
//             atRule = null
//           }
//         } else {
//           if (token === '}') {
//             break
//           } else {
//             if (tokens[0] === '{') { // next token is {
//               get() // skip {
//               let deeperSelectors = []

//               token.split(/\s*,\s*/).forEach(tsel => selectors.forEach(sel =>
//                 deeperSelectors.push(
//                   tsel.includes('&')
//                     ? tsel.replace(/^(.*?)\s*&/, (_, prefix) => prefix ? prefix + ' ' + sel.trim() : sel)
//                     : sel + ' ' + tsel
//                 )
//               ))

//               addRules(rules, deeperSelectors, [])
//             } else {
//               styles.push(token)
//             }
//           }
//         }
//       }

//       return rules
//     }

//     return addRules([], [''], [])
//       .filter(([selectors, styles]) => styles[0])
//       .map(([selectors, styles]) => selectors + (selectors[0] ? ` { ${styles.join(' ')} }` : styles.join('\n')).replace(/ ;/g, ';'))
//       .join('\n')
//   }
// }
