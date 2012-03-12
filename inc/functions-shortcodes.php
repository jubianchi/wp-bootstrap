<?php
function tabs_shortcode_handler($atts, $content = null, $code = "") {
    $atts = shortcode_atts(
        array(
            'title' => 'My Title',
            'foo' => 123
        ),
        $atts
    );

    var_dump(__FUNCTION__, $atts, $content);
}
add_shortcode('tabs', 'tabs_shortcode_handler');

function tabpanel_shortcode_handler($atts, $content = null, $code = "") {
    $atts = shortcode_atts(
        array(
            'title' => 'My Title',
            'foo' => 123
        ),
        $atts
    );

    var_dump(__FUNCTION__, $atts, $content);
}
add_shortcode('tabpanel', 'tabs_shortcode_handler');