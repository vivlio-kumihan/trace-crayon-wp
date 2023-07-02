// GSAP

// コンソールに出力をする。mountedみたいなものか？
// onEnter: () => console.log('コンソール出力はできる')


// 配列を合体させたい場合のconcat()関数の例
// const moreInfoBtn = Array.from(document.querySelectorAll('.more-info-btn'))
// const arg = leadCopy.concat(moreInfoBtn)


//////////////////////////////////////////////////// switch
////////////////////////////////////////////////
// ローディング・アニメーション
function loaded() {
  const loading = document.getElementById('loading')
  loading.classList.remove('keep')
}
// ウィンドウを読み込んで2秒後には次に遷移する。
window.addEventListener('load', () => {
  setTimeout(loaded, 4500)
})
// 最低でも５秒後には表示
setTimeout(loaded, 5000)


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
    { opacity: 0, duration: .5, ease: 'power.inOut' }, 2.5)
  .to('.logo_svg',
    { opacity: 0, duration: .5, ease: 'power.inOut' }, 2.5)
  .to('.org_logo',
    { opacity: 1, duration: 1, ease: 'power.inOut'}, 3.5)


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
// .lead-copy.per-char

// 一文字ずつ現れる
// ドキュメント上の該当文章を一文字ごとバラバラにしていく。
function splitText(className) {
  className.forEach(elem => {
    let htmlContent = elem.innerHTML
    let result = ""
    htmlContent.split('<br>').forEach((part, index, array) => {
      Array.from(part).forEach((char) => {
        result += `<span>${char}</span>`
      })
      // 最後の部分以外はbrタグを追加
      if (index < array.length - 1) {
        result += '<br>'
      }
    })
    elem.innerHTML = result
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
      start: '50% 50%',
      // markers: true
    }
  })
  tl.from(elem, {})
    .from(elem.children, {}, '-=0.25')
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
      start: '0% 70%',
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
  }
})

// ////////////////////////////////////////////////
// .anchor-special
// sassに設定するtransitionの影響で、
// リロードすると元にあった位置から指定位置までゴーストする。
// クラス指定追加の作戦で一つにまとめるのは避ける。
// 出現する処理
// フワッとを表現するためstart, endをscrubで設定する。
gsap.to('#anchor-special', {
  opacity: 1,
  ease: 'power1.inOut',
  scrollTrigger: {
    trigger: '#main',
    start: '11% 15%',
    end: '12% 15%',
    scrub: true,
    // markers: true
  }
})

// 任意の位置でくっつく処理
// 簡単に見えるけど辿り着くまで時間かかった。
ScrollTrigger.create({
  trigger: '#contents',
  start: 'top top',
  end: '90.5%',
  pin: '#anchor-special',
  // markers: true
})


// //////////////////////////////////////////////// 
// #concept
//    #visual-container
const tlConcept = gsap.timeline({
  scrollTrigger: {
    trigger: '#copy-one',
    start: '100% 100%',
    // markers: true
  }
})
tlConcept.fromTo('#visual-containe-frame', 1, { opacity: 0 }, { opacity: 1, ease: 'power1.inOut' })
  .fromTo('#copy-one', 1, { opacity: 0 }, { opacity: 1, ease: 'power1.inOut' })
  .fromTo('#copy-two', .75, { opacity: 0 }, { opacity: 1, ease: 'power1.inOut' }, '-=0.65')
  .fromTo('#catch-copy', 1, { opacity: 0 }, { opacity: 1, ease: 'power1.inOut' })


const para =  document.querySelector('#concept > p')
gsap.fromTo(para, .7, {
  y: 20,
  opacity: 0
}, {
  y: 0,
  opacity: 1,
  scrollTrigger: {
    trigger: para,
    start: '0% 70%',
    // markers: true
  }
})


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
// id="philosophy"
gsap.fromTo('#philosophy', .7, {
  opacity: 0,
}, {
  opacity: 1,
  ease: 'power1.inOut',
  scrollTrigger: {
    trigger: '#philosophy',
    start: 'top center',
    // 一度アニメーションしたら終わり       
    once: true,
    // markers: true
  }
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
    start: '30% 40%',
    end: '60% 40%',
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
// #contact
const tlContact = gsap.timeline({
  defaults: {
    duration: 0.3
  },
  scrollTrigger: {
    trigger: '#contact',
    start: '0% 50%',
    // markers: true
  }
})
tlContact.fromTo('#contact > a', { opacity: 0 }, { opacity: 1 })
.from('#contact > p', { opacity: 0 }, .5)
.from('#contact > ul', { opacity: 0 }, .5)


// ////////////////////////////////////////////////
// slide
const windowWidth = window.innerWidth
const swiper = new Swiper('.swiper', {
  loop: true,
  slidesPerView: 3,
  breakpoints: {
    // スライドの表示枚数：360px以上の場合
    360: {
      slidesPerView: 1.9,
    },
    // スライドの表示枚数：897px以上の場合
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
  }).to(elem, .3, { opacity: 1 })
    .to(elem, .3, { onUpdate: () => { elem.classList.add('open') } })
    .fromTo(el('svg path'), .7, { 'stroke-dasharray': '1000px', 'stroke-dashoffset': '1000px' },
                                { 'stroke-dashoffset': '2000px' }, '-=0.7')
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
  }).to(el('div'), .3, { opacity: 1 })
    .to(el('h4'), .3, { opacity: 1 })
    .to(el('p:first-of-type'), .3, { opacity: 1 })
    .to(el('p:last-of-type'), .3, { opacity: 1 })
})


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