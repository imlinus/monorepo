#!/usr/bin/env node

const fs = require('fs')
const path = require('path')
const stylepacker = require('./index')

let input
let output
let watch = false

process.argv.forEach(value => {
  if (value.includes('--input')) {
    input = value.split('input=')[1]
  }

  if (value.includes('--output')) {
    output = value.split('output=')[1]
  }

  if (value.includes('--watch')) {
    watch = true
  }
})

if (!input || !output) {
  console.log('Sorry, you didnt provide input or output file')
  return
}

function pack () {
  const result = stylepacker(input)
  const outputFile = output && path.resolve(output)

  if (outputFile) {
    fs.writeFileSync(outputFile, result)
    console.log('Done')
  } else {
    console.log(result)
  }
}

if (watch) {
  // implement --watch
} else {
  pack()
}
