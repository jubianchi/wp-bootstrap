<?php
add_action( 'after_setup_theme', 'bootsrap_setup' );
if (!function_exists( 'bootsrap_setup')):	
	function bootsrap_setup() {
		if (!isset( $content_width)) $content_width = 960;

		load_theme_textdomain( 'bootstrap', TEMPLATEPATH . '/languages' );

		$locale = get_locale();
		$locale_file = TEMPLATEPATH . "/languages/$locale.php";
		if (is_readable( $locale_file ))
			require_once( $locale_file );

		register_nav_menus( array(
			'toolbar'	=> __( 'Toolbar navigation', 'bootstrap' ),
			'home'		=> __( 'Home navigation', 'bootstrap' )
		) );

		add_theme_support( 'automatic-feed-links' );


		add_theme_support( 
			'post-formats', array( 
				'aside', 
				'gallery', 
				'link', 
				'image', 
				'quote', 
				'status', 
				'video', 
				'audio', 
				'chat' 
			)
		);

		/*
		register_post_type('aside',
			array(
				'labels' => array(
					'name' => __( 'Discography' ),
					'singular_name' => __( 'Discography' ),
					'add_new' => __( 'Add New' ),
					'add_new_item' => __( 'Add New Discography' ),
					'edit' => __( 'Edit' ),
					'edit_item' => __( 'Edit Discography' ),
					'new_item' => __( 'New Discography' ),
					'view' => __( 'View Discography' ),
					'view_item' => __( 'View Discography' ),
					'search_items' => __( 'Search Discographys' ),
					'not_found' => __( 'No Discographys found' ),
					'not_found_in_trash' => __( 'No Discographys found in Trash' ),
					'parent' => __( 'Parent Discography' ),
				),
				'public' => true,
				'show_ui' => true,
				'exclude_from_search' => true,
				'hierarchical' => true,
				'supports' => array( 'title', 'editor', 'thumbnail' ),
				'query_var' => true
			)
		);
		 */
	}
endif;

add_action( 'widgets_init', 'bootstrap_widgets_init' );
if (!function_exists( 'bootstrap_widgets_init' ) ) :
	function bootstrap_widgets_init() {
		register_sidebar( array (
			'name' => __( 'One', 'basics' ),
			'id' => 'war-1',
			'description' => __( 'Widgets Area One', 'basics' ),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		) );
		register_sidebar( array (
			'name' => __( 'First Footer Column', 'basics' ),
			'id' => 'foot-col-1',
			'description' => __( 'Widgets Area Two', 'basics' ),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		) );
		register_sidebar( array (
			'name' => __( 'Second Footer Column', 'basics' ),
			'id' => 'foot-col-2',
			'description' => __( 'Widgets Area Three', 'basics' ),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		) );
		register_sidebar( array (
			'name' => __( 'Third Footer Column', 'basics' ),
			'id' => 'foot-col-3',
			'description' => __( 'Widgets Area Four', 'basics' ),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		) );
		register_sidebar( array (
			'name' => __( 'Fourth Footer Column', 'basics' ),
			'id' => 'foot-col-4',
			'description' => __( 'Widgets Area Five', 'basics' ),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		) );	
	}
endif;
?>