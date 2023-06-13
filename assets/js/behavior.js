////////////
// 属性『letter-spacing: .5em;』を最後の文字だけ取り去る
function killLetterSpace(arr) {
  arr.forEach(elem => {
    let lastChar = elem.textContent.slice(-1)
    let preText = elem.textContent.slice(0, -1)
    elem.innerHTML = `${preText}<span class='remove-letter-spacing'>${lastChar}</span>`
  })
}

// const arg = Array.from(document.querySelectorAll('.lead-copy'))
// // const arg2 = Array.from(document.querySelectorAll('.more-info-btn'))
// // const arg = arg1.concat(arg2)
// killLetterSpace(arg)