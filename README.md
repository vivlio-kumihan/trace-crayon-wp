# 230704 講義memo

## HTML
- hrefの中が特に決まっていない時は、`#`だとハッシュをつけるという意味になってしまうので、基本的には空にしておきましょう。
- aタグに`shrinkLine`のクラス名がたくさんついてしまっているところがあるので、できるだけ減らしましょう。
- 以下の場合は、コードをシンプルにするために（行数を減らす為に）１行にしましょう。
```html
<div class="border">
</div>
```
↓
```html
<div class="border"></div>
```

## JS
- GSAPのeaseを使う時は、`power`の右側は1~4です。

## Sass
- z-indexの関数の配列の数を見直しましょう。
- できるだけ、HTMLをシンプルにするために、
以下の場合（componentフォルダでも管理しそうなもの）で、mixinの方で管理しているものに関しては、
クラス名で始めないで、呼び出す時に、クラス名のところで呼び出す。
そうなると、HTMLの該当箇所にクラス名を付けなくて良くなる。
```scss
=shrinkBorderHeader($fontSize: 1.4rem, $bottom: -5px, $lineHeight: 1px, $boderColor: var.$colorLinkHover, $direction: $left_right)
  .shrinkLine // → これを消す
    display: block
    position: relative
    width: 100%
    font-size: $fontSize
    ...
```

- `.anchor-special`は全体設定というよりは部品（コンポーネント）なので、componentフォルダ内にファイルを作りましょう。
- Sassのmixinはlibraryフォルダの中にmixinフォルダを作って、各ファイルを作ってその中で定義しましょう。
- forwards.sassはstyle.sassに読み込み不要です。style.sassはstyle.cssに出力したいファイルのみを@useで読み込ませましょう。
- mixinを呼び出す際に、
```scss
@mixin test($width: 100px, $height: 200px)
```
と定義されている場合、$widthのみを指定したいのであれば、
```scss
@include test($width: 150px)
```
ではなく、
```scss
@include test(150px)
```
とできます！

- mixinを呼び出すときは、そのセレクタ内において、一番上に書くと、
  - mixinの内容を上書きされる恐れがなくなります。
  - mixinの内容を上書きしたい時に書きやすいです。
```scss
li 
  display: inline-block
  + li 
    margin-left: 28px
  +fw.shrinkBorderHeader
```
↓
```scss
li 
  +fw.shrinkBorderHeader
  display: inline-block
  + li 
    margin-left: 28px
```

- 以下のような時はimgを1つにしましょう
```scss
img.copy-one
  top: 25%
  width: 33%
img.copy-two
  top: 43%
  width: 32%
img.catch-copy
  top: 72.5%
  width: 65%
img.frame
  top: 45%
  width: 76%
```
↓
```scss
img
  &.copy-one
    top: 25%
    width: 33%
  &.copy-two
    top: 43%
    width: 32%
  &.catch-copy
    top: 72.5%
    width: 65%
  &.frame
    top: 45%
    width: 76%
```

- 背景の指定はよく以下を使用するので、mixin化しておくと便利です！
```scss
=backgroundImage($path, $size: cover, $position: center)
  background-image: url(#{$path})
  background-size: $size
  background-position: $position
  background-repeat: no-repeat
```

- 全体的にnth-of-typeが多いので、悪いわけでは無いのですが、将来的にコンテンツが変わった時にもバグが起きにくいセレクタにしましょう。（CSSに限った話ではありませんが）

- display: flexの`justify-content: flex-start`は初期値なので、不要です。

- コンテンツが３つあって、将来的に４つ目以降も増える可能性がありそうなところは、
`&:nth-of-type(2), &:nth-of-type(3)`
ではなく
`&:nth-of-type(n+2)`
のようにしましょう