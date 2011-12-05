<?php
add_action('admin_menu', 'bootstrap_admin_menu');
if (!function_exists( 'bootstrap_admin_menu')) :
	function bootstrap_admin_menu() {
        add_theme_page('wp-bootstrap', 'wp-bootstrap', 'edit_themes', 'wp-bootstrap', 'bootstrap_admin_render');
    }

    function bootstrap_admin_render() {
        include __DIR__ . '/../admin/options.php';
    }

    function bootstrap_admin_save() {
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
endif;
 
