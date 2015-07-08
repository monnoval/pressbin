<?php

function is_array_empty($a) {
  if (is_array($a)) {
    foreach ($a as $elm) {
      if(!empty($elm))
        return false;
    }
  }
  return true;
}


function get_folder_path( $name, $ext ) {

  if ( substr( $ext, 0, 1 ) === '-' ||
       substr( $ext, 0, 1 ) === '.' )
    $path = $name . '/' . $name . $ext;
  else
    $path = $name . '/' . $name . '.' . $ext;

  return $path;

}


function get_template_uri( $path ) {
  return get_template_directory_uri() . '/' . $path;
}


function get_default_lang_page_id($id){
  if(function_exists('icl_object_id')) {
    return icl_object_id($id,'page',true,'en');
  } else {
    return $id;
  }
}


function get_pageid_by_tpl( $tpl_name ) {
  $page_id = false;
  $pages = get_posts(array(
    'post_type' => 'page',
    'meta_key' => '_wp_page_template',
    'meta_value' => get_folder_path( $tpl_name, 'php' ),
    'suppress_filters' => 0
  ));

  if ( count( $pages ) == 1 ) {
    $first = true;
    foreach( $pages as $page ){
      if ( $first ) {
        $page_id = $page->ID;
        $first = false;
        break;
      }
    }
    if ( $page_id ) {
      return $page_id;
    }
  } elseif ( count( $pages ) > 1 ) {
    return 'There is more than one WP Page using';
  } else {
    return 'No WP Page using';
  }
}


if (! function_exists('get_logo') ) {
  function get_logo() {
    $data = get_option('data');
    $logo = $data['logo']['url'];
    if ( empty( $logo ) ) {
      $hotel_name = get_bloginfo( 'name' );
      // $hotel_name = str_replace( 'Hotel ', '', $hotel_name );
      return "http://placehold.it/220x85&text=".str_replace(' ','+',$hotel_name);
    } else {
      return $logo;
    }
  }
}


function get_logo_svg2png() {
  $data = get_option('data');
  $img_src = $data['logo']['url'];
  $img_src_ext = strtolower(pathinfo($img_src, PATHINFO_EXTENSION));
  if ( $img_src_ext == "svg" )
    $img_src   = str_replace( ".".$img_src_ext , ".png", $img_src );
  return $img_src;
}


function get_logo_issvg() {
  $data = get_option('data');
  $img_src = $data['logo']['url'];
  $img_src_ext = strtolower(pathinfo($img_src, PATHINFO_EXTENSION));
  if ( $img_src_ext == "svg" )
    return true;
  else
    return false;
}


function require_template_fn( $name ) {
  require_once( trailingslashit( get_template_directory() ) . get_folder_path( $name, '-fn.php' ) );
}


function get_site_map_style() {
  $map_style_js = '[{"featureType": "poi.business", "elementType": "labels", "stylers": [{ "visibility": "off" }]}]';

  return $map_style_js;
}


function get_page_attachments( $page_id ) {

  $argsThumb = array(
    'posts_per_page' => -1,
    'order'          => 'ASC',
    'orderby'        => 'menu_order',
    'post_type'      => 'attachment',
    'post_parent'    => get_default_lang_page_id( $page_id ),
    'post_mime_type' => 'image',
    'post_status'    => null
  );
  $attachments = get_posts($argsThumb);

  return $attachments;
}


function has_page_attachments( $page_id, $media_tag = '' ) {

  $argsThumb = array(
    'posts_per_page' => -1,
    'order'          => 'ASC',
    'orderby'        => 'menu_order',
    'post_type'      => 'attachment',
    'post_parent'    => get_default_lang_page_id( $page_id ),
    'post_mime_type' => 'image',
    'post_status'    => null
  );
  $attachments = get_posts($argsThumb);

  if ( !empty( $media_tag) ) {
    // check if an attachment has the media tag
    $term_found = false;
    foreach ($attachments as $attachment):
      $attachment_id    = $attachment->ID;
      $term_list = wp_get_post_terms($attachment_id, 'media_tag', array("fields" => "all"));
      $terms = array();
      foreach ( $term_list as $term )
        array_push($terms, $term->slug);

      // var_dump( $terms );

      if (in_array($media_tag, $terms)) {
        $term_found = true;
        break;
      }
    endforeach;
    // var_dump( $term_found );
    if ( $term_found )
      return true;
    else
      return false;
  } else {
    if ( $attachments )
      return true;
    else
      return false;
  }

}


