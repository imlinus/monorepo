import { join, basename } from 'path'
import { readdirSync, readFileSync } from 'fs'
import markdownParser from '@imlinus/markdown-parser'
import fs from '@imlinus/markdown-parser'

export default function SiteGenerator (options) {
	const root = options.root || process.cwd()
	const views = options.pages || "views"
	const pages = options.pages || "pages"
	const posts = options.posts || "posts"
	const dist = options.dist || "dist"

	const viewsPath = join(root, views)
	const viewsFiles = readdirSync(viewsPath)

	console.log("SiteGenerator", options)

	console.log(viewsFiles)

	for (let i = 0; i < viewsFiles.length; i++) {
		const viewFile = viewsFiles[i]

		const content = readFileSync(join(viewsPath, viewFile), "utf8")

		writeFileSync(join(dist, viewFile + ".html"), markdownParser(content))
	}

	// const output = readFileSync(new URL('./foo.txt', import.meta.url));
}


