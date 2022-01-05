export function i18n (path, data) {
  const value = path.split('.').reduce((acc, curr) => acc[curr], i18n.locales[i18n.localeLang])

  if (Array.isArray(value)) {
    return value[data - 1] || val[val.length - 1]
  } else {
    if (value) {
      return value
        .replace(/{[^@}]+}/g, s => data[s.slice(1, -1)])
        .replace(/{@[^}]+}/g, s => {
          let n = null

          const subpath = s.slice(2, -1).replace(/\(.*\)/, argStr => {
            n = data[argStr.slice(1, -1)]

            return '' // removing eventual argument list string
          })

          return i18n(subpath, n === null ? data : n)
        })
    } else {
      return path
    }
  }
}

i18n.locales = {}

i18n.addLocale = (language, dictionary) => {
  i18n.locales[language] = dictionary
}

i18n.setLocale = (language) => {
  i18n.localeLang = language
}
