<?php /* Template Name: ブログ　*/ ?>

<?php get_header(); ?>

<div class="frame-archive-top">
  <h1 class="section-title"><span lang="en">BLOG</span><br><span lang="ja">ブログ</span></h1>
  <div class="breadcrumb"><a href="<?php echo home_url('/') ?>">TOP</a><span class="middledot">・</span><span lang="ja">ブログ</span></div>
  <img src="<?php echo get_template_directory_uri(); ?>/img/mv-bg.jpg" alt="">
</div>

<section id="archive" class="posts">
  <h1>全ての記事</h1>
  <ul class="items">
    <li><a href="/archive">全て</a></li>
    <?php
    $categories_list = get_categories();
    foreach ($categories_list as $value) {
      echo '<li><a href="' . home_url('/') . 'category/' . $value->slug . '">' . $value->name . '</a></li>';
    }
    ?>
  </ul>

  <!-- 表示ページ数を1ページだけにする。------------ -->
  <ul class="post-archive lastest-post">
    <?php
    // ここで1ページと指定
    $args = array('posts_per_page' => 1);
    $my_query = new WP_Query($args);
    ?>
    <?php if ($my_query->have_posts()) : ?>
      <?php while ($my_query->have_posts()) : ?>
        <?php $my_query->the_post(); ?>
        <li>
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="78px" height="223px" viewBox="0 0 78 223">
            <path fill-rule="evenodd" stroke-width="1px" stroke="rgb(0, 38, 106)" fill-opacity="0" opacity="0.22" fill="rgb(0, 38, 106)" d="M70.462,58.311 L70.462,70.641 L4.403,59.391 L46.612,23.121 L7.463,16.371 L7.463,4.41 L73.522,15.291 L31.403,51.561 L70.462,58.311 ZM7.463,111.951 L7.463,85.41 L7.463,80.901 L7.463,72.891 L70.462,83.601 L70.462,95.931 L70.462,95.931 L70.462,122.751 L59.572,120.861 L59.572,94.49 L46.252,91.746 L46.252,116.901 L35.633,115.11 L35.633,89.910 L18.353,86.923 L18.353,113.841 L7.463,111.951 ZM70.462,128.691 L70.462,143.271 L31.43,150.111 L73.792,174.51 L30.953,184.581 L70.462,203.751 L70.462,218.871 L3.773,182.781 L45.172,169.911 L3.683,144.81 L70.462,128.691 Z"></path>
          </svg>
          <a href="<?php the_permalink(); ?>">
            <div class="frame">
              <?php the_post_thumbnail(); ?>
            </div>
          </a>
        </li>
        <li>
          <a href="<?php the_permalink(); ?>">
            <div class="header-sub">
              <div class="icon-new" lang="en">NEW</div>
              <ul class="post-categorie">
                <?php
                $category = get_the_category();
                foreach ($category as $attr) {
                  echo '<li>' . $attr->name . '</li>';
                }
                ?>
              </ul>
              <time datetime="<?php echo get_the_date("Y-m-d") ?>"><?php echo get_the_date("Y.m.d") ?></time>
            </div>
            <h4><?php the_title(); ?></h4>
            <?php
            add_filter('excerpt_length', function ($length) {
              return 180; //表示する文字数
            }, 999);
            ?>
            <p><?php the_excerpt(); ?></p>
          </a>
        </li>
      <?php endwhile; ?>
    <?php endif; ?>
  </ul>
  <!-- 'offset' => 1で1ページ目を抜かして出力する。-->
  <ul class="post-archive">
    <?php
    // 一覧の後、ページネーションで必要になるコードでもある。
    //  get_query_var()関数に'paged'という引数を渡すと
    //  ページ数が返ってくる。
    //  ただし、最初は『0』が入るので、それを三項演算子を使い『1』に変更する。
    //  get_query_var('paged')がtrueならget_query_var('paged')を代入。
    //  get_query_var('paged')がfalseだったら『1』を代入する。
    $recent_page = get_query_var('paged') ? get_query_var('paged') : 1;
    $args = array(
      // defaultでは'post'。例えば'mesg'という名称のカスタム投稿を追加した場合は、
      // 'post_type' => 'mesg'として宣言する。
      'post_type' => 'post',
      // 投稿全体から3ページだけ取ってきてと命令してる。
      'posts_per_page' => 3,
      'paged' => $recent_page,
      // 質問 ///////////////////////////////////////////////////////////////////////////////////
      // ここで1ページ目を抜かす設定を追加している。
      // これをつけるとページネーションが効かない。
      // 'offset' => 1
    );
    // 投稿に関する設定を入れた変数をWP_Query()関数の引数とする。
    $my_query = new WP_Query($args);
    // もし、投稿があれば、投稿が尽きるまでループする。ループしている間は次々にポストを投げ続ける。 
    if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); 
    ?>
    <li>
      <!-- 『the_permalink()』の内側に、
              リスト要素を発生させるで生成させる
              『the_category()』を入れ子にすると、
              『the_permalink()』で生成したa要素の括りの構造を破壊する。
              回避方法は、『the_category()』を配列にして出力すること。  -->
      <a href="<?php the_permalink(); ?>">
        <div class="frame">
          <?php the_post_thumbnail(); ?>
        </div>
        <div class="header-sub">
          <ul class="post-categorie">
            <?php
            // 『the_category()』を配列にして出力すには、
            // 『get_the_category()関数』を使う。
            // 『the_category()』の属性が配列として取れた。
            $category = get_the_category();
            // name属性をキーにして値を取り出す。
            foreach ($category as $attr) {
              echo '<li>' . $attr->name . '</li>';
            }
            ?>
          </ul>
          <time datetime="<?php echo get_the_date("Y-m-d") ?>"><?php echo get_the_date("Y.m.d") ?></time>
        </div>
        <h4 class="shrinkLine"><?php the_title(); ?></h4>
        <?php
        add_filter('excerpt_length', function ($length) {
          return 50; //表示する文字数
        }, 999);
        ?>
        <p><?php the_excerpt(); ?></p>
      </a>
    </li>
    <?php endwhile; endif; ?>
  </ul>

  <!-- あしらいと装飾（<, >, ...）については、
        WPが書き出した要素を参照してSassで調節する。 -->
  <?php
  $args = array(
    'type' => 'list',
    'current' => $recent_page,
    'total' => $my_query->max_num_pages,
    'prev_text' => '<',
    'next_text' => '>',
  );
  echo paginate_links($args);
  ?>
