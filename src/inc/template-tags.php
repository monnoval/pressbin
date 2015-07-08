<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package pressbin
 */


if ( ! function_exists( 'pressbin_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function pressbin_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( 'Posted on %s', 'post date', 'pressbin' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		_x( 'by %s', 'post author', 'pressbin' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

}
endif;


if ( ! function_exists( 'pressbin_create_html' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function pressbin_create_html( $post ) {

	$html_data  = get_post_meta( $post->ID, 'php_html', true );
	$css_data   = get_post_meta( $post->ID, 'css', true );
	$js_data    = get_post_meta( $post->ID, 'js', true );

	$html  = "<!DOCTYPE html><html class=''><head><meta charset='UTF-8'><meta name='robots' content='noindex'>\n";

	if ( !empty( $css_data ) ) {
	  $html .= "<style>\n";
	  $html .= $css_data;
	  $html .= "</style>\n";
	}

	$html .= "</head><body>\n";

	if ( !empty( $html_data ) ) {
	  $html .= $html_data;
	  $html .= "\n";
	}

	if ( !empty( $js_data ) ) {
	  $html .= "<script>\n";
	  $html .= $js_data;
	  $html .= "</script>\n";
	}

	$html .= "</body></html>";


	$path = dirname( __FILE__ ) . '/../_code/' . $post->post_name . '.html';
	$fh = fopen($path, 'w') or die("can't open file");
	fwrite($fh, $html);
	fclose($fh);
}
endif;

