<?php
$theme_config['debug']              = get_option('wpbootstrap.debug', false);
$theme_config['github_support']     = get_option('wpbootstrap.github_support', false);
$theme_config['github_url']         = get_option('wpbootstrap.github_url', 'https://github.com/jubianchi/wp-bootstrap');

$theme_config['show_search']        = get_option('wpbootstrap.show_search', true);
$theme_config['show_login']         = get_option('wpbootstrap.show_login', true);
//1 = All pages / 2 = All pages except home / 0 = Disabled
$theme_config['show_breadcrumb']    = get_option('wpbootstrap.show_breadcrumb', 2);

$theme_config['sticky_rows']        = get_option('wpbootstrap.sticky_rows', 2);
$theme_config['sticky_formats']     = explode(',', get_option('wpbootstrap.sticky_formats', 'aside,quote'));
array_walk($theme_config['sticky_formats'], create_function('&$item', '$item = \'post-format-\' . $item;'));
$theme_config['sticky_enabled']     = (count($theme_config['sticky_formats']) > 0);

$theme_config['header_bgcolor']     = get_option('wpbootstrap.header_bgcolor', '#C7EEFE');

$theme_config['content_width'] = 960;

$theme_config['formats'] = array(
    'aside',    //Goes into sticky
    'quote',    //Goes into sticky

    'gallery',
    'image',
    'link',
    'status',
    'video',
    'audio',
    'chat'
);

$theme_config['widget_areas'] = array(
	array(
        'name' => __( 'First Footer Column', 'wpbootstrap' ),
        'id' => 'foot-col-1',
        'description' => __( 'First Footer Column', 'wpbootstrap' ),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ),
	array(
        'name' => __('Second Footer Column', 'wpbootstrap'),
        'id' => 'foot-col-2',
        'description' => __('Second Footer Column', 'wpbootstrap'),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ),
	array(
        'name' => __('Third Footer Column', 'wpbootstrap'),
        'id' => 'foot-col-3',
        'description' => __('Third Footer Column', 'wpbootstrap'),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ),
    array(
        'name' => __('Second Footer Row', 'wpbootstrap'),
        'id' => 'foot-row-2',
        'description' => __( 'Second Footer Row', 'wpbootstrap' ),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ),
    array(
        'name' => __('404 Widget Area', 'wpbootstrap'),
        'id' => '404-war',
        'description' => __( '404 Widget Area', 'wpbootstrap' ),
        'before_widget' => '<div id="%1$s" class="%2$s span4">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    )
);

return $theme_config;