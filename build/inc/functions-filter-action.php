<?php
/*
@package WordPress
@subpackage Basics
@author Bruno Bichet <bruno.bichet@gmail.com>
@version 0.2.8
@since Version 0.2.7
For Those About to Rock. Fire!
*/

/*
TOC:
remove_filter()					Remove <p> in category or tag description
basics_page_menu_args()			Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
basics_excerpt_length()			Sets the post excerpt length to 52 characters.
basics_continue_reading_link()	Returns a "Continue Reading" link for excerpts
basics_auto_excerpt_more()		Replaces "[...]" with an ellipsis and basics_continue_reading_link().
basics_custom_excerpt_more()	Adds a pretty "Continue Reading" link to custom post excerpts.
basics_widgets_init()			Register widgetized area and update sidebar with default widgets
basics_body_class()				Add custom body classes
basics_img_caption_shortcode()	The Caption shortcode with figure and figcaption.
basics_change_mce_options()		Add support for iframe element in wysiwyg editor
basics_jquery()					Load jQuery in footer
basics_scripts()				Load other Javascripts in footer
posts_link_rel_next()			Print rel "next" microformats attributes on navivagation links between posts
posts_link_rel_prev()			Print rel "prev" microformats attributes on navivagation links between posts
remove_more_jump_link()			Remove link Jumps to the More tag or Top of Page
basics_searchform()				Display Search Form
*/

/**
 * Disable the wpautop function so that WordPress makes no attempt to correct your markup.
 * http://nicolasgallagher.com/using-html5-elements-in-wordpress-post-content/
 */
//remove_filter('the_excerpt', 'wpautop');
//remove_filter('the_content', 'wpautop');

/* Remove <p> in category or tag description */
remove_filter('term_description','wpautop');
 
/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
add_filter( 'wp_page_menu_args', 'basics_page_menu_args' );
if ( ! function_exists( 'basics_page_menu_args' ) ) :
function basics_page_menu_args($args) {
	$args['show_home'] = true;
	return $args;
}
endif;
	
/**
 * Sets the post excerpt length to 52 characters.
 */
/*
add_filter( 'excerpt_length', 'basics_excerpt_length' );
if ( ! function_exists( 'basics_excerpt_length' ) ) :
function basics_excerpt_length( $length ) {
	return 52;
}
endif;
*/

/**
 * Returns a "Continue Reading" link for excerpts
 */
if ( ! function_exists( 'bootstrap_continue_reading_link' ) ) :
function bootstrap_continue_reading_link() {
	return ' <a href="'. get_permalink() . '" rel="nofollow">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'wpbootstrap' ) . '</a>';
}
endif;

/**
 * Replaces "[...]" (appended to automatically generated excerpts) 
 * with an ellipsis and basics_continue_reading_link().
 */
add_filter( 'excerpt_more', 'basics_auto_excerpt_more' );
if ( ! function_exists( 'basics_auto_excerpt_more' ) ) :
function basics_auto_excerpt_more( $more ) {
	return ' &hellip;' . bootstrap_continue_reading_link();
}
endif;

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 */
add_filter( 'get_the_excerpt', 'basics_custom_excerpt_more' );
if ( ! function_exists( 'basics_custom_excerpt_more' ) ) :
function basics_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= bootstrap_continue_reading_link();
	}
	return $output;
}
endif;

/**
 * Register widgetized area and update sidebar with default widgets
 */


/**
 * Add custom body classes
 */
add_filter( 'body_class', 'bootstrap_body_class' );
if ( ! function_exists( 'bootstrap_body_class' ) ) :
	function bootstrap_body_class($classes) {
		if (is_singular())
			$classes[] = 'singular';
		return $classes;
	}
endif;

/**
 * The Caption shortcode with figure and figcaption.
 */
if ( ! function_exists( 'bootstrap_img_caption_shortcode' ) ) :
	function bootstrap_img_caption_shortcode($attr, $content = null) {
		// Allow plugins/themes to override the default caption template.
		$output = apply_filters('img_caption_shortcode', '', $attr, $content);
		if ( $output != '' )
			return $output;

		extract(shortcode_atts(array(
			'id'	=> '',
			'align'	=> 'alignnone',
			'width'	=> '',
			'caption' => ''
		), $attr));

		if ( 1 > (int) $width || empty($caption) )
			return $content;

		if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

		return '<figure ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: ' . (0 + (int) $width) . 'px">'
		. do_shortcode( $content ) . '<figcaption class="wp-caption-text">' . $caption . '</figcaption></figure>';
	}
endif;
add_shortcode('wp_caption', 'basics_img_caption_shortcode');
add_shortcode('caption', 'basics_img_caption_shortcode');

/**
 * Add support for iframe element in wysiwyg editor 
 * http://wpengineer.com/1963/customize-wordpress-wysiwyg-editor/
 */
add_filter('tiny_mce_before_init', 'bootstrap_change_mce_options');
if ( ! function_exists( 'bootstrap_change_mce_options' ) ) :
	function bootstrap_change_mce_options( $initArray ) {
		// Comma separated string od extendes tags
		// Command separated string of extended elements
		$ext = 'pre[id|name|class|style],iframe[align|longdesc|name|width|height|frameborder|scrolling|marginheight|marginwidth|src]';
		if ( isset( $initArray['extended_valid_elements'] ) ) {
			$initArray['extended_valid_elements'] .= ',' . $ext;
		} else {
			$initArray['extended_valid_elements'] = $ext;
		}
		// maybe; set tiny paramter verify_html
		//$initArray['verify_html'] = false;
		return $initArray;
	}
endif;

/**
 * Print rel "next" microformats attributes on navivagation links between posts.
 */ 
add_filter('next_posts_link_attributes', 'posts_link_rel_next');
if ( ! function_exists( 'posts_link_rel_next' ) ) :
	function posts_link_rel_next(){
		return 'rel="next"';
	}
endif;

/**
 * Print rel "prev" microformats attributes on navivagation links between posts.
 */ 
add_filter('previous_posts_link_attributes', 'posts_link_rel_prev');
if (!function_exists( 'posts_link_rel_prev' )) :
	function posts_link_rel_prev(){
		return 'rel="prev"';
	}
endif;

/**
 * Remove link Jumps to the More tag or Top of Page
 */ 
add_filter('the_content_more_link', 'remove_more_jump_link');
if (!function_exists( 'remove_more_jump_link')) :
	function remove_more_jump_link($link) { 
		$offset = strpos($link, '#more-');
		if ($offset) {
			$end = strpos($link, '"', $offset);
		}
		if ($end) {
			$link = substr_replace($link, '', $offset, $end-$offset);
		}
		return $link;
	}
endif;

add_filter('get_search_form', 'bootstrap_searchform');
if (!function_exists( 'bootstrap_searchform')) :	
	function bootstrap_searchform() {
		return '<form class="pull-right" action="' . home_url('/') . '" method="get" role="search">'
			  .'<input type="text" name="s" placeholder="' . __('Search in (hit Enter)', 'wpbootstrap') . '">'
		      .'</form>';
	}    
endif;
?>