<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package pressbin
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header main__header">
    <?php the_title( '<h1 class="entry-title main__title">', '</h1>' ); ?>
  </header><!-- .entry-header -->

  <div class="entry-content">
    <?php the_content(); ?>

  <footer class="entry-footer">
    <?php edit_post_link( __( 'Edit', 'pressbin' ), '<span class="edit-link">', '</span>' ); ?>
  </footer><!-- .entry-footer -->
</article><!-- #post-## -->
