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

// reCAPTCHA Enterprise 検証
add_filter('wpcf7_validate', 'verify_recaptcha_enterprise_token', 10, 2);

function verify_recaptcha_enterprise_token($result, $tags)
{
  if (!isset($_POST['g-recaptcha-response'])) {
    $result->invalidate(null, 'reCAPTCHAトークンがありません。');
    return $result;
  }

  $token = sanitize_text_field($_POST['g-recaptcha-response']);
  $project_id = 'your-project-id'; // ← あなたの GCP プロジェクトIDに置き換えてください
  $recaptcha_action = 'contact_form';

  $url = 'https://recaptchaenterprise.googleapis.com/v1/projects/' . $project_id . '/assessments?key=YOUR_API_KEY'; // ← Enterprise APIキーに置き換えてください

  $body = json_encode([
    'event' => [
      'token' => $token,
      'siteKey' => '6LdOiUYrAAAAALRt6hR4lTRDW3qwr-prFy5iGY1C',
      'expectedAction' => $recaptcha_action,
    ]
  ]);

  $response = wp_remote_post($url, [
    'headers' => ['Content-Type' => 'application/json'],
    'body' => $body,
    'timeout' => 10,
  ]);

  if (is_wp_error($response)) {
    $result->invalidate(null, 'reCAPTCHAサーバーとの通信に失敗しました。');
    return $result;
  }

  $data = json_decode(wp_remote_retrieve_body($response), true);

  if (empty($data['tokenProperties']['valid']) || $data['tokenProperties']['action'] !== $recaptcha_action) {
    $result->invalidate(null, 'reCAPTCHA検証に失敗しました。もう一度お試しください。');
    return $result;
  }

  $score = $data['riskAnalysis']['score'] ?? 0;
  if ($score < 0.5) {
    $result->invalidate(null, 'スパムと判定されました。');
  }

  return $result;
}
