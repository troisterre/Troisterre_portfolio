<?php
//テーマサポート
add_theme_support('menus');
register_nav_menus(array(
  'header-nav' => 'ヘッダーナビゲーション',
));


add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_filter('show_admin_bar', '__return_false');
//タイトル出力
function troisterre_title($title)
{
  if (is_front_page() && is_home()) { //トップページなら
    $title = get_bloginfo('name', 'display');
  } elseif (is_singular()) { //シングルページなら
    $title = single_post_title('', false);
  }
  return $title;
}
add_filter('pre_get_document_title', 'troisterre_title');

function troisterre_script()
{
  // Font Awesome
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0');

  // Adobe Fonts
  wp_enqueue_style(
    'adobe-fonts',
    'https://use.typekit.net/aws1fii.css',
    array(),
    null
  );

  // 自作CSS（パス修正 & ハンドル名変更）
  wp_enqueue_style('troisterre-style', get_template_directory_uri() . '/css/troisterre.css', array(), '1.0.0');
  wp_enqueue_style('main-style', get_template_directory_uri() . '/css/main.css', array(), '1.0.0');

  // Swiper
  wp_enqueue_style(
    'swiper-css',
    'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
    array(),
    null
  );
  wp_enqueue_script(
    'swiper-js',
    'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
    array(),
    null,
    true // フッターで読み込む
  );
  wp_enqueue_script(
    'main-js', // スクリプトのハンドル名
    get_template_directory_uri() . '/js/main.js', // 読み込むファイルのパス
    array(), // 依存するスクリプト（例: jQueryが必要なら ['jquery']）
    '1.0.0', // バージョン（必要なら）
    true // フッターで読み込む（trueで</body>直前）
  );
}
add_action('wp_enqueue_scripts', 'troisterre_script');
function register_my_menus()
{
  register_nav_menus(
    array(
      'header-nav' => 'ヘッダーナビゲーション',
    )
  );
}
add_action('after_setup_theme', 'register_my_menus');
