<?php
/**
 * The template for displaying search results pages.
 *
 * @package pressbin
 */

get_header(); ?>
<div id="content" class="content site--wrapper">


<section id="primary" class="content__area">
  <main id="main" class="content__main" role="main">

  <?php if ( have_posts() ) : ?>

    <header class="page-header">
      <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'pressbin' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
    </header><!-- .page-header -->

    <?php /* Start the Loop */ ?>
    <?php while ( have_posts() ) : the_post(); ?>

      <?php
      /**
       * Run the loop for the search to output the results.
       * If you want to overload this in a child theme then include a file
       * called content-search.php and that will be used instead.
       */
      get_template_part( 'content', 'search' );
      ?>

    <?php endwhile; ?>

  <?php else : ?>

    <?php get_template_part( 'content', 'none' ); ?>

  <?php endif; ?>

  </main><!-- #main -->
</section><!-- #primary -->


</div>
<?php get_footer(); ?>
