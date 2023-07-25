<div class="container">
  <!-- 理解できてないこと ------------------------------------------ -->
  <!-- リンクから飛んできた時点で、
        カテゴリーのインスタンス（id, url, title, contents, date etc.）は
        どこにあるの？ -->
  <div class="contents">
    <!-- カテゴリーのタグをクリックすると紐づくsingle_cat_title(); -->
    <h1><?php single_cat_title(); ?>カテゴリーの一覧</h1>
    <dl>
      <?php // ページ番号を取得する。1ページ目は『0』になるので条件節で変換する。
        $recent_page = get_query_var('paged') ? get_query_var('paged') : 1;

        // リンク先から飛んできて、カテゴリーの名前は『single_cat_title()』関数で
        // わかるわけだから、変数に格納して『category_name』キーに展開したらいいのか？
        // とやったが全然ダメ。
        $category = single_cat_title();
        $args = array(
        // これはカスタム投稿じゃないからデフォルトのまま。なお省略可能。
        // 'post_type' => 'post',
        'category_name' => $category,
        'posts_per_page' => -1,
        'paged' => $recent_page
        );
        $my_query = new WP_Query($args); ?>

      <?php if ($my_query->have_posts()): while ($my_query->have_posts()): $my_query->the_post(); ?>
        <a href="<?php the_permalink(); ?>">
          <dt><?php the_title(); ?></dt>
          <dd><?php the_excerpt(); ?></dd>
        </a>
      <?php endwhile; ?>
      <?php endif; ?>
    </dl>

    <!-- パンくずリスト -->
    <?php
    $args = array(
      'type' => 'list',
      'current' => $recent_page,
      'total' => $my_query->max_num_pages,
      'prev_text' => '<',
      'next_text' => '>'
    );
    echo paginate_links($args);
    ?>
  </div>
</div>