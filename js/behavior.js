// GSAP

// コンソールに出力をする。mountedみたいなものか？
// onEnter: () => console.log('コンソール出力はできる')


// 配列を合体させたい場合のconcat()関数の例
// const moreInfoBtn = Array.from(document.querySelectorAll('.more-info-btn'))
// const arg = leadCopy.concat(moreInfoBtn)


// ////////////
// // 便利だと思ったが、色々なスクリプトの邪魔をするのでとりあえず止める
// // 属性『letter-spacing: .5em;』を最後の文字だけ取り去る
// function killLetterSpace(arr) {
//   arr.forEach(elem => {
//     let lastChar = elem.textContent.slice(-1)
//     let preText = elem.textContent.slice(0, -1)
//     elem.innerHTML = `${ preText }<span class='remove-letter-spacing'>${ lastChar }</span>`
//   })
// }

// const leadCopy = Array.from(document.querySelectorAll('.lead-copy'))
// killLetterSpace(leadCopy)


//////////////////////////////////////////////////// switch
////////////////////////////////////////////////
// ローディング・アニメーション
function loaded() {
  const loading = document.getElementById('loading')
  loading.classList.remove('keep')
}
// ウィンドウを読み込んで2秒後には次に遷移する。
window.addEventListener('load', () => {
  setTimeout(loaded, 0)
  // setTimeout(loaded, 4500)
})
// 最低でも５秒後には表示
setTimeout(loaded, 0)
// setTimeout(loaded, 5000)


// ////////////////////////////////////////////////
// loading animationのロゴ
gsap.timeline()
  .fromTo('.outer_frame',
    { 'stroke-dashoffset': '-1300px' },
    { 'stroke-dashoffset': '0', duration: 1, delay: 1, stagger: .2 })
  .fromTo('.logo_svg',
    { 'stroke-dashoffset': '1300px' },
    { 'stroke-dashoffset': '0', duration: 2.5 }, '-=0.2')
  .to('.outer_frame',
    { opacity: 0, duration: .5, ease: 'power1.inOut' }, '-=1.5')
  .to('.logo_svg',
    { opacity: 0, duration: .5, ease: 'power1.inOut' }, '<')
  .to('.org_logo',
    { opacity: 1, duration: .5, ease: 'power1.inOut' }, '<')


// ////////////////////////////////////////////////
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


// ////////////////////////////////////////////////
// .up-appear
const upAppear = document.querySelectorAll('.up-appear')
upAppear.forEach(elem => {
  gsap.fromTo(elem, .7, {
    y: 20,
    opacity: 0,
  }, {
    y: 0,
    opacity: 1,
    scrollTrigger: {
      trigger: elem,
      start: '0% 80%',
      // markers:true
    }
  })
})


// ////////////////////////////////////////////////
// id="nav-link"
// id="concept"
ScrollTrigger.create({
  trigger: '#main',
  start: '11% 8%',
  toggleClass: {
    targets: ['header', '#content-links-btn'],
    className: 'toggleButtonMenu'
  },
  // markers: true
})

// ////////////////////////////////////////////////
// .anchor-special
// sassに設定するtransitionの影響で、
// リロードすると元にあった位置から指定位置までゴーストする。
// クラス指定追加の作戦で一つにまとめるのは避ける。
// 出現する処理
// フワッとを表現するためstart, endをscrubで設定する。
gsap.to('#anchor-special', {
  scrollTrigger: {
    trigger: '#anchor-special',
    // スクリーンの上辺が『top』
    start: 'top top',
    endTrigger: 'html',
    end: 'bottom top',
    toggleClass: {
      targets: '#anchor-special',
      className: 'active'
    },
    // markers: true
  }
})
// こちらだとアイコンが消えるのでダメ
// ScrollTrigger.create({
//   trigger: '#anchor-special',
//   // スクリーンの上辺が『top』
//   start: 'top top',
//   endTrigger: 'html',
//   end: 'bottom top', 
//   toggleClass: {
//     targets: '#anchor-special',
//     className: 'active'
//   },
//   // markers: true
// })

