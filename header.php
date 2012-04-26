<?php
/**
 * @package WordPress
 * @subpackage wp-bootstrap
 * @author jubianchi <contact@jubianchi.fr>
 * @version 2.0
 * @link http://wpbootstrap.jubianchi.fr
 */
?>
<?php global $theme_config; ?>

<?php
if(is_single() || is_page() && isset($posts[0])) {
    foreach($theme_config as $key => $v) {
        $meta = get_post_meta($posts[0]->ID, $key, null);

        if(isset($meta[0])) {
            $theme_config[$key] = $meta[0];
        }
    }
}
?>

<!DOCTYPE HTML>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php echo strtolower(get_bloginfo('charset')); ?>" />
	<meta name="description" content="<?php echo wpbootstrap_description(); ?>" />
	<meta name="author" content="<?php the_author_meta('display_name', 1); ?>" />
	<meta name="viewport" content="width=device-width,initial-scale=1" />
	<?php echo wpbootstrap_extra_head(); ?>
	
	<title><?php echo wpbootstrap_title(); ?></title>

	<?php echo wpbootstrap_favicons(); ?>
	<link rel="profile" href="http://gmpg.org/xfn/11"/>
	<link rel="alternate" type="application/rss+xml" title="<?php printf( __('Subscribe to %1$s via RSS', 'wpbootstrap'), get_bloginfo('name')); ?>" href="<?php echo home_url('/feed/'); ?>"/>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>

	<?php wp_head(); ?>

    <script type="text/javascript">
        var wpbootstrap = {
            template_dir: '<?php echo get_template_directory_uri(); ?>',
            post_format: '<?php echo get_post_format(); ?>',
            reply_to: <?php echo isset($_GET['replytocom']) ? (int)$_GET['replytocom'] : 0; ?>,
            is_home: <?php echo (int)is_home(); ?>,
            is_front:  <?php echo (int)is_front_page(); ?>
        };
    </script>
</head>
<body <?php body_class(); ?> data-spy="scroll" data-target=".subnav" data-offset="50">

<?php get_template_part('header', 'topbar'); ?>
	
<div class="container">
	<?php if(wpbootstrap_show_herounit()) : ?>
		<?php if($theme_config[CUSTOM_HEADER_HTML_KEY] != '') : ?>
			<?php echo stripslashes($theme_config[CUSTOM_HEADER_HTML_KEY]); ?>
		<?php else : ?>
			<header class="hero-unit" style="position: relative">
				<?php if($theme_config[SHOW_RIBBON_KEY]) : ?>
				<a href="<?php echo $theme_config[RIBBON_URL_KEY]; ?>">
					<img style="position: absolute; top: 0; right: 0; border: 0;" src="<?php echo $theme_config[RIBBON_IMAGE_URL_KEY]; ?>" alt="<?php echo $theme_config[RIBBON_IMAGE_ALT_KEY]; ?>">
				</a>
				<?php endif; ?>
				<span class="title"><a href="<?php echo home_url('/'); ?>"><?php bloginfo('name'); ?></a></span>
				<p class="sub"><?php bloginfo('description'); ?></p>
			</header>
		<?php endif; ?>
    <?php endif; ?>

    <?php echo wpbootstrap_breadcrumb(); ?>