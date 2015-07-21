<?php
/**
 * The template for displaying all single posts.
 *
 * @package pressbin
 */

get_header();

$data       = array();
$css_data   = array(
                'key'  => 'css',
                'data' => get_post_meta( $post->ID, 'css', true ),
              );
$html_data  = array(
                'key'  => 'html',
                'data' => get_post_meta( $post->ID, 'php_html', true ),
              );
$js_data   = array(
                'key'  => 'js',
                'data' => get_post_meta( $post->ID, 'js', true ),
              );

if ( !empty( $css_data['data'] ) )
  $data[] = $css_data;
if ( !empty( $html_data['data'] ) )
  $data[] = $html_data;
if ( !empty( $js_data['data'] ) )
  $data[] = $js_data;

// var_dump( count( $data ) );
// var_dump( $data );

$iframe_url = get_template_directory_uri() . '/_code/' . $post->post_name . '.html';

pressbin_create_html( $post );
?>

<div class="js__iframe ui-layout-center nopadding noscroll">
  <iframe style="border: 0 none" src="<?php echo  $iframe_url ?>" width="100%" height="100%" ></iframe>

  <!-- Modal -->
  <?php while ( have_posts() ) : the_post(); ?>
  <div class="modal fade" id="js__details_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php the_title() ?></h4>
        </div>
        <div class="modal-body">
          <?php the_content() ?>
        </div>
        <?php /*/ ?>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        <?php /*/ ?>
      </div>
    </div>
  </div>
  <?php endwhile; // end of the loop. ?>

</div>

<div class="ui-layout-north">
  <button onclick="myLayout.toggle('west')" id="js__menu">Menu</button>
  <button type="button" data-toggle="modal" data-target="#js__details_modal">Details</button>
</div>
<div id="js__code__panel" class="code__panel ui-layout-east nopadding">

<?php
$count = 0;
if ( count( $data ) ) {
  foreach ( $data as $code ) {
    if ( $count == 0 )
      $css_layout = 'center';
    else if  ( $count == 1 )
      $css_layout = 'north';
    else if  ( $count == 2 )
      $css_layout = 'south';
    ?>
    <div class="ui-layout-<?php echo $css_layout ?> nopadding">
      <div class="code__header">
        <div class="code__title"><span class="code__title-text"><?php echo strtoupper( $code['key'] ) ?></span></div>
      </div>
      <div class="ui-layout-content nopadding">
        <textarea id="js__code--<?php echo $code['key'] ?>" name="js__code_<?php echo $code['key'] ?>"><?php echo $code['data'] ?></textarea>
      </div>
    </div>
  <?php
    $count++;
  } ?>
  <script>
  layoutSettings_Inner = {
      applyDemoStyles:  true
    , north__closable:  false
    , south__closable:  false
    , center__closable: false
  <?php if ( count( $data ) == 3 ): ?>
    , center__size:     .3
    , north__size:      .3
    , south__size:      .3
  <?php elseif ( count( $data ) == 2 ): ?>
    , center__size:     .5
    , north__size:      .5
  <?php elseif ( count( $data ) == 2 ): ?>
    , center__size:    1.0
  <?php endif; ?>
    , north__minSize:    30
    , south__minSize:    30
    , center__minHeight: 30
  };
  </script><?php
} ?>

</div>
<div class="ui-layout-west">
<?php
$args = array(
  'post_type'      => 'post',
  'posts_per_page' => -1
);
$wp_query = new WP_Query($args);
if ( $wp_query->have_posts() ):
  while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
    <li><a href="<?php the_permalink() ?>"><?php echo get_the_title() ?></a></li>
<?php
  endwhile;
endif;
wp_reset_query();
?>
</div>



<?php get_footer(); ?>
