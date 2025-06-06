<?php

/**
 * 固定ページ「thanks」専用テンプレート
 */
get_header();
?>

<main class="l-thanks">
  <div class="l-wrapper__thanks">
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
        <h2 class="c-title__thanks tenmincho-text"><?php the_title(); ?></h2>
        <div class="c-content__thanks">
          <?php the_content(); ?>
        </div>
        <a class="c-button__thanks" href="https://troisterre-kamimura.com">
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