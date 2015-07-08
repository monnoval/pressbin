<?php

/**
 * Enqueue styles and scripts
 */
function pressbin_scripts() {

  pressbin_js();

  wp_enqueue_style( 'style', get_template_directory_uri() . '/style.min.css' );

}
add_action( 'wp_enqueue_scripts', 'pressbin_scripts' );


/**
 * Base scripts
 */
function pressbin_js() {
  wp_dequeue_script(    'jquery' );
  wp_deregister_script( 'jquery' );
  wp_register_script(   'jquery', '//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js', array(), '1.11.3' );
  wp_enqueue_script(    'jquery' );

  wp_register_script(   'jquery-ui', '//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js', array(), '1.11.4' );
  wp_enqueue_script(    'jquery-ui' );

  wp_register_script(   'jquery-layout', '//cdnjs.cloudflare.com/ajax/libs/jquery-layout/1.4.3/jquery.layout_and_plugins.min.js', array(), '1.4.3' );
  wp_enqueue_script(    'jquery-layout' );

  $codemirror_pfx = 'codemirror';
  $codemirror_v   = '5.4.0';
  $codemirror_url = '//cdnjs.cloudflare.com/ajax/libs/' . $codemirror_pfx . '/' . $codemirror_v . '/';

  wp_register_script( $codemirror_pfx , $codemirror_url . 'codemirror.min.js', array(), $codemirror_v );
  wp_enqueue_script(  $codemirror_pfx );
  wp_register_script( $codemirror_pfx . '-xml', $codemirror_url . 'mode/xml/xml.min.js', array(), $codemirror_v );
  wp_enqueue_script(  $codemirror_pfx . '-xml' );
  wp_register_script( $codemirror_pfx . '-css', $codemirror_url . 'mode/css/css.min.js', array(), $codemirror_v );
  wp_enqueue_script(  $codemirror_pfx . '-css' );
  wp_register_script( $codemirror_pfx . '-javascript', $codemirror_url . 'mode/javascript/javascript.min.js', array(), $codemirror_v );
  wp_enqueue_script(  $codemirror_pfx . '-javascript' );
  wp_register_script( $codemirror_pfx . '-htmlmixed', $codemirror_url . 'mode/htmlmixed/htmlmixed.min.js', array(), $codemirror_v );
  wp_enqueue_script(  $codemirror_pfx . '-htmlmixed' );

  wp_register_script( 'pressbin-core', get_template_directory_uri() . '/js/core.js', array(), '' );
  wp_enqueue_script(  'pressbin-core' );
}


/**
 * Template types
 */
function single_template( $name, $post_type ) {
  global $post;
  if ( $post->post_type == $post_type )
    post_assets( $name . '-' . $post_type );
}


function page_template( $name ) {
  if ( is_page_template( get_folder_path( $name, 'php' ) ) )
    post_assets( $name );
}


function taxonomy_template( $name, $taxonomy ) {
  if ( get_query_var('taxonomy') == $taxonomy )
    post_assets( $name );
}


/**
 * Template enqueue
 */
function post_assets( $name ) {

  wp_enqueue_style(  $name, get_template_uri( get_folder_path( $name, 'min.css' ) ) );
  wp_enqueue_script( $name, get_template_uri( get_folder_path( $name, 'min.js#defer' ) ), array(), '', true );

}


/**
 * Add async/defer to script tag
 */
function pressbin_add_async($url) {
  if (strpos($url, '#async')===false && strpos($url, '#defer')===false) {
    return $url;
  } else if (is_admin()) {
    $output = str_replace('#async', '', $url);
    $output = str_replace('#defer', '', $output);
    return $output;
  } else {
    if (strpos($url,'#async') !== false) {
      return str_replace('#async', '', $url)."' async x='";
    } else if (strpos($url,'#defer') !== false) {
      return str_replace('#defer', '', $url)."' defer x='";
    }
  }
}
add_filter('clean_url', 'pressbin_add_async', 11, 1);


function pressbin_remove_scripts() {
  wp_dequeue_style(    'wpml-cms-nav-css' );
  wp_deregister_style( 'wpml-cms-nav-css' );
  wp_dequeue_style(    'cms-navigation-style-base' );
  wp_deregister_style( 'cms-navigation-style-base' );
  wp_dequeue_style(    'cms-navigation-style' );
  wp_deregister_style( 'cms-navigation-style' );
  wp_dequeue_style(    'wp-pagenavi' );
  wp_deregister_style( 'wp-pagenavi' );
}
add_action( 'wp_enqueue_scripts', 'pressbin_remove_scripts' );


/**
 * WPML Remove CSS and JS
 *
 * @link http://notboring.org/devblog/2012/08/how-to-remove-the-embedded-sitepress-multilingual-cmsrescsslanguage-selector-css-from-your-own-wordpress-templates-on-wpml-installations/
 */
define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
// define('ICL_DONT_LOAD_LANGUAGES_JS', true);


