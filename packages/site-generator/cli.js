#!/usr/bin/env node

import { readFile } from 'fs'
import { join } from 'path'
import { exec } from 'child_process'
import color from '@imlinus/color'

const configPath = join(process.cwd(), 'site-generator.config.js')

readFile(configPath, (error) => {
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
