<?php
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
add_filter('wp_page_menu_args', 'bootstrap_page_menu_args');
if(! function_exists('bootstrap_page_menu_args')) :
function bootstrap_page_menu_args($args) {
	$args['show_home'] = true;
	return $args;
}
endif;
	
/**
 * Sets the post excerpt length to 52 characters.
 */
/*
add_filter('excerpt_length', 'bootstrap_excerpt_length');
if(!function_exists('bootstrap_excerpt_length')) {
function bootstrap_excerpt_length($length) {
	return 52;
}
endif;
*/

/**
 * Returns a "Continue Reading" link for excerpts
 */
if (!function_exists('bootstrap_continue_reading_link')) {
    function bootstrap_continue_reading_link() {
        return sprintf(
            ' <a href="%s" rel="nofollow">%s</a>',
            get_permalink(),
            __('Continue reading <span class="meta-nav">&rarr;</span>', 'wpbootstrap')
        );
    }
}

add_filter('excerpt_more', 'bootstrap_auto_excerpt_more');
if (!function_exists('bootstrap_auto_excerpt_more')) {
    function bootstrap_auto_excerpt_more( $more ) {
        return sprintf(' &hellip;%s', bootstrap_continue_reading_link());
    }
}

add_filter('get_the_excerpt', 'bootstrap_custom_excerpt_more');
if (!function_exists('bootstrap_custom_excerpt_more')) :
function bootstrap_custom_excerpt_more( $output ) {
	if(has_excerpt() && ! is_attachment()) {
		$output .= bootstrap_continue_reading_link();
	}
	return $output;
}
endif;


/**
 * Add custom body classes
 */
add_filter('body_class', 'bootstrap_body_class');
if (!function_exists('bootstrap_body_class')) :
	function bootstrap_body_class($classes) {
		if(is_singular()) $classes[] = 'singular';
		return $classes;
	}
endif;

/**
 * The Caption shortcode with figure and figcaption.
 */
if(! function_exists('bootstrap_img_caption_shortcode')) :
	function bootstrap_img_caption_shortcode($attr, $content = null) {
		// Allow plugins/themes to override the default caption template.
		$output = apply_filters('img_caption_shortcode', '', $attr, $content);
		if($output != '')
			return $output;

		extract(shortcode_atts(array(
			'id'	=> '',
			'align'	=> 'alignnone',
			'width'	=> '',
			'caption' => ''
		), $attr));

		if(1 > (int) $width || empty($caption))
			return $content;

		if($id ) $id = 'id="' . esc_attr($id) . '" ';

		return '<figure ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: ' . (0 + (int) $width) . 'px">'
		. do_shortcode( $content ) . '<figcaption class="wp-caption-text">' . $caption . '</figcaption></figure>';
	}
endif;
add_shortcode('wp_caption', 'bootstrap_img_caption_shortcode');
add_shortcode('caption', 'bootstrap_img_caption_shortcode');

/**
 * Add support for iframe element in wysiwyg editor 
 * http://wpengineer.com/1963/customize-wordpress-wysiwyg-editor/
 */
add_filter('tiny_mce_before_init', 'bootstrap_change_mce_options');
if(! function_exists('bootstrap_change_mce_options')) :
	function bootstrap_change_mce_options( $initArray ) {
		// Comma separated string od extendes tags
		// Command separated string of extended elements
		$ext = 'pre[id|name|class|style],iframe[align|longdesc|name|width|height|frameborder|scrolling|marginheight|marginwidth|src]';
		if(isset( $initArray['extended_valid_elements'] )) {
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
if(! function_exists('posts_link_rel_next')) :
	function posts_link_rel_next(){
		return 'rel="next"';
	}
endif;

/**
 * Print rel "prev" microformats attributes on navivagation links between posts.
 */ 
add_filter('previous_posts_link_attributes', 'posts_link_rel_prev');
if (!function_exists('posts_link_rel_prev')) :
	function posts_link_rel_prev(){
		return 'rel="prev"';
	}
endif;

/**
 * Remove link Jumps to the More tag or Top of Page
 */ 
add_filter('the_content_more_link', 'remove_more_jump_link');
if (!function_exists('remove_more_jump_link')) :
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
if (!function_exists('bootstrap_searchform')) :
	function bootstrap_searchform() {
		$home_url = home_url('/');
        $placeholder = __('Search in (hit Enter)', 'wpbootstrap');
        
        return <<<HTML
<form class="search form-stacked" action="$home_url" method="get" role="search">
<div class="clearfix">
    <div class="input">
        <input type="text" name="s" placeholder="$placeholder" required>
    </div>
</div>
</form>
HTML;
	}    
endif;

add_filter('the_content', 'bootstrap_the_content');
if (!function_exists('bootstrap_the_content')) :
	function bootstrap_the_content($content) {
        //$content = preg_replace('/(\<p[ ]?(class="([\.|\#]?\w+)")?\>)/', '<p class="$2 clearfix">', $content);

        return $content;
	}
endif;
?>