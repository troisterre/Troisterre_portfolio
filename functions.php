<?php
// テーマサポート系
function troisterre_theme_setup()
{
  add_theme_support('automatic-feed-links');
  register_nav_menus(array(
    'header-nav' => 'ヘッダーナビゲーション'
  ));
}
add_action('after_setup_theme', 'troisterre_theme_setup');
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('wp-block-styles');
add_theme_support('sensitive-embeds');
add_theme_support('html5', array(
  'search-form',
  'comment-form',
  'comment-list',
  'gallery',
  'caption',
  'style',
  'script',
  'navigation-widgets' // WP6.1以降対応
));
add_theme_support('custom-logo', array(
  'height'      => 100, // 推奨高さ（自由に変更可能）
  'width'       => 300, // 推奨幅
  'flex-height' => true, // 高さの柔軟性
  'flex-width'  => true, // 幅の柔軟性
  'header-text' => array('site-title', 'site-description'),
));
add_theme_support('custom-background', array(
  'default-color' => 'ffffff', // 背景色のデフォルト
  'default-image' => '',       // 背景画像のデフォルト（なし）
  'default-repeat' => 'no-repeat',
  'default-position-x' => 'center',
  'default-attachment' => 'scroll',
));
add_theme_support('align-wide');
add_theme_support('custom-header', array(
  'default-image'      => get_template_directory_uri() . '/img/default-header.jpg', // デフォルト画像（任意）
  'width'              => 1200, // 推奨幅
  'height'             => 400,  // 推奨高さ
  'flex-width'         => true,
  'flex-height'        => true,
  'header-text'        => false,
  'uploads'            => true,
));
function troisterre_add_editor_styles()
{
  add_editor_style('editor-style.css');
}
add_action('admin_init', 'troisterre_add_editor_styles');

function troisterre_enqueue_comment_reply_script()
{
  if (is_singular() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }
}
add_action('wp_enqueue_scripts', 'troisterre_enqueue_comment_reply_script');

function theme_widgets_init()
{
  register_sidebar([
    'name' => 'サイドバー',
    'id' => 'sidebar-1',
    'before_widget' => '<div class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="widgettitle">',
    'after_title'   => '</h2>',
  ]);
}
add_action('widgets_init', 'theme_widgets_init');

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
  wp_enqueue_style('main-style', get_template_directory_uri() . '/css/main.css', array(), '1.0.0');
  wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), null);

  wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), null, true);
  wp_enqueue_script(
    'troisterre-contact-js',
    get_template_directory_uri() . '/js/main.js',
    array('recaptcha-enterprise'), // ← ここで依存関係を指定
    null,
    true
  );
  wp_enqueue_script('main-js', get_template_directory_uri() . '/js/main.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'troisterre_script');

// 固定ページにカテゴリを追加
function add_category_to_pages()
{
  register_taxonomy_for_object_type('category', 'page');
}
add_action('init', 'add_category_to_pages');
add_filter('wpcf7_use_button_element', '__return_false');

add_filter('the_content', 'add_lazyload_to_images');
function add_lazyload_to_images($content)
{
  return preg_replace('/<img(.*?)src=/i', '<img$1loading="lazy" src=', $content);
}
function troisterre_register_block_styles()
{
  // 段落ブロックに「太枠」スタイルを追加
  register_block_style(
    'core/paragraph',
    array(
      'name'  => 'fancy-border',
      'label' => '太枠',
      'style_handle' => 'troisterre-block-style',
    )
  );
}
add_action('init', 'troisterre_register_block_styles');

function troisterre_enqueue_block_assets()
{
  wp_enqueue_style(
    'troisterre-block-style',
    get_template_directory_uri() . '/css/block-style.css',
    array(),
    '1.0.0'
  );
}
add_action('enqueue_block_assets', 'troisterre_enqueue_block_assets');

function troisterre_register_block_patterns()
{
  register_block_pattern(
    'kamimura_portfolio/cta-section',
    array(
      'title'       => 'CTAセクション',
      'description' => '見出しとボタンを含む CTA セクションです。',
      'content'     => '
        <!-- wp:group {"align":"full","backgroundColor":"primary","textColor":"white","className":"cta-section","layout":{"type":"constrained"}} -->
        <div class="wp-block-group alignfull cta-section has-white-color has-primary-background-color has-text-color has-background">
          <!-- wp:heading {"level":2} -->
          <h2>一緒にWebサイトを作りましょう！</h2>
          <!-- /wp:heading -->
          <!-- wp:buttons -->
          <div class="wp-block-buttons">
            <!-- wp:button -->
            <div class="wp-block-button"><a class="wp-block-button__link">お問い合わせ</a></div>
            <!-- /wp:button -->
          </div>
          <!-- /wp:buttons -->
        </div>
        <!-- /wp:group -->
      ',
      'categories'  => array('kamimura_portfolio'),
    )
  );
}