gsap.to('#anchor-special', {
  scrollTrigger: {
    trigger: '#main',
    start: 'bottom bottom',
    endTrigger: 'html',
    end: 'bottom top',
    toggleClass: {
      targets: '#anchor-special',
      className: 'fixed'
    },
    // markers: true,
  }
})
// ScrollTrigger.create({
//   trigger: '#main',
//   start: 'bottom bottom',
//   endTrigger: 'html',
//   end: 'bottom top',
//   toggleClass: {
//     targets: '#anchor-special',
//     className: 'fixed'
//   },
//   // markers: true 
// })
// // 任意の位置でくっつく処理
// ScrollTrigger.create({
//   trigger: '#anchor-special',
//   start: 'top 88%',
//   // endTriggerでrelativeをスイッチできる。
//   // 上から引き継いだ場所からpinする。
//   endTrigger: '#main',
//   end: '100% 100%',
//   pin: true,
//   // markers: true
// })

// //////////////////////////////////////////////// 
// #concept
//    #visual-container
//    #philosophy
const tlConcept = gsap.timeline({
  defaults: {
    opacity: 0
  },
  scrollTrigger: {
    trigger: '#copy-one',
    start: 'top 60%',
    // markers: true
  }
})
tlConcept
  .fromTo('#visual-containe-frame', .7, {}, { opacity: 1, ease: 'power1.inOut' })
  .fromTo('#copy-one', .3, {}, { opacity: 1, ease: 'power1.in' }, '+=0.3')
  .fromTo('#copy-two', .5, {}, { opacity: 1, ease: 'power1.in' })
  .fromTo('#catch-copy', 1.3, {}, { opacity: 1, ease: 'power1.inOut' })
  .fromTo('#concept > p', 1.3, { y: 20 }, { y: 0, opacity: 1 }, '-=0.3')
  .fromTo('#philosophy', 1.3, {}, { opacity: 1 }, '-=1')



// ////////////////////////////////////////////////
// .more-info-btn
const moreInfoBtn = document.querySelectorAll('.more-info-btn')
const border = document.querySelectorAll('.more-info-btn > .border')

moreInfoBtn.forEach((elem, idx) => {
  // classで要素を集めてforEachで回す場合は、timelineのインスタンスをこのスコープ内で生成させる。
  const tl = gsap.timeline()
  tl.fromTo(elem, 1.25, { opacity: 0 }, { opacity: 1, ease: 'power1.easeOut' })
  tl.fromTo(border[idx], .5, { opacity: 0 }, { opacity: 1, ease: 'power1.inOut' }, '-=1')
  ScrollTrigger.create({
    trigger: elem,
    animation: tl,
    start: '0% 90%',
    // markers: true
  })
})


// ////////////////////////////////////////////////
// #content-links-btn, #menu-link ハンバーガーメニュー
const contentLinksBtn = document.getElementById('content-links-btn')
const menuLink = document.getElementById('menu-link')
contentLinksBtn.addEventListener('click', function() {
  this.classList.toggle('active')
  menuLink.classList.toggle('active')
})


// ////////////////////////////////////////////////
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
  ease: 'power1.inOut',
  scrollTrigger: {
    trigger: '#composed-staff',
    // 画像の上端10%をトリガーに、スクリーンの25%上の地点から
    // アニメーションを開始するという意味。
    start: '30% 60%',
    end: '60% 50%',
    scrub: 1,
    // markers: true
  }
})


// ////////////////////////////////////////////////
// .service .header-block-appear
const header2 = Array.from(document.querySelectorAll('.header-block-appear h2'))
const header3 = Array.from(document.querySelectorAll('.header-block-appear h3'))
const headerAppear = header2.concat(header3)
headerAppear.forEach(elem => {
  gsap.from(elem, .7, {
    opacity: 0,
    scrollTrigger: {
      trigger: elem,
      start: '0% 70%',
      ease: 'power1.inOut',
      // markers: true
    }
  })
})


// ////////////////////////////////////////////////
// .lead-copy.per-char

// 一文字ずつ現れる
// ドキュメント上の該当文章を一文字ごとバラバラにしていく。
// 属性『letter-spacing: none;』を最後の文字だけ字間のアキを取り去る
function splitText(className) {
  className.forEach(elem => {
    let htmlContent = elem.innerHTML
    let tmpText = ""
    htmlContent.split('<br>').forEach((sentence, idx, arr) => {
      let preText = Array.from(sentence).slice(0, -1)
      let lastChar = Array.from(sentence).slice(-1)
      preText.forEach((char) => {
        tmpText += `<span>${char}</span>`
      })
      tmpText = `${ tmpText }<span class='remove-letter-spacing'>${ lastChar }</span>`
      // 最後の部分以外はbrタグを追加
      if (idx < arr.length - 1) {
        tmpText += '<br>'
      }
    })
    elem.innerHTML = tmpText
  })
}

