// chatGPTに教えられたが効果なし。
gsap.registerPlugin(ScrollTrigger);


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


// GSAP
// TimelineMaxインスタンスを作成
const timeline = gsap.timeline();

// 要素のアニメーションを追加
timeline
  // id="nav-link"
  // id="concept"
  .fromTo('#nav-link', .2, { 
    x: 0
  }, {
    x: '110%',
    ease: 'power1.inOut',
    scrollTrigger: {
      trigger: '#concept',
      start: '0% 10%',
      end: '15% 10%',
      scrub: .2,
      // markers: true
    }
  })
  // id="content-links-btn"
  .fromTo('#content-links-btn', {
    x: '100%'
  }, {
    x: 0,
    ease: 'power1.inout',
    scrollTrigger: {
      trigger: '#concept',
      start: '40% 50%',
      end: '40% 50%',
      scrub: 0,
      // markers: true
    }
  })

////////////
// #content-links-btn, #menu-link ハンバーガーメニュー
const contentLinksBtn = document.getElementById('content-links-btn')
const menuLink = document.getElementById('menu-link')
contentLinksBtn.addEventListener('click', function() {
  this.classList.toggle('active')
  menuLink.classList.toggle('active')
})


// id="philosophy"
gsap.fromTo('#philosophy', .7, {
  opacity: 0,
}, {
  opacity: 1,
  ease: 'power1.easeInOut',
  scrollTrigger: {
    trigger: '#philosophy',
    start: 'top center',
    // 一度アニメーションしたら終わり       
    once: true,
    // markers: true
  }
})

// id="composed-staff"
// id="shadow"
// 『img要素』は『トリガー』に『できない』が、『効果』は『効く』
gsap.fromTo('#shadow', .7, {
  opacity: 1,
}, {
  opacity: 0,
  ease: 'power1.easeInOut',
  scrollTrigger: {
    trigger: '#composed-staff',
    // 画像の上端10%をトリガーに、スクリーンの25%上の地点から
    // アニメーションを開始するという意味。
    start: '10% 25%',
    end: '85% 25%',
    scrub: 1,
    // markers: true
  }
})

// id="behind"
gsap.fromTo('#behind', .7, {
  opacity: 0,
}, {
  opacity: 1,
  ease: 'power1.easeInOut',
  scrollTrigger: {
    trigger: '#composed-staff',
    start: '10% 25%',
    end: '85% 25%',
    scrub: 1,      
    // markers: true
  }
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