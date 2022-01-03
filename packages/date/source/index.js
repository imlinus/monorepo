const format = {
  YYYY: 'getFullYear',
  YY: 'getYear',
  MM: d => d.getMonth() + 1,
  DD: 'getDate',
  HH: 'getHours',
  mm: 'getMinutes',
  ss: 'getSeconds',
  unix: 'valueOf',
}

const is = {
  str: str => str.constructor === String
}

export default function date (str) {
  let parts = []
  let offset = 0

  str.replace(/([^{]*?)\w(?=\})/g, (key, _, i) => {
    const lng = key.length
    parts.push(str.substring(offset, i - 1))
    offset = i += lng + 1

    parts.push(date => {
      if (key === 'unix') {
        return date[format[key]]()
      } else {
        return ('00' + (
          is.str(format[key])
            ? date[format[key]]()
            : format[key](date)
        )).slice(-lng)
      }
    })
  })

  if (offset !== str.length) {
    parts.push(str.substring(offset))
  }

  return function (arg) {
    const date = arg || new Date()
    let output = ''

    for (let i = 0; i < parts.length; i++) {
      output += is.str(parts[i]) ? parts[i] : parts[i](date)
    }

    return output
  }
}
