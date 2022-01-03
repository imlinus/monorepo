export default function uuid () {
  const r = () => Math.random().toString(16).slice(-4)

  return r() + r() + '-' + r() + '-' + r() + '-' + r() + '-' + r() + r() + r()
}


// const idCreator = function* () {
//   let i = 0
//   while (true) yield i++
// }

// const idsGenerator = idCreator()
// const generateId = () => idsGenerator.next().value

// console.log(generateId()) // 0
// console.log(generateId()) // 1
// console.log(generateId()) // 2
