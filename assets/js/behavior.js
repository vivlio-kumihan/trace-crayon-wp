// chatGPTに教えられたが効果なし。
gsap.registerPlugin(ScrollTrigger);

// コンソールに出力をする。mountedみたいなんもんか？
// onEnter: () => console.log('コンソール出力はできる')

// 配列を合体させたい場合のconcat()関数
// const moreInfoBtn = Array.from(document.querySelectorAll('.more-info-btn'))
// const arg = leadCopy.concat(moreInfoBtn)


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


////////////
// span, divなど親要素を起点に要素を追加する。
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
const tl = gsap.timeline()

// 要素のアニメーションを追加
// id="nav-link" /////////////////////////////
// id="concept" /////////////////////////////
tl.fromTo('#nav-link', .2, { 
  x: 0
}, {
  x: '110%',
  ease: 'power1.easeInOut',
  scrollTrigger: {
    trigger: '#concept',
    start: '0% 20%',
    end: '5% 20%',
    scrub: .3,
    // markers: true
  }
})

// id="content-links-btn" ////////////////////
.fromTo('#content-links-btn', {
  x: '100%'
}, {
  x: 0,
  ease: 'power1.easeInOut',
  scrollTrigger: {
    trigger: '#concept',
    start: '30% 40%',
    end: '30% 40%',
    scrub: 0,
    // markers: true
  }
})


// #concept ////////////////////////////////////
//    #visual-container ////////////////////////
// 質問
// とりあえずやってみましたが、こんなやり方でいいのですか？
tl.fromTo('#visual-containe-frame', 1, { autoAlpha: 0 }, { autoAlpha: 1, ease: 'Power1.easeInOut' })
tl.fromTo('#copy-one', 1, { autoAlpha: 0 }, { autoAlpha: 1, ease: 'Power1.easeInOut' })
tl.fromTo('#copy-two', .75, { autoAlpha: 0 }, { autoAlpha: 1, ease: 'Power1.easeInOut' }, '-=0.65')
tl.fromTo('#catch-copy', 1, { autoAlpha: 0 }, { autoAlpha: 1, ease: 'Power1.easeInOut' })

ScrollTrigger.create({
  trigger: '#copy-one',
  animation: tl, // 実行するアニメーション
  start: '100% 100%',
  // markers: true
})


// .more-info-btn ////////////////////////////////////
const moreInfoBtn = document.querySelectorAll('.more-info-btn')
const border = document.querySelectorAll('.more-info-btn > .border')

moreInfoBtn.forEach((elem, idx) => {
  // classで要素を集めてforEachで回す場合は、timelineのインスタンスをこのスコープ内で生成させる。
  const tl = gsap.timeline()
  tl.fromTo(elem, 1.25, { autoAlpha: 0 }, { autoAlpha: 1, ease: 'power1.easeOut' })
  tl.fromTo(border[idx], .5, { autoAlpha: 0 }, { autoAlpha: 1, ease: 'power1.easeInOut' }, '-=1')
  ScrollTrigger.create({
    trigger: elem,
    animation: tl,
    start: '50% 50%',
    // markers: true
  })
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
// 配列を合体させたい場合のconcat()関数
const elems =  [document.getElementById('shadow'),
                document.getElementById('behind-dark')]
gsap.fromTo(elems, .7, {
  opacity: 1,
}, {
  opacity: 0,
  ease: 'power1.easeInOut',
  scrollTrigger: {
    trigger: '#composed-staff',
    // 画像の上端10%をトリガーに、スクリーンの25%上の地点から
    // アニメーションを開始するという意味。
    start: '30% 40%',
    end: '60% 40%',
    scrub: 1,
    // markers: true
  }
})

// // id="behind"
// gsap.fromTo('#behind-dark', .7, {
//   opacity: 1,
// }, {
//   opacity: 0,
//   ease: 'power1.easeInOut',
//   scrollTrigger: {
//     trigger: '#composed-staff',
//     start: '10% 25%',
//     end: '85% 25%',
//     scrub: 1,      
//     // markers: true
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
killLetterSpace(leadCopy)