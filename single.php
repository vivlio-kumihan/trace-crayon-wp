<?php get_header(); ?>


<section class="single-page">
  <!-- サムネールを出力する。 -->
  <!-- 投稿された固定ページのID、出力するimg要素に付けるクラス名を引数にする。 -->
  <div class="frame">
    <?php echo get_the_post_thumbnail($post->ID, 'class-name'); ?>
  </div>

  <ul class="post-categorie">
    <?php
    $category = get_the_category();
    foreach ($category as $attr) {
      echo '<li>' . $attr->name . '</li>';
    }
    ?>
  </ul>
  <!-- 投稿データから記事のタイトルを取得する。 -->
  <h4 class="shrinkLine"><?php the_title(); ?></h4>
  <div class="contents">
    <p>
      <!-- 投稿データから記事の本文を取得する。 -->
      <?php the_content(); ?>
    </p>
    <p class="lastUpdate">
      最終更新日：<time datetime="<?php the_modified_date("Y-m-d"); ?>"><?php the_modified_date("Y/m/d"); ?>
      </time>
    </p>
  </div>
</section>

<?php get_footer(); ?>