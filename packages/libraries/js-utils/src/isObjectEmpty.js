function isObjectEmpty (object) {
  return (
    object && Object.keys(object).length === 0 && object.constructor === Object
  )
}

export default isObjectEmpty
