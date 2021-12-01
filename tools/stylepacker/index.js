const path = require('path')
const fs = require('fs')

function grabFile (fileName, relativeFolder, bundled, alreadyIncluded) {
  bundled = bundled || ''

  const filePath = path.resolve(relativeFolder, fileName)

  if (alreadyIncluded.includes(filePath)) {
    return bundled
  }

  alreadyIncluded.push(filePath)

  let content = fs.readFileSync(filePath, 'utf8')

  const matches = content.matchAll(/^\s*@import\s+"(.*)";\s*$/mg)
  
  for (const match of matches) {
    const relativeSubDirectory = path.resolve(relativeFolder, path.dirname(filePath))
    const absoluteSubPath = path.resolve(relativeSubDirectory, match[1])

    const subFile = grabFile(match[1], path.dirname(absoluteSubPath), '', alreadyIncluded)

    content = content.replace(match[0], subFile)
  }

  return bundled + '\n' + content
}

module.exports = entryFile => {
  const fileName = './' + path.basename(entryFile)

  return grabFile(fileName, path.resolve(path.dirname(entryFile)), '', []).trim()
}
