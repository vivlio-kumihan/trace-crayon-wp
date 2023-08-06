<?php 
// 外観以下にメニュー項目を追加
function theme_slug_widgets_init() {
  register_sidebar(array(
    'name' => 'sidebarBanners',
    'id' => 'sidebar-banners'
  ));
}
add_action('widgets_init', 'theme_slug_widgets_init');

// アイキャッチ画像タグの追加
add_theme_support('post-thumbnails');

// JavaScriptの設置場所を指定
function behavior_js() {
  wp_enqueue_script(
    'behavior_js',
    get_template_directory_uri() . '/js/behavior.js',
    array(),
    false,
    true
  );
}
add_action('wp_enqueue_scripts', 'behavior_js');

// メニューの設置
register_nav_menus(array(
  'nav-link' => 'nav_link',
  'menu-link' => 'menu_link',
  'recommendation-link' => 'recommendation_link',
));

// 投稿一覧ページを作成する。
// カテゴリーやタブのページ生成とは何の関係もないことに留意する。
function post_has_archive($args, $post_type)
{
  if ('post' == $post_type) {
    $args['rewrite'] = true;
    // ややこしいのでファイル名と同じ名称にする。
    $args['has_archive'] = 'archive';
  }
  return $args;
}
add_filter('register_post_type_args', 'post_has_archive', 10, 2);

// 投稿抜粋の末尾記号を変更する。
function new_excerpt_more( $more ) {
  return '......' ;
}
add_filter( 'excerpt_more' , 'new_excerpt_more' );

// Contact Form 7の自動『p』タグ無効
add_filter('wpcf7_autop_or_not', 'wpcf7_autop_return_false');
function wpcf7_autop_return_false()
{
  return false;
}