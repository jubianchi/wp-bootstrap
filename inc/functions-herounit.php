<?php
/**
 * @package WordPress
 * @subpackage wp-bootstrap
 * @author jubianchi <contact@jubianchi.fr>
 * @version 2.0
 * @link http://wpbootstrap.jubianchi.fr
 */

function wpbootstrap_show_herounit() {
    global $theme_config;

    return (
        $theme_config[SHOW_HERO_UNIT_KEY] != DISABLED &&
        (
            $theme_config[SHOW_HERO_UNIT_KEY] == ALL_PAGES ||
            (
                $theme_config[SHOW_HERO_UNIT_KEY] == ALL_PAGES_BUT_HOME &&
                !is_home() && !is_front_page()
            )
        )
    );
}