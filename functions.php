<?php
// テーマサポート系
function troisterre_theme_setup()
{
  add_theme_support('menus');
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');

  register_nav_menus(array(
    'header-nav' => 'ヘッダーナビゲーション',
  ));
}
add_action('after_setup_theme', 'troisterre_theme_setup');

// 管理バー非表示
add_filter('show_admin_bar', '__return_false');

// タイトル出力フィルター
function troisterre_title($title)
{
  if (is_front_page() && is_home()) {
    $title = get_bloginfo('name', 'display');
  } elseif (is_singular()) {
    $title = single_post_title('', false);
  }
  return $title;
}
add_filter('pre_get_document_title', 'troisterre_title');

// スクリプトとスタイルの読み込み
function troisterre_script()
{
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0');
  wp_enqueue_style('adobe-fonts', 'https://use.typekit.net/aws1fii.css', array(), null);
  wp_enqueue_style('troisterre-style', get_template_directory_uri() . '/css/troisterre.css', array(), '1.0.0');
  wp_enqueue_style('main-style', get_template_directory_uri() . '/css/main.css', array(), '1.0.0');
  wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), null);

  wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), null, true);
  wp_enqueue_script('main-js', get_template_directory_uri() . '/js/main.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'troisterre_script');

// 固定ページにカテゴリを追加
function add_category_to_pages()
{
  register_taxonomy_for_object_type('category', 'page');
}
add_action('init', 'add_category_to_pages');
function troisterre_enqueue_recaptcha_enterprise()
{
  // あなたのサイトキー
  $site_key = '6Lfew0ArAAAAAGvdzSgbumbqn0FWnYRwQNbzrcpa';

  // reCAPTCHA Enterprise スクリプトの読み込み（非同期＆defer付き）
  wp_enqueue_script(
    'recaptcha-enterprise',
    'https://www.google.com/recaptcha/enterprise.js?render=' . $site_key,
    array(),
    null,
    true
  );
}
add_action('wp_enqueue_scripts', 'troisterre_enqueue_recaptcha_enterprise');
