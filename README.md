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

# 0711 講義メモ

# コードレビュー

## ファイル構成
- assetsの中に含めてしまうと、パスが全体的に長くなってしまうので、テーマ直下に移動した方がいいかもしれません。

## ワードプレス
- headのタイトルタグは、functions.phpに`add_theme_support( 'title-tag' );`を追記しましょう。
ただし、SEO対策をきちんとしていくサイトは、「All in One SEO」などのプラグインで各ページ個別のタイトルと説明文を設定できるようにしましょう。
- 自分で記述しているCSSは他のCSSよりも後に読み込みましょう
- 表示する投稿数などを指定する場合は、サブループで書いてあげると良いです。（front-page.php 200行目あたりに書きました。）
- １ページを今まで通り単純にHTMLコーディングする場合は、カスタムテンプレートという機能を使います。

## 投稿数
`設定／表示設定／1ページに表示する最大投稿数`で、
ブログの投稿数をこれを1ページにしておく。
該当するページにてphpで変更する。
```php
<?php 
  // 3ページだけ取ってくるという状態を変数に格納。
  $args = array('posts_pre_page' => 3); 
  // このインスタンスで機能しているDBへ引数として渡し、
  // 該当データを変数へ保存。
  $my_query = new WP_Query($args);
  // 非常に違和感がある書き方をするが慣れんと仕方ない。
  // こういう書き方でデータを収集する。。。
  if ($my_query -> have_posts()) : while ($my_query -> have_posts()) : $my_query -> the_post(); 
?> 
```

## 入れ子になった場合に構造の崩れを回避する方法

```html
<div class="header-sub">
  <h5>
    <ul class="post-categories">
      <?php
        // 『the_category()』を配列にして出力すには、
        // 『get_the_category()関数』を使う。
        // 『the_category()』の属性が配列として取れた。
        $category = get_the_category();
        // name属性をキーにして値を取り出す。
        foreach($category as $attr) {
          echo '<li>'.$attr -> name.'</li>';
        }
      ?>
    </ul>
  </h5>
  <time datetime="<?php echo get_the_date("Y-m-d") ?>"><?php echo get_the_date("Y年m月d日") ?></time>
</div>
```


escape

```html
  <!-- <ul class="postList">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <li>
          <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail(); ?>
            <div class="header-sub">
              <time datetime="<?php echo get_the_date("Y-m-d") ?>"><?php echo get_the_date("Y年m月d日") ?></time>
              <h5><?php the_category(); ?></h5>
            </div>
            <h4 class="shrinkLine"><?php the_title(); ?></h4>
            <p><?php the_excerpt(); ?></p>
          </a>
        </li>
    <?php endwhile;
    endif; ?>
  </ul> -->

  <!-- <ul>
    <li>
      <a href="">
        <img src="<?php echo get_template_directory_uri(); ?>/img/blog_john-salvino-QXgPXa6ydzg-unsplash-scaled.jpg" alt="工事現場の足場を登る社員のイメージ">
      </a>
      <div class="header-sub">
        <h5>採用関連</h5>
        <time datetime="2023-06-06">2023.06.06</time>
      </div>
      <h4 class="shrinkLine">「くれよんで働く」ってどうゆうこと…？</h4>
      <p>季節の変わり目！と感じるような天候が続く今日この頃、皆さんいかがお過ごしですか？暑くなったり、寒く……</p>
    </li>
    <li>
      <a href="">
        <img src="<?php echo get_template_directory_uri(); ?>/img/blog_220326_group_photo_002.jpg" alt="制服を着てリラックスした様子の社員の集合写真">
      </a>
      <div class="header-sub">
        <h5>職人の素顔</h5>
        <time datetime="2023-05-30">2023.05.30</time>
      </div>
      <h4><a href="" class="shrinkLine">小さな積み重ねが実を結ぶ…</a></h4>
      <p>今回のBlogは、職人達が現場で何気なくしている事からお褒めの言葉を頂いた件について書いてみようと……</p>
    </li>
    <li>
      <a href="">
        <img src="<?php echo get_template_directory_uri(); ?>/img/blog_sonja-langford-eIkbSc3SDtI-unsplash-scaled.jpg" alt="時計の文字盤のイメージ">
      </a>
      <div class="header-sub">
        <h5>電気工事</h5>
        <time datetime="2023-05-23">2023.05.23</time>
      </div>
      <h4><a href="" class="shrinkLine">職人の一日って…？</a></h4>
      <p>職人の仕事は現場で基本仕事をしている。現場は安全管理の観点から死角になっている場合が多い。だから職…… </p>
    </li>
  </ul> -->
```