// ////////////
// // ローディング・アニメーション
// function loaded() {
//   const loading = document.getElementById('loading')
//   loading.classList.remove('keep')
// }
// // ウィンドウを読み込んで2秒後には次に遷移する。
// window.addEventListener('load', () => {
//   setTimeout(loaded, 1500)
// })

// // 最低でも５秒後には表示
// setTimeout(loaded, 5000)


// ////////////
// // ハンバーガー・メニュー
// const toSectionLinkBtn = document.getElementById('content-links-btn')
// const contentsLinks = document.getElementById('contents-links')
// const linksLi = document.getElementById('contents-links').children

// // メニューの切り替え
// toSectionLinkBtn.addEventListener('click', function () {
//   this.classList.toggle('active')
//   this.nextElementSibling.classList.toggle('appear')
// })

// // リンクをクリックでページ内スクロールの際にメニューを閉じる。
// Array.from(linksLi).forEach(el => {
//   el.addEventListener('click', () => {
//     toSectionLinkBtn.classList.remove('active')
//     contentsLinks.classList.remove('appear')
//   })
// })


////////////
// span, divなど要素をJSで追加する。
// // 引数の意味
//    'beforebegin'  要素の直前に追加
//    'afterbegin'   要素の最初の子要素として追加
//    'beforeend'    要素の最後の子要素として追加
//    'afterend'     要素の直後に追加
// for content-links-btn div
document.getElementById('content-links-btn').insertAdjacentHTML('afterbegin', '<div></div><div></div><div></div>')

// for .more-info-btn .boder
document.querySelectorAll('.border').forEach(elem => {
  elem.insertAdjacentHTML('afterbegin', '<span></span><span></span><span></span><span></span><span></span><span></span>')
})

// const navLink = document.getElementById('nav-link')
// const concept = document.getElementById('concept')

// gsap.fromTo(navLink, .7, {
//   opacity: 1,
//   x: 0,
// }, {
//   scrollTrigger: {
//     trigger: concept,
//     start: 'top center',
//     // end: 'top center',
//     opacity: 0,
//     x: '100%',
//     ease: 'power3.easeOut',
//     markers: true,
//     onEnter: () => console.log('コンソール出力はできる'),
//   }
// })

////////////
// 属性『letter-spacing: .5em;』を最後の文字だけ取り去る
function killLetterSpace(arr) {
  arr.forEach(elem => {
    let lastChar = elem.textContent.slice(-1)
    let preText = elem.textContent.slice(0, -1)
    elem.innerHTML = `${ preText }<span class='remove-letter-spacing'>${ lastChar }</span>`
  })
}

const leadCopy = Array.from(document.querySelectorAll('.lead-copy'))
// const moreInfoBtn = Array.from(document.querySelectorAll('.more-info-btn'))
// const arg = leadCopy.concat(moreInfoBtn)
killLetterSpace(leadCopy)