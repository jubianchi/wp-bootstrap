<?php
add_action( 'after_setup_theme', 'bootstrap_setup' );
if (!function_exists( 'bootstrap_setup')):
	function bootstrap_setup() {
		global $theme_config;

        load_theme_textdomain('wpbootstrap', TEMPLATEPATH . '/languages');
        $locale      = get_locale();
		$locale_file = TEMPLATEPATH . '/languages/' . $locale . '.php';
		if(is_readable( $locale_file )) require_once($locale_file);

        if(!isset($theme_config['content_width'])) $theme_config['content_width'] = 960;

		register_nav_menus(array(
			'toolbar'	=> __( 'Toolbar navigation', 'wpbootstrap' ),
			'home'		=> __( 'Home navigation', 'wpbootstrap' )
		));

		add_theme_support('automatic-feed-links');
		add_theme_support('post-formats', $theme_config['formats']);
	}
endif;

add_action( 'widgets_init', 'bootstrap_widgets_init' );
if (!function_exists( 'bootstrap_widgets_init' ) ) :
	function bootstrap_widgets_init() {
		global $theme_config;

        foreach($theme_config['widget_areas'] as $area) {
            register_sidebar($area);
        }
	}
endif;
?>