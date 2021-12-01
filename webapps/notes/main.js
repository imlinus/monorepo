const thrownote = document.querySelector('.thrownote')
const encode = data => btoa(data)
const decode = data => atob(data)

if (window.location.hash.length === 0) {
  thrownote.innerHTML = 'Write a throwaway note'
} else {
  thrownote.innerHTML = decodeURI(decode(window.location.hash.substring(1)))
}

window.location.hash = encodeURI(encode(thrownote.innerHTML))

thrownote.addEventListener('keyup', () => {
  window.location.hash = encodeURI(encode(thrownote.innerHTML))
})
