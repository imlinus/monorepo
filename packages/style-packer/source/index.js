import path from 'path'
import fs from 'fs'
import color from '@imlinus/color'
import convertNestled from './convert-nestled.js'

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

	async init () {
		console.log(path.dirname(this.output))
		// Create build folder
		await fs.promises.mkdir(path.dirname(this.output), { recursive: true })

		console.log(color.green('Style Packer'))

		const packed = this.pack()
		const stylesheet = convertNestled(packed).trim()

		fs.writeFileSync(this.output, stylesheet)
    console.log(color.green('Written to:'), this.output)
	}
}
