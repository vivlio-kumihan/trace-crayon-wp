<?php get_header(); ?>

<div class="frame">
  <div class="section-title"><span lang="en">BLOG</span><br><span lang="ja">ブログ</span></div>
  <div class="breadcrumb">TOP<span class="middledot">・</span><span lang="ja">ブログ</span></div>
  <img src="<?php echo get_template_directory_uri(); ?>/img/mv-bg.jpg" alt="">
</div>
<section id="archive" class="news">
  <h1>全ての記事</h1>
  <ul class="items">
    <li>全て</li>
    <li>電気工事</li>
    <li>採用関連</li>
    <li>職人の素顔</li>
    <li>くれよんの日常</li>
    <li>社長のつぶやき</li>
    <li>広報・人事</li>
  </ul>
  <ul class="postList">
    <!-- 投稿数を3ページに限定する設定 -->
    <?php
    // 3ページだけ取ってくるという状態を変数に格納。
    $args = array('posts_per_page' => 7);
    // このインスタンスで機能しているDBへ引数として渡し、
    // 該当データを変数へ保存。
    $my_query = new WP_Query($args);
    // 非常に違和感がある書き方をするが慣れんと仕方ない。
    // こういう書き方でデータを収集する。。。
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
              <time datetime="<?php echo get_the_date("Y-m-d") ?>"><?php echo get_the_date("Y年m月d日") ?></time>
            </div>
            <h4 class="shrinkLine"><?php the_title(); ?></h4>
            <p><?php the_excerpt(); ?></p>
          </a>
        </li>
    <?php endwhile;
    endif; ?>
  </ul>
  <div class="more-info-btn">
    一覧を見る
    <div class="border"></div>
  </div>

  <?php
  $args = array(
    'post_type' => 'project',
    'posts_per_page' => 3,
  );
  $project_query = new WP_Query($args);
  ?>
  <ul>
    <?php if ($project_query->have_posts()) : while ($project_query->have_posts()) : $project_query->the_post(); ?>
        <li>
          <a href="<?php the_permalink(); ?>">
            <div class="frame">
              <?php the_post_thumbnail(); ?>
            </div>
            <time datetime="<?php echo get_the_date('Y-m-d') ?>"><?php echo get_the_date('Y/m/d') ?></time>
            <h3><?php the_title(); ?></h3>
            <p><?php the_excerpt(); ?></p>
          </a>
        </li>
    <?php endwhile;
    endif ?>
  </ul>
</section>

<?php get_footer(); ?>