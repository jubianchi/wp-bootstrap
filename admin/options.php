<?php
global $theme_config;

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    wpbootstrap_admin_save();
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