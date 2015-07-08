<?php


function lang( $params, $content = null ) {
  foreach ( $params as $key => $value ) {
    if ( is_int( $key ) && !empty($value)) {
      $lang = $value;
    }
  }
  if (defined('ICL_LANGUAGE_CODE')) {
    if ($lang == ICL_LANGUAGE_CODE) {
      return $content;
    }
  }
}
add_shortcode('lang', 'lang');

function fbcms_offers( $params, $content = null ) {
  extract(shortcode_atts(array(), $params));

  $output   = '<div class="fbcms-offers">';
  $output  .= '<div id="js-fbcms-offers" class="site--wrapper">';
  $output  .= "<div class='loading'>";
  $output  .= "<br/><br/><br/><br/>";
  $output  .= "<br/><br/><br/><br/>";
  $output  .= "<p class='text--center'><img src='".get_template_directory_uri()."/img/loading.gif' alt='Loading&hellip;' /></p>";
  $output  .= "<br/><br/><br/><br/><br/><br/>";
  $output  .= "</div>";
  $output  .= "</div>";
  $output  .= "</div>";

  return $output;
}
add_shortcode('fbcms-offers', 'fbcms_offers');

// Example of shortcode for a custom post type
//
// function news( $params, $content = null ) {
//   extract(shortcode_atts(array(
//     'category' => '',
//     'posts' => '',
//   ), $params));
//   ob_start();
//   if (is_page_template( 'tpl-home.php' ) && $category == 'uncategorized') { // uncategorized is set as default
//     require get_template_directory() . '/cpt-news--tpl-home.php';
//   } else if (is_page_template( 'tpl-home.php' ) && $category == 'hotelart') {
//     require get_template_directory() . '/cpt-news-hotelart--tpl-home.php';
//   }
//   return ob_get_clean();
// }
// add_shortcode('news', 'news');
