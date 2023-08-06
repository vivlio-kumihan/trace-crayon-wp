<div class="container">
  <div class="contents">
    <!-- 投稿の一覧ページの`カテゴリー`をクリックするとこのページに飛ぶようにデフォルトで紐づけられている。
    このページ自体が『選択した`カテゴリー`』の`インスタンス`である、それに対する関数を`WP`は定義している。
    それらを使って欲しい情報を適宜出力してページにレイアウトすると考える。 -->
    <!-- 『single_cat_title()』関数でカテゴリー名を出力する。 -->
    <h1><?php single_cat_title(); ?>カテゴリーの一覧</h1>
    <dl>
      <?php // ページ番号を取得する。1ページ目は『0』になるので条件節で変換する。
      $recent_page = get_query_var('paged') ? get_query_var('paged') : 1;
      // 現在カテゴリーの情報を『get_the_category()』関数で引き出す。
      $category = get_the_category();
      // $categoryはオブジェクトで値は一つだけなのでインデックス[0]と特定して呼び出す。
      // キー『slug（url）』に紐づいた値＝現在いるカテゴリーの名称を引き出すという流れ。
      // var_dump($category[0]->slug);
      // var_dump($category[0]);
      $args = array(
        // これはカスタム投稿じゃないからデフォルトのまま。なお省略可能。
        // 'post_type' => 'post',
        // 現在のカテゴリーをslug（url）にして変数に格納する。
        'category_name' => $category[0]->slug,
        // 『-1』は、あるだけ全部出してという意味
        'posts_per_page' => -1,
        // このインスタンスで定義された変数。現在のカテゴリーに対して現在のページ番号が格納されてる。
        'paged' => $recent_page
        // オプションが多数あり、下記参照。
        // 'orderby' => 
      );
      $my_query = new WP_Query($args); ?>

      <?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
          <a href="<?php the_permalink(); ?>">
            <dt><?php the_title(); ?></dt>
            <dd><?php the_excerpt(); ?></dd>
          </a>
        <?php endwhile; ?>
      <?php endif; ?>
    </dl>

    <!-- パンくずリスト -->
    <!-- このリストもWPが構造を書き出す。それに合わせてスタイルをつける。 -->
    <?php
      $args = array(
        'type' => 'list',
        'current' => $recent_page,
        // 現在のインスタンス、つまり全ページの総数を変数に格納している。
        'total' => $my_query->max_num_pages,
        // 記号は適宜
        'prev_text' => '<',
        'next_text' => '>'
      );
      // 『paginate_links()』関数の1行でパンくずリストを出力してる。
      echo paginate_links($args);
    ?>
  </div>
</div>