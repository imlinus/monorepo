#!/usr/bin/env node

import { readFile } from 'fs'
import { join } from 'path'
import { exec } from 'child_process'
import color from '@imlinus/color'

const configPath = join(process.cwd(), 'site-generator.config.js')

console.log("process.cwd", process.cwd())
console.log("configPath", configPath)

readFile(configPath, (error, content) => {
	if (error !== null) {
		console.error(color.red('Failed to read configuration file.'))
    console.error(error)
	}

	exec('node ' + configPath, (error, stdout) => {
		if (error !== null) {
			console.error(color.red('Failed execution of configuration file.'))
		}

		console.log(stdout)
	})
})