// .lead-copy.per-charを収集する。
const leadCopy = document.querySelectorAll('.lead-copy.per-char')
// textContentをspanで1文字ずばバラバラにして要素へ格納する。
splitText(leadCopy)

leadCopy.forEach(elem => {
  const tl = gsap.timeline({
    defaults: {
      opacity: 0,
      ease: 'power1.inOut',
      stagger: .1
    },
    scrollTrigger: {
      trigger: elem,
      start: '50% 80%',
      // markers: true
    }
  })
  tl.from(elem, {})
    .from(elem.children, {}, '-=0.25')
})


// ////////////////////////////////////////////////
// #contact
const tlContact = gsap.timeline({
  defaults: {
    duration: 1,
    opacity: 0,
    ease: 'power3.out'
  },
  scrollTrigger: {
    trigger: '#contact',
    start: '0% 50%',
    // markers: true
  }
})
tlContact.fromTo('#contact > a', { }, { opacity: 1 })
.from('#contact > p', { }, .5)
.from('#contact > ul', { }, .5)


// ////////////////////////////////////////////////
// slide
const swiper = new Swiper('.swiper', {
  loop: true,
  slidesPerView: 3,
  breakpoints: {
    // スライドの表示枚数：スクリーン幅360px以上の場合
    360: {
      slidesPerView: 1.9,
    },
    // スライドの表示枚数：スクリーン幅897px以上の場合
    897: {
      slidesPerView: 3,
    },
  },
  speed: 10000,
  spaceBetween: '.8%',
  // スクリーンを叩いてスライドが止まるのを防ぐ。
  allowTouchMove: false,
  // ５つのスライド、３つの表示、残り２つの場合などスライドの動きがおかしくなるのを防ぐトリッキーな技
  // スライド量をHTMLでn倍にするのではなく、JSからコントロールする。
  loopedSlides: 2,
  autoplay: {
    delay: 0
  }
})


// ////////////////////////////////////////////////
// projectのpoint
const points = Array.from(document.getElementById('point').children)
points.forEach(elem => {
  let el = gsap.utils.selector(elem);
  gsap.timeline({
    scrollTrigger: {
      trigger: elem,
      start: '0% 50%',
      pused: true,
      // markers: true
    }
  }).to(elem, .4, { opacity: 1 })
    .to(elem, .4, { onUpdate: () => { elem.classList.add('open') } })
    .fromTo(el('svg path'), 1.5,  { 'stroke-dasharray': '1000px', 'stroke-dashoffset': '1000px' },
                                  { 'stroke-dashoffset': '2000px' }, '-=0.8')
})

points.forEach(elem => {
  let el = gsap.utils.selector(elem);
  gsap.timeline({
    scrollTrigger: {
      trigger: elem,
      start: '40% 47%',
      pused: true,
      // markers: true
    }
  }).to(el('div'), .7, { opacity: 1 })
    .to(el('h4'), .7, { opacity: 1 })
    .to(el('p:first-of-type'), .7, { opacity: 1 })
    .to(el('p:last-of-type'), .7, { opacity: 1 }, '-=0.3')
})

// news
const news = document.getElementById('news')
const el = gsap.utils.selector(news)
const lists = document.querySelectorAll('#news li')
let mm = gsap.matchMedia();

mm.add("(min-width: 897px)", () => {
  // desktop setup code here...
  gsap.timeline({
    defaults: {
      opacity: 0, 
      ease: 'power1.inOut'
    },
    scrollTrigger: {
      trigger: news,
      start: 'top 40%',
      // markers: true
    }
  }).from(el('h2'), .7, {})
    .from(el('ul'), .7, { y: 50 })
})
  
// mm.add("(max-width: 896px)", () => {
//   gsap.from(el('h2'), .4, {
//     opacity: 0,
//     scrollTrigger: {
//       trigger: news,
//       start: 'top 80%'
//     }
//   })
//   lists.forEach(li => {
//     gsap.from(li, .7, {
//       opacity: 0,
//       y: 50,
//       scrollTrigger: {
//         trigger: li,
//         start: 'top 80%',
//         stagger: true,
//         // markers: true
//       }
//     })
//   })
// })