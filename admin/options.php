<?php
global $theme_config;
$base = get_bloginfo('template_url');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    bootstrap_admin_save();
}

function active_class($tab) {
    return (!isset($_GET['tab']) && $tab == 'navigation') || ($tab == $_GET['tab']) ? ' nav-tab-active' : '';
}
?>

<div class="wrap">
    <div id="icon-themes" class="icon32"><br></div><h2>wp-bootstrap</h2>

    <h2 class="nav-tab-wrapper">
        <a class="nav-tab<?php echo active_class('navigation'); ?>" href="?page=wp-bootstrap&amp;tab=navigation"><?php _e('Navigation', 'wpbootstrap'); ?></a>
        <a class="nav-tab<?php echo active_class('homepage'); ?>" href="?page=wp-bootstrap&amp;tab=homepage"><?php _e('Home page', 'wpbootstrap'); ?></a>
        <a class="nav-tab<?php echo active_class('header'); ?>" href="?page=wp-bootstrap&amp;tab=header"><?php _e('Header', 'wpbootstrap'); ?></a>
    </h2>

    <?php
    switch($_GET['tab']) {
        case 'homepage':
            include __DIR__ . '/options-homepage.php';
            break;
        case 'header':
            include __DIR__ . '/options-header.php';
            break;
        default:
            include __DIR__ . '/options-navigation.php';
            break;
    }
    ?>
</div>
<link rel="stylesheet" type="text/css" href="/wp-admin/css/farbtastic.css"/>
<script type="text/javascript" src="/wp-admin/js/farbtastic.js"></script>
<script type="text/javascript">
    var farbtastic,
        default_color    = '<?php echo $theme_config['header_bgcolor']; ?>',
        header           = jQuery('#header_bgcolor'),
        picker_handle    = jQuery('#pickcolor'),
        picker_cont_sel  = '#color-picker',
        picker_container = jQuery(picker_cont_sel);

    function pickColor(color) {
        farbtastic.setColor(color);
        header.val(color)
    }

    jQuery(document).ready(function() {
        picker_handle.click(function() {
            picker_container.show();
        });

        header.keyup(function() {
            var _hex = header.val(),
                hex = _hex;

            if(hew.indexOf('#') == 0) {
                hex = hex.replace(/[^#a-fA-F0-9]+/, '');
            }
            if (hex != _hex) header.val(hex);
            if (hex.length == 4 || hex.length == 7) pickColor(hex);
        });

        jQuery(document).mousedown(function(){
            picker_container.each( function() {
                var display = jQuery(this).css('display');
                if (display == 'block') jQuery(this).fadeOut(2);
            });
        });

        farbtastic = jQuery.farbtastic(picker_cont_sel, function(color) { pickColor(color); });
        pickColor(default_color);
    });
</script>