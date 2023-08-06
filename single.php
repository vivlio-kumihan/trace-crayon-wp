<?php get_header(); ?>

<div class="frame-archive-top">
  <h1 class="section-title"><span lang="en">BLOG</span><br><span lang="ja">ブログ</span></h1>
  <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
    <?php if (function_exists('bcn_display')) {
      bcn_display();
    } ?>
  </div>
  <img src="<?php echo get_template_directory_uri(); ?>/img/mv-bg.jpg" alt="">
</div>

<section class="single-page">
  <ul class="post-categorie">
    <li class="lastUpdate">
      <time datetime="<?php the_modified_date("Y-m-d"); ?>"><?php the_modified_date("Y-m-d"); ?></time>
    </li>
    <?php
    // 前の一覧ページからこの記事のリンクをクリックして飛んできた。
    // この記事に紐づいているカテゴリーの抽出の仕方というのはわかる。
    // 一つの記事に一つのカテゴリーだったら『the_category()』関数でもいいのか？
    $category = get_the_category();
    foreach ($category as $attr) {
      echo '<li class=this-category>#' . $attr->name . '</li>';
    }
    ?>
  </ul>
  <h1 class="blog-heading one"><?php the_title(); ?></h1>
  <div class="contents">
    <div>
      <?php the_content(); ?>
    </div>
  </div>
</section>

<div class="about-author">
  <header>この会社についての記事です</header>
  <?php $author = get_userdata($post->post_author);  ?>
  <div class="author-icon">
    <?php echo get_avatar($author->user_email, 300); ?>
  </div>
  <ul class="author-info">
    <li class="author-name">
      <?php echo $author->display_name; ?>
    </li>
    <li class="author-nickname">
      <?php echo $author->nickname; ?>
    </li>
    <li class="author-profile">
      <span>略歴</span><br>
      <?php echo $author->description; ?>
    </li>
  </ul>
</div>


<div class="page-nav">
  <div class="previous-page">
    <?php previous_post_link('%link', '前の記事へ'); ?>
  </div>
  <a class="back-to-index" href="<?php echo home_url('/archive') ?>">
    一覧へ戻る
  </a>
  <div class="behind-page">
    <?php next_post_link('%link', '次の記事へ'); ?>
  </div>
</div>



<div class="recomend">
  <h1>おすすめの記事<br><span lang="en">RECOMMENDATION</span></h1>
  <ul class="post-archive">
    <!-- front-pageから記事をクリックしたらsingleページに飛ぶ
          その記事のカテゴリー一覧を出す方法 -->
    <?php
    // 最初のページは0だから、1と修正するだけのコード（パンくずリスト用でもある。）
    $recent_page = get_query_var('paged') ? get_query_var('paged') : 1;
    // singleページにいる。ページごとにインスタンスを持っている。
    // そのインスタンスへ関数当てたらこのページのカテゴリーがわかるということ。
    $category = get_the_category();
    // このページで展開するアーカイブ記事の仕様を設定する。
    $args = array(
      'category_name' => $category[0]->slug,
      'posts_per_page' => 3,
      'paged' => $recent_page,
      'orderby' => 'rand'
    );
    $my_query = new WP_Query($args);
    if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post();
    ?>
        <li>
          <a href="<?php the_permalink(); ?>">
            <div class="frame">
              <?php the_post_thumbnail(); ?>
            </div>
            <div class="header-sub">
              <ul class="post-categorie">
                <?php
                $category = get_the_category();
                foreach ($category as $attr) {
                  echo '<li>' . $attr->name . '</li>';
                }
                ?>
              </ul>
              <time datetime="<?php echo get_the_date("Y-m-d"); ?>"><?php echo get_the_date("Y.m.d"); ?></time>
            </div>
            <h4 class="shrinkLine"><?php the_title(); ?></h4>
            <?php
            add_filter('excerpt_length', function ($length) {
              return 50;
            }, 999);
            ?>
            <p><?php the_excerpt(); ?></p>
          </a>
        </li>
    <?php endwhile;
    endif; ?>
  </ul>

  <a href="<?php echo home_url('/archive') ?>">
    <div class="more-info-btn">
      ブログ一覧を見る
      <div class="border"></div>
    </div>
  </a>
</div>

<?php get_sidebar(('banners')); ?>

<section id="contact" class="contact">
  <p>電気のことでお困りの際は<br class="for-sp">気軽にご相談ください</p>
  <a href="">電気工事のご依頼・ご相談はこちら</a>
  <ul>
    <li lang="en">0721-23-5658</li>
    <li><span>受付時間</span>&emsp;平日&nbsp;<span lang="en"><time datetime="09:00">9:00&thinsp;-&thinsp;<time datetime="17:00"></time>17:00</span></li>
  </ul>
</section>

<?php get_footer(); ?>