</section>

<section class="posts project-archive">
  <h2 class="section-title">施工事例<br><span lang="en">PROJECT</span></h2>
  <?php
  $args = array(
    'post_type' => 'project',
    'posts_per_page' => 3,
    'orderby' => 'rand'
  );
  $project_query = new WP_Query($args);
  ?>
  <ul class="post-archive project-post">
    <?php if ($project_query->have_posts()) : ?>
      <?php while ($project_query->have_posts()) : ?>
        <?php $project_query->the_post(); ?>
        <li>
          <a href="<?php the_permalink(); ?>">
            <div class="frame">
              <?php the_post_thumbnail(); ?>
            </div>
            <time datetime="<?php echo get_the_date('Y-m-d') ?>"><?php echo get_the_date('Y/m/d') ?></time>
            <h4><?php the_title(); ?></h4>
            <p><?php the_excerpt(); ?></p>
          </a>
        </li>
      <?php endwhile; ?>
    <?php endif; ?>
  </ul>
  <a class="more-info-btn" href="">
    事業紹介を見る
    <div class="border"></div>
  </a>
</section>

<section id="contact" class="contact">
  <p>電気のことでお困りの際は<br class="for-sp">気軽にご相談ください</p>
  <a href="">電気工事のご依頼・ご相談はこちら</a>
  <ul>
    <li lang="en">0721-23-5658</li>
    <li><span>受付時間</span>&emsp;平日&nbsp;<span lang="en"><time datetime="09:00">9:00&thinsp;-&thinsp;<time datetime="17:00"></time>17:00</span></li>
  </ul>
</section>

<?php get_footer(); ?>