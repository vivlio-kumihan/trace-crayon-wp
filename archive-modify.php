<?php
$paged = get_query_var( 'paged', 1 ); //現在のページ番号。デフォルトは1
$post__not_in = []; //最新1件目の記事idを後で入れる

$first_args = array(
    'post_type' => 'staff',
    'posts_per_page' => 1 //表示数
);
$first_query = new WP_Query( $first_args );
if ( $first_query->have_posts() ) : while ( $first_query->have_posts() ) : $first_query->the_post();
    $post__not_in[] = $post->ID; //最新1件目の記事idを入れる
    if ($paged == 1) { //1ページ目でだけ、最新1件目の記事を表示
        //最新1件目の記事の表示したい内容
    }
endwhile; endif;

$the_args = array(
    'post_type' => 'staff',
    'paged' => $paged,
    'post__not_in' => array($post__not_in), //最新1件目の記事を除外
    'posts_per_page' => 20 //表示数
);
$the_query = new WP_Query( $the_args );
if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
    //2件目以降の記事の表示したい内容
endwhile;
    //ページャーはここに入れる
endif;
?>