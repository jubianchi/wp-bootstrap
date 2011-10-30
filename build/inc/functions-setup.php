<?php
add_action('admin_menu', 'bootstrap_admin_menu');
if (!function_exists( 'bootstrap_admin_menu')) :
	function bootstrap_admin_menu() {
        add_theme_page('WPBootstrap Options', 'WPBootstrap Options', 'edit_themes', 'wp-bootstrap', 'bootstrap_admin_render');
    }

    function bootstrap_admin_render() {
        include __DIR__ . '/../admin/options.php';
    }
endif;
    
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
		register_sidebar( array (
			'name' => __('One', 'wpbootstrap'),
			'id' => 'war-1',
			'description' => __('Widgets Area One', 'wpbootstrap'),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		) );
		register_sidebar( array (
			'name' => __( 'First Footer Column', 'wpbootstrap' ),
			'id' => 'foot-col-1',
			'description' => __( 'First Footer Column', 'wpbootstrap' ),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		) );
		register_sidebar( array (
			'name' => __('Second Footer Column', 'wpbootstrap'),
			'id' => 'foot-col-2',
			'description' => __('Second Footer Column', 'wpbootstrap'),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		) );
		register_sidebar( array (
			'name' => __('Third Footer Column', 'wpbootstrap'),
			'id' => 'foot-col-3',
			'description' => __('Third Footer Column', 'wpbootstrap'),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		) );
		register_sidebar( array (
			'name' => __('Second Footer Row', 'wpbootstrap'),
			'id' => 'foot-row-2',
			'description' => __( 'Second Footer Row', 'wpbootstrap' ),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		) );	
	}
endif;
?>