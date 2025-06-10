<?php
if (post_password_required()) {
  return;
}
?>

<div id="comments" class="comments-area">

  <?php if (have_comments()) : ?>
  <h2 class="comments-title">
    <?php
      printf(
        _nx('1 件のコメント', '%1$s 件のコメント', get_comments_number(), 'コメント数', 'kamimura_portfolio'),
        number_format_i18n(get_comments_number())
      );
      ?>
  </h2>

  <ol class="comment-list">
    <?php
      wp_list_comments(array(
        'style' => 'ol',
        'short_ping' => true,
      ));
      ?>
  </ol>

  <?php
    // コメントナビゲーション（推奨されている部分）
    if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
  <nav class="comment-navigation" role="navigation">
    <div class="nav-previous"><?php previous_comments_link(__('← 古いコメント', 'kamimura_portfolio')); ?></div>
    <div class="nav-next"><?php next_comments_link(__('新しいコメント →', 'kamimura_portfolio')); ?></div>
  </nav>
  <?php endif; ?>

  <?php endif; ?>

  <?php
  // コメントが閉じていて、コメントがある場合
  if (! comments_open() && get_comments_number()) :
    echo '<p class="no-comments">' . __('コメントは閉じられています。', 'kamimura_portfolio') . '</p>';
  endif;

  comment_form();
  ?>

</div><!-- #comments -->