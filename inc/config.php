<?php
/**
 * @package WordPress
 * @subpackage wp-bootstrap
 * @author jubianchi <contact@jubianchi.fr>
 * @version 2.0
 * @link http://wpbootstrap.jubianchi.fr
 */

$theme_config[SHOW_BREADCRUMB_KEY]      = get_option(wp_option_key(SHOW_BREADCRUMB_KEY),    ALL_PAGES_BUT_HOME);
$theme_config[SHOW_HERO_UNIT_KEY]       = get_option(wp_option_key(SHOW_HERO_UNIT_KEY),     ALL_PAGES);
$theme_config[SHOW_LOGIN_KEY]           = get_option(wp_option_key(SHOW_LOGIN_KEY),         ALL_PAGES);
$theme_config[SHOW_RIBBON_KEY]          = get_option(wp_option_key(SHOW_RIBBON_KEY),        false);
$theme_config[SHOW_SEARCH_KEY]          = get_option(wp_option_key(SHOW_SEARCH_KEY),        ALL_PAGES);

$theme_config[RIBBON_URL_KEY]           = get_option(wp_option_key(RIBBON_URL_KEY),         'https://github.com/jubianchi/wp-bootstrap');
$theme_config[RIBBON_IMAGE_URL_KEY]     = get_option(wp_option_key(RIBBON_IMAGE_URL_KEY),   'https://a248.e.akamai.net/assets.github.com/img/7afbc8b248c68eb468279e8c17986ad46549fb71/687474703a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6461726b626c75655f3132313632312e706e67');
$theme_config[RIBBON_IMAGE_ALT_KEY]     = get_option(wp_option_key(RIBBON_IMAGE_ALT_KEY),   'Fork me on GitHub');

$theme_config[STICKY_ROWS_KEY]          = get_option(wp_option_key(STICKY_ROWS_KEY),        2);
$theme_config[STICKY_FORMATS_KEY]       = explode(',', get_option(wp_option_key(STICKY_FORMATS_KEY), 'aside,quote,gallery'));
array_walk($theme_config[STICKY_FORMATS_KEY], create_function('&$item', '$item = \'post-format-\' . $item;'));
$theme_config[STICKY_ENABLED_KEY]       = (count($theme_config[STICKY_FORMATS_KEY]) > 0);

$theme_config[HEADER_BGCOLOR_KEY]       = get_option(wp_option_key(HEADER_BGCOLOR_KEY),     '#F5F5F5');

$theme_config[CONTENT_WIDTH_KEY]        = 1170;

$theme_config[SHOW_PAGE_TITLE_KEY]      = get_option(wp_option_key(SHOW_PAGE_TITLE_KEY),        true);

$theme_config[POST_FORMATS_KEY]         = array(
    'aside',
    'quote',
    'gallery',

    /*'image',
    'link',
    'status',
    'video',
    'audio',
    'chat'*/
);

$theme_config[WIDGET_AREAS_KEY]         = array(
    'foot-col-1' => array(
        'name' => __('First Footer Column', 'wpbootstrap'),
        'id' => 'foot-col-1',
        'description' => __('First Footer Column', 'wpbootstrap'),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ),
    'foot-col-2' => array(
        'name' => __('Second Footer Column', 'wpbootstrap'),
        'id' => 'foot-col-2',
        'description' => __('Second Footer Column', 'wpbootstrap'),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ),
    'foot-col-3' => array(
        'name' => __('Third Footer Column', 'wpbootstrap'),
        'id' => 'foot-col-3',
        'description' => __('Third Footer Column', 'wpbootstrap'),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ),
    'foot-row-2' => array(
        'name' => __('Second Footer Row', 'wpbootstrap'),
        'id' => 'foot-row-2',
        'description' => __('Second Footer Row', 'wpbootstrap'),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ),
    '404-war' => array(
        'name' => __('404 Widget Area', 'wpbootstrap'),
        'id' => '404-war',
        'description' => __('404 Widget Area', 'wpbootstrap'),
        'before_widget' => '<div id="%1$s" class="%2$s span4">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    )
);

return $theme_config;