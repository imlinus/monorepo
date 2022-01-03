import path from 'path'
import fs from 'fs'
import color from '@imlinus/color'
import convertNestled from './convert-nestled'

export default class StylePacker {
	constructor ({
		root, // string
		input, // string
		output // string
	}) {
		this.root = root || process.cwd()
		this.input = path.join(this.root, input || 'source/stylesheet.css')
		this.output = path.join(this.root, output || 'build/stylesheet.css')

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

		// const stylesheet = convertNestled(packed)

		fs.writeFileSync(this.output, packed)
    console.log(color.green('Written to:'), this.output)
	}
}
