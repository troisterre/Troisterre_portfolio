<!DOCTYPE html>
<html lang="<?php language_attributes(); ?>">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />


  <meta name="author" content="KAMIMURA" />
  <meta name="robots" content="index, follow" />
  <meta name="theme-color" content="#ffffff" />
  <meta name="description" content="Webデザイン・コーディング代行を承ります。SEO・MEO対策、レスポンシブ対応の高品質コーディングを提供。千葉県を中心に全国対応可能。" />
  <meta name="keywords" content="コーディング代行, Web制作, HTML, CSS, SEO対策, MEO対策, ポートフォリオ, フリーランスコーダー, 千葉,松戸" />

  <!-- OGP -->
  <meta property="og:title" content="Web制作・コーディング代行｜KAMIMURAのポートフォリオ" />
  <meta property="og:description" content="SEO・MEO対策済みの高品質Web制作。HTML/CSS/WordPress対応。全国からのご依頼に対応。" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://your-portfolio-url.com" />
  <meta property="og:image" content="https://your-portfolio-url.com/ogp.jpg" />
  <meta property="og:site_name" content="KAMIMURAポートフォリオ" />

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="Web制作・コーディング代行｜KAMIMURAポートフォリオ" />
  <meta name="twitter:description" content="SEO・MEO対策済みの高品質Web制作。HTML/CSS/WordPress対応。全国対応。" />
  <meta name="twitter:image" content="https://your-portfolio-url.com/ogp.jpg" />

  <!-- 構造化データ（JSON-LD） -->
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "LocalBusiness",
      "name": "KAMIMURA’sポートフォリオ",
      "image": "https://your-portfolio-url.com/logo.png",
      "url": "https://your-portfolio-url.com",
      "telephone": "090-1234-5678",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "渋谷区○○1-2-3",
        "addressLocality": "渋谷区",
        "addressRegion": "東京都",
        "postalCode": "150-0001",
        "addressCountry": "JP"
      },
      "openingHours": "Mo-Fr 10:00-18:00",
      "priceRange": "¥¥",
      "description": "千葉県松戸市を拠点に、SEO・MEO対策を考慮したWebコーディングを提供しています。全国対応可能。"
    }
  </script>

  <link rel="preconnect" href="https://use.typekit.net" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fira+Code&display=swap" rel="stylesheet" />

  <!-- head内 -->
  <?php wp_head(); ?>
</head>

<body>
  <main>
    <header class="l-header u-flex__header">
      <h1 class="l-header__title readex-pro">
        <a href="#" class="l-header__title-link u-flex__header-title">
          <div class="l-header__title-top u-flex__header-title-name">
            <div class="l-header__title-name">
              <span class="l-header__title-first">KAMIMURA</span><span class="l-header__title-small">'s</span>
            </div>
            <span class="l-header__title-second">PORTFOLIO</span>
          </div>
          <!-- /.l-header__title-top -->
          <div class="l-header__title-bottom">
            <span>web corder</span>
          </div>
          <!-- /.l-header__title-bottom -->
        </a>
      </h1>
      <?php
      wp_nav_menu(array(
        'theme_location' => 'header-nav',
        'container' => 'nav',
        'container_class' => 'l-header__nav', // navタグに付けたいクラス
        'menu_class' => 'l-header__nav-list',        // ulタグのクラス
      ));
      ?>
      <div class="c-hamburger js-hamburger">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </header>
    <nav class="c-hamburger__nav js-nav">
      <ul class="c-hamburger__contents">
        <li class="c-hamburger__list">
          <a class="js-nav-link" href="#">トップ</a>
        </li>
        <li class="c-hamburger__list">
          <a class="js-nav-link" href="#works">制作物</a>
        </li>
        <li class="c-hamburger__list">
          <a class="js-nav-link" href="#about">私について</a>
        </li>
        <li class="c-hamburger__list">
          <a class="js-nav-link" href="#price">価格</a>
        </li>
        <li class="c-hamburger__list js-nav=link">
          <a class="js-nav-link" href="#flow">制作の流れ</a>
        </li>
        <li class="c-hamburger__list js-nav=link">
          <a class="js-nav-link" href="#contact">お問い合わせ</a>
        </li>
      </ul>
    </nav>