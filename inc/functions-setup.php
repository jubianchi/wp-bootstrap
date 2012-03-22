<?php
define('HEADER_TEXTCOLOR', '404040');
define('HEADER_IMAGE_WIDTH', $theme_config[CONTENT_WIDTH_KEY]);
define('HEADER_IMAGE_HEIGHT', 240);

add_action('after_setup_theme', 'wpbootstrap_setup');
if (!function_exists('wpbootstrap_setup')):
	function wpbootstrap_setup() {
		global $theme_config;

        load_theme_textdomain('wpbootstrap', TEMPLATEPATH . '/languages');
        $locale      = get_locale();
		$locale_file = TEMPLATEPATH . '/languages/' . $locale . '.php';
		if(is_readable( $locale_file )) require_once($locale_file);

		register_nav_menus(array(
			'toolbar'	=> __('Toolbar navigation', 'wpbootstrap'),
			'home'		=> __('Home navigation', 'wpbootstrap')
		));

		add_theme_support('automatic-feed-links');
		add_theme_support('post-formats', $theme_config[POST_FORMATS_KEY]);
        add_theme_support('post-thumbnails');

        add_custom_image_header('wpbootstrap_header_style', 'wpbootstrap_admin_header_style', 'wpbootstrap_admin_image_div');
        register_default_headers(array(
            'gray' => array(
              'url' => get_template_directory_uri() . '/img/header/header_gray.png',
              'thumbnail_url' => get_template_directory_uri() . '/img/header/header_gray.png',
              'description' => __('Gray textured header')
            ),
            'blue' => array(
              'url' => get_template_directory_uri() . '/img/header/header_blue.png',
              'thumbnail_url' => get_template_directory_uri() . '/img/header/header_blue.png',
              'description' => __('Blue textured header')
            ),
            'alpha' => array(
              'url' => get_template_directory_uri() . '/img/header/header_alpha.png',
              'thumbnail_url' => get_template_directory_uri() . '/img/header/header_alpha.png',
              'description' => __('Transparent textured header')
            )
        ));

        add_editor_style('css/editor-style.css');
	}
endif;

add_action('widgets_init', 'wpbootstrap_widgets_init');
if (!function_exists('wpbootstrap_widgets_init')) :
	function wpbootstrap_widgets_init() {
		global $theme_config;

        foreach($theme_config[WIDGET_AREAS_KEY] as $area) {
            register_sidebar($area);
        }
	}
endif;

function wpbootstrap_header_style() {
    global $theme_config;
    
    ?><style type="text/css">
        header.hero-unit {
            background-image: url(<?php header_image(); ?>);
            background-color: <?php echo $theme_config[HEADER_BGCOLOR_KEY]; ?>
        }
        header.hero-unit p.sub {
            color: #<?php echo get_header_textcolor(); ?>;
        }
    </style><?php
}

add_action('wp_enqueue_scripts', 'wpbootstrap_scripts_init');
if (!function_exists('wpbootstrap_scripts_init')) {
    function wpbootstrap_scripts_init() {
        $jsdir = get_template_directory_uri() . '/js';
        $scripts = array(
            'main'  => $jsdir . '/wp-bootstrap.min.js',
        );

        foreach($scripts as $name => $uri) {
            wp_deregister_script($name);
            wp_register_script($name, $uri);
            wp_enqueue_script($name);
        }
    }
}

add_action('wp_enqueue_scripts', 'wpbootstrap_styles_init');
if (!function_exists('wpbootstrap_styles_init')) {
    function wpbootstrap_styles_init() {
        $themedir = get_template_directory_uri();
        $cssdir = $themedir . '/css';
        $styles = array(
            'main'  => $cssdir . '/wp-bootstrap.css',
            'style' => $themedir . '/style.css',
        );

        foreach($styles as $name => $uri) {
            wp_deregister_style($name);
            wp_register_style($name, $uri);
            wp_enqueue_style($name);
        }
    }
}
