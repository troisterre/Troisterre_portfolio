<?php

/**
 * 固定ページ「thanks」専用テンプレート
 */
get_header();
?>

<main class="l-thanks">
  <div class="l-inner">

    <?php
    // 固定ページ「thanks」のスラッグで投稿取得
    $thanks_page = new WP_Query([
      'post_type' => 'page',
      'name' => 'thanks',
      'posts_per_page' => 1,
    ]);

    if ($thanks_page->have_posts()) :
      while ($thanks_page->have_posts()) : $thanks_page->the_post();
    ?>
        <h1 class="c-title"><?php the_title(); ?></h1>
        <div class="c-content">
          <?php the_content(); ?>

          <a href="https://troisterre-kamimura.com">return</a>
        </div>
    <?php
      endwhile;
      wp_reset_postdata();
    else :
      echo '<p>ページが見つかりませんでした。</p>';
    endif;
    ?>
    <div class="l-wrapper__flow">
      <h2 class="c-title__flow tenmincho-text">コーディング代行の流れ</h2>
      <ul class="p-flow__contents">
        <li class="p-flow__item u-flex__flow">
          <h3 class="p-flow__item-title tenmincho-text">ご相談・ご契約</h3>
          <p class="p-flow__item-text">
            ご依頼・ご相談・お見積りなど<br />
            <a class="p-flow__link" href="#contact">お問い合わせフォーム</a>からお問い合わせください。
          </p>
        </li>
        <li class="p-flow__item u-flex__flow">
          <h3 class="p-flow__item-title tenmincho-text">ヒアリング</h3>
          <p class="p-flow__item-text">
            ご依頼内容をヒアリングし、適切なコーディング方法をご提案します。
          </p>
        </li>
        <li class="p-flow__item u-flex__flow">
          <h3 class="p-flow__item-title tenmincho-text">
            データのお預かり
          </h3>
          <p class="p-flow__item-text">
            コーディング作業のために、
            デザインデータ・画像のお預かりをいたします。
          </p>
        </li>
        <li class="p-flow__item u-flex__flow">
          <h3 class="p-flow__item-title tenmincho-text">コーディング</h3>
          <p class="p-flow__item-text">コードの実装を行います。</p>
        </li>
        <li class="p-flow__item u-flex__flow">
          <h3 class="p-flow__item-title tenmincho-text">WordPress化</h3>
          <p class="p-flow__item-text">
            サイトや投稿記事の作成、更新の作業ができるようにシステム化いたします。
          </p>
        </li>
        <li class="p-flow__item u-flex__flow">
          <div class="p-flow__item-last-list u-flex__flow-subtitle">
            <h3 class="p-flow__item-title tenmincho-text u-flex__subtitle">
              納品
            </h3>
            <span class="p-flow__item-subtitle-sp">(納品方法は別途相談)</span>
            <span class="p-flow__item-subtitle-pc">納品方法は別途相談</span>
          </div>

          <p class="p-flow__item-text">
            ソースコード、実行可能ファイル、ドキュメントなどを納品いたします。
          </p>
        </li>
      </ul>
    </div>
    <!-- /.l-wrapper l-wrapper-flow -->
  </div>
</main>

<?php get_footer(); ?>