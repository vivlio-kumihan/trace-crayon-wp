// chatGPTに教えられたが効果なし。消してしまう予定。
gsap.registerPlugin(ScrollTrigger);
// GSAP
// TimelineMaxインスタンスを作成
const tl = gsap.timeline()

// コンソールに出力をする。mountedみたいなものか？
// onEnter: () => console.log('コンソール出力はできる')


// 配列を合体させたい場合のconcat()関数の例
// const moreInfoBtn = Array.from(document.querySelectorAll('.more-info-btn'))
// const arg = leadCopy.concat(moreInfoBtn)


////////////
// ローディング・アニメーション
function loaded() {
  const loading = document.getElementById('loading')
  loading.classList.remove('keep')
}
// ウィンドウを読み込んで2秒後には次に遷移する。
window.addEventListener('load', () => {
  setTimeout(loaded, 2000)
})

// 最低でも５秒後には表示
setTimeout(loaded, 5000)


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

// for .more-info-btn .boder
document.querySelectorAll('.border').forEach(elem => {
  elem.insertAdjacentHTML('afterbegin', '<span></span><span></span><span></span><span></span><span></span><span></span>')
})

// 質問
// 振る舞いをコピーできない。/////////////////////////////////////
const specialLink = document.getElementById('special')
gsap.fromTo(specialLink, .5, {
  autoAlpha: 0
}, {
  autoAlpha: 1,
  scrollTrigger: {
    trigger: '#concept',
    start: '0% 50%',
    // markers: true
  }
})


////////////
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

const preChar = document.querySelectorAll('.per-char')
splitText(preChar)

preChar.forEach(elem => {
  // 質問　timelineを使ってやれるはずだができない。 /////////////////////
  gsap.from(elem, .3, {
    autoAlpha: 0, ease: 'Power1.easeInOut',
    scrollTrigger: {
      trigger: elem,
      start: '50% 50%',
      // markers: true
    }
  })
  gsap.from(elem.children, .3, {
    autoAlpha: 0,
    ease: 'Power1.easeInOut',
    stagger: .1,
    scrollTrigger: {
      trigger: elem,
      start: '50% 50%',
      // markers: true
    }
  })
})

const upAppear = document.querySelectorAll('.up-appear')
upAppear.forEach(elem => {
  gsap.fromTo(elem, .7, {
    y: 20,
    autoAlpha: 0,
  }, {
    y: 0,
    autoAlpha: 1,
    scrollTrigger: {
      trigger: elem,
      start: '0% 50%',
      // markers:true
    }
  })
})


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

const para =  document.querySelector('#concept > p')
gsap.fromTo(para, .7, {
  y: 20,
  autoAlpha: 0
}, {
  y: 0,
  autoAlpha: 1,
  scrollTrigger: {
    trigger: para,
    start: '0% 70%',
    // markers: true
  }
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
    start: '0% 90%',
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


const header2 = Array.from(document.querySelectorAll('.header-block-appear h2'))
const header3 = Array.from(document.querySelectorAll('.header-block-appear h3'))
const headerAppear = header2.concat(header3)
headerAppear.forEach(elem => {
  gsap.from(elem, .7, {
    autoAlpha: 0,
    scrollTrigger: {
      trigger: elem,
      start: '0% 70%',
      ease: 'Power1.easeInOut',
      // markers: true
    }
  })
})

// 質問　結局、タイムラインは個別で作らないといけないの？ 理解できてない。/////////////////////////////////////
tlContact = gsap.timeline()
tlContact.fromTo('#contact > a', .3, { autoAlpha: 0 }, { autoAlpha: 1 })
  .from('#contact > p', .3, { autoAlpha: 0 }, 1)
  .from('#contact > ul', .3, { autoAlpha: 0 }, 1)

ScrollTrigger.create({
  trigger: '#contact',
  animation: tlContact, // 実行するtimeline
  start: '0% 50%',
  // markers: true
})


const swiper = new Swiper('.swiper', {
  loop: true,
  slidesPerView: 3,
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

const points = Array.from(document.getElementById('point').children)
points.forEach(elem => {
  tlPoint = gsap.timeline()
  let el = gsap.utils.selector(elem);
  tlPoint.to(elem, .3, { onUpdate: () => { elem.classList.add('open') } })
    .to(el('div'), .3, { autoAlpha: 1 })
    .to(el('h4'), .3, { autoAlpha: 1 })
    .to(el('p:first-of-type'), .3, { autoAlpha: 1 })
    .to(el('p:last-of-type'), .3, { autoAlpha: 1 })
  ScrollTrigger.create({
    trigger: elem,
    animation: tlPoint,
    start: '0% 50%',
    pused: true,
    markers: true
  })
})

// scrollTrigger: {
//   trigger: elem,
//   start: '0% 50%',
//   ease: 'Power1.easeInOut',
//   markers: true
// }
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