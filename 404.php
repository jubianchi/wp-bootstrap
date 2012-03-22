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

<!DOCTYPE HTML>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php echo strtolower(get_bloginfo('charset')); ?>" />
	<meta name="description" content="<?php echo wpbootstrap_description(); ?>" />
	<meta name="author" content="<?php the_author_meta('display_name', 1); ?>" />
	<meta name="viewport" content="width=device-width,initial-scale=1" />
	<?php echo wpbootstrap_extra_head(); ?>
	
	<title><?php echo wpbootstrap_title(); ?></title>
	
    <script type="text/javascript">
        var wpbootstrap = {
            template_dir: '<?php echo get_template_directory_uri(); ?>',
            post_format: '<?php echo get_post_format(); ?>',
            reply_to: <?php echo isset($_GET['replytocom']) ? (int)$_GET['replytocom'] : 0; ?>
        };
    </script>
    <script data-main="<?php echo get_template_directory_uri(); ?>/js/main" src="<?php echo get_template_directory_uri(); ?>/js/require.js"></script>

	<?php echo wpbootstrap_favicons(); ?>
	<link rel="profile" href="http://gmpg.org/xfn/11"/>
	<link rel="alternate" type="application/rss+xml" title="<?php printf( __('Subscribe to %1$s via RSS', 'wpbootstrap'), get_bloginfo('name')); ?>" href="<?php echo home_url('/feed/'); ?>"/>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>

	<?php wp_head(); ?>

    <style>
        header.hero-unit h2 {
            color: #<?php echo get_header_textcolor(); ?>;
        }
    </style>
</head>
<body <?php body_class(); ?>>

<?php get_template_part('header', 'topbar'); ?>
	
<div class="container" role="document">		
	<header class="hero-unit" style="position: relative; background-image: none;">
		<?php if($theme_config[SHOW_RIBBON_KEY]) : ?>
            <a href="<?php echo $theme_config[RIBBON_URL_KEY]; ?>">
                <img style="position: absolute; top: 0; right: 0; border: 0;" src="<?php echo $theme_config[RIBBON_IMAGE_URL_KEY]; ?>" alt="<?php echo $theme_config[RIBBON_IMAGE_ALT_KEY]; ?>">
            </a>
		<?php endif; ?>
		<h1><a href="<?php echo home_url('/'); ?>"><?php bloginfo('name'); ?></a></h1>
		<p class="sub"><?php bloginfo('description'); ?></p>

        <img src="<?php echo get_template_directory_uri(); ?>/img/404.png" style="margin: 60px 0 20px 0"/>
        <h2><?php _e('Page not found'); ?></h2>
	</header>

<?php get_template_part('footer'); ?>

</body>
