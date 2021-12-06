const logError = path => {
  console.log(crayon.inverse(path))
  console.log(`${crayon.error('error')} Directory is not allowed`)
}

const logErrorsStats = errorPathes => {
  console.log('')
  console.log(`dir-lint: ${errorPathes.length} error(s) found`)
}

const logSuccess = () => {
  console.log(crayon.success('All of the directories are allowed'))
}

module.exports = {
  logError,
  logErrorsStats,
  logSuccess
}
