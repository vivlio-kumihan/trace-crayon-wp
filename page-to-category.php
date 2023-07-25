<?php /* Template Name: カテゴリーのリスト */ ?>

<ul class="postsList">
  <?php
    $args = array('posts_per_page' => 6);
    $my_query = new WP_Query($args);
    if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
      <li>
        <a href="<?php the_permalink(); ?>">
          <!-- img要素の場合 -->
          <!-- the_post_thumbnail();をphpのタグで囲む -->
          <div class="thumbnail" style="background-image: url(<? echo wp_get_attachment_url(get_post_thumbnail_id()); ?>)"></div>
          <h2><?php the_title(); ?></h2>
          <time datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date('Y年m月d日'); ?></time>
          <p><?php the_excerpt(); ?></p>
        </a>
        <?php the_category(); ?>
      </li>
  <?php endwhile; endif; ?>
</ul>