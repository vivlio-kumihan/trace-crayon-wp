# 230807 講義memo

__髙廣__

- 一覧へ戻る、前の記事、次の記事　作成方法まとめる
- おすすめ記事　カテゴリーの記事を3件ランダムに選択して表示させる　作成方法まとめる
- この会社についての記事です　投稿者プロフィールを使う作成方法をまとめる
- この記事をシェアする　作成方法をまとめる

- この記事をシェアするの掲載場所を変更するやり方
- front-pageでGSAPは効く。single.phpでは効かない。
- 投稿一件、投稿最初の一件を除いた複数記事　'offset' => 1　ページネーションが無効になる

















# 230725 講義memo

__髙廣から__
## 固定ページの新規追加
- 固定ページを新規追加する方法は理解した。
- ダッシュボード／固定ページ／新規追加でページを追加する。=> 日本語で良い。（例）`会社情報`
- ダッシュボード上のページを編集する。=> パーマリンクは英語にする。（例）`link/to/path/company`
- ディレクトリにパーマリンクの名称`page-company.php`でファイルを新規作成。
- 当該ファイルの先頭に下記タグを記述する。

```
<?php /* Template Name: 会社情報　*/ ?>
```
これで、`https://root/path/campany`でアクセス可能になる。

## 任意のページへのリンク方法
HTML（PHP）にURLを記述する方法として、indexページへは、
`<a href="<?php echo home_url('/') ?>">`

では、その他、固定ページへのリンクは設定したパーマリンク名となる。
例えば、ダッシュボード／パーマリンク名が`link/to/path/contact`の場合は、
`<a href="<?php echo home_url('/contact/'); ?>">`

## カテゴリー記事の一覧

`front-page.php`に`<?php the_category() ?>`を敷設すると、
それぞれの記事に付随したカテゴリーを得ることができる。
そのカテゴリーをクリックするとデフォルトで表示場所が決まっている`category.php`へ飛ぶ。
現状では、カテゴリー内の記事だけを一覧することができない。
`category.php`へ色々と試したコメント残しているので参照しながら説明する。

## 記事の表示の仕方

- ブログのページ（`archive.php`）で、最新の1記事とそれ以下の複数記事の表示のさせ方がわからない。
- 一覧されているブログのインデックスをクリックするとその記事に飛ぶ。記事ページでは自身のカテゴリーはわかっているから、そのカテゴリーの記事一覧を表示できるはず。現状やり方がわからない。

## Contact Form7が出てこない

実演する。

---



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

『the_permalink()』の内側に、リスト要素を発生させるで生成させる『the_category()』を入れ子にすると、『the_permalink()』で生成したa要素の括りの構造を破壊する。回避方法は、『the_category()』を配列にして出力すること。

```php

<div class="header-sub">
  <h5>
    <ul class="post-categorie">
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