<?php
/**
 * @package WordPress
 * @subpackage wp-bootstrap
 * @author jubianchi <contact@jubianchi.fr>
 * @version 2.0
 * @link http://wpbootstrap.jubianchi.fr
 */

add_action('admin_menu', 'wpbootstrap_admin_menu');
if (!function_exists('wpbootstrap_admin_menu')) {
	function wpbootstrap_admin_menu() {
        add_theme_page('wp-bootstrap', 'wp-bootstrap', 'edit_themes', 'wp-bootstrap', 'wpbootstrap_admin_render');
    }

    function wpbootstrap_admin_render() {
        include __DIR__ . '/../admin/options.php';
    }

    function wpbootstrap_admin_save() {
        global $theme_config;

        foreach($_POST as $key => $value) {
            if(array_key_exists($key, $theme_config)) {
                if(is_array($value)) {
                    $value = implode(',', $value);
                }

                update_option(sprintf('wpbootstrap.%s', $key), $value);
            }
        }

        if(!isset($_POST['sticky_formats'])) {
            update_option('wpbootstrap.sticky_formats', '');
        }

        include __DIR__ . '/config.php';
    }
}

function wpbootstrap_admin_image_div() {
    ?>
    <header id="headimg" style="position: relative" class="hero-unit">
        <h1><a href="http://www.local.jubianchi.fr/">wp-bootstrap</a></h1>
		<div id="desc">Wordpress and Bootstrap, from Twitter</div>
	</header>
    <?php
}

function wpbootstrap_admin_header_style() {
    global $theme_config;

    ?><style type="text/css">
        @font-face {
            font-family: 'dock11';
            src: url("<?php echo get_template_directory_uri(); ?>/fonts/dock11.otf") format("opentype");
            src: url("<?php echo get_template_directory_uri(); ?>/fonts/dock11.eot");
            src: url("<?php echo get_template_directory_uri(); ?>/fonts/dock11.eot") format('embedded-opentype'),
                 url("<?php echo get_template_directory_uri(); ?>/fonts/dock11.woff") format('woff'),
                 url("<?php echo get_template_directory_uri(); ?>/fonts/dock11.ttf") format('truetype'),
                 url("<?php echo get_template_directory_uri(); ?>/fonts/dock11.svg") format('svg');

            font-weight: normal;
            font-style: normal;
        }

        .default-header img { width: 450px; }

        header.hero-unit {
            width: 840px!important;
            height: 120px;
            background: no-repeat;
            background-color: #f5f5f5;
            margin-bottom: 30px;
            padding: 60px;
            box-shadow: 0 1px 20px rgba(0, 0, 0, 0.2);
            -webkit-border-radius: 6px;
            -moz-border-radius: 6px;
            border-radius: 6px;
            background-image: url(<?php header_image(); ?>);
            background-color: <?php echo $theme_config[HEADER_BGCOLOR_KEY]; ?>
        }

        header.hero-unit h1, header.hero-unit div#desc {
            font-family: 'dock11', 'Arial Black', 'Arial';
            text-transform: uppercase;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
        }

        header.hero-unit h1 a    {
            margin-bottom: 0;
            font-size: 60px;
            line-height: 1;
            letter-spacing: -1px;
            color: #FC7D3B!important;
            text-decoration: none;
        }
        header.hero-unit div#desc {
            font-size: 2em!important;
            font-weight: 200!important;
            line-height: 27px!important;
            color: #<?php echo get_header_textcolor(); ?>;
        }
        header.hero-unit h1 a:hover { text-decoration: none; }
    </style><?php
}
 
