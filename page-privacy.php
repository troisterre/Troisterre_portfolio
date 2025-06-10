<?php

/**
 * 固定ページ「privacy」専用テンプレート
 */
get_header();
?>

<main class="l-privacy">
  <div class="l-wrapper__privacy">
    <?php
    // 固定ページ「privacy」のスラッグで投稿取得
    $privacy = new WP_Query([
      'post_type' => 'page',
      'name' => 'privacy',
      'posts_per_page' => 1,
    ]);

    if ($privacy->have_posts()) :
      while ($privacy->have_posts()) : $privacy->the_post();
    ?>
    <h2 class="c-title__thanks tenmincho-text"><?php the_title(); ?></h2>
    <div class="c-content__privacy">
      <?php the_content(); ?>
    </div>
    <a class="c-button__privacy" href="https://troisterre-kamimura.com">
      <span class="c-button__icon-thanks"></span>
      <span class="c-button__text">トップへ戻る</span>
    </a>
    <?php
      endwhile;
      wp_reset_postdata();
    else :
      echo '<p>ページが見つかりませんでした。</p>';
    endif;
    ?>
  </div>
</main>

<?php get_footer(); ?>