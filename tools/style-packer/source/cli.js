#!/usr/bin/env node

import fs from 'fs'
import path from 'path'
import { exec } from 'child_process'
import color from '@imlinus/color'

let watch = false
const configPath = path.join(process.cwd(), 'style-packer.config.js')

// TODO: Implement watch function
if (process.argv.includes('--watch')) {
  watch = true
}

fs.readFile(configPath, (error) => {
	if (error !== null) {
		console.error(color.red('Failed to read config'))
    console.error(error)
	}

	exec('node ' + configPath, (error, stdout) => {
		if (error !== null) {
			console.error(color.red('Failed to run config'))
      console.error(error)
		}

		console.log(stdout)
	})
})
