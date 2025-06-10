<footer class="l-footer">
  <small>&copy; <?php echo date('Y'); ?> Atsuo Kamimura. All Rights Reserved.</small>
  <?php if (is_active_sidebar('sidebar-1')) : ?>
  <?php dynamic_sidebar('sidebar-1'); ?>
  <?php endif; ?>
</footer>
<?php wp_footer(); ?>
</body>

</html>