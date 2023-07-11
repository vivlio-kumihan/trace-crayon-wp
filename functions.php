<?php 

// 外観以下にメニュー項目を追加
function theme_slug_widgets_init() {
  register_sidebar(array(
    'name' => 'サイドバー',
    'id' => 'sidebar'
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
));