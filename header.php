<!DOCTYPE HTML>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php echo strtolower( get_bloginfo( 'charset' ) ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="description" content="<?php echo bootstrap_description(); ?>" />
	<meta name="author" content="<?php the_author_meta( 'display_name', 1 ); ?>" />
	<meta name="viewport" content="width=device-width,initial-scale=1" />
	<?php echo bootstrap_extra_head(); ?>
	
	<title><?php echo bootstrap_title(); ?></title>
	
	<link href="<?php echo get_template_directory_uri(); ?>/style.css" rel="stylesheet">
	
	<?php echo bootstrap_favicons(); ?>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="alternate" type="application/rss+xml" title="<?php printf( __( 'Subscribe to %1$s via RSS', 'basics' ), get_bloginfo( 'name' ) ); ?>" href="<?php echo home_url( '/feed/' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
	
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="topbar">
	<div class="fill">
		<div class="container">
			<ul class="nav">
				<?php 
				$menu = wp_nav_menu( 
					array( 
						'theme_location' => 'home',
						'container' => false,
						'menu_class' => 'dropdown-menu',
						'fallback_cb' => false,
						'echo' => false
					) 
				); 							
				?>
				<li class="<?php if($menu) : ?>dropdown<?php endif; ?>" data-dropdown="dropdown">										
					<a class="brand<?php if($menu) : ?> dropdown-toggle<?php endif; ?>" href="<?php echo home_url( '/' ); ?>">JUBIANCHI.FR</a>
					<?php echo $menu ?>
				</li>
			</ul>			
			<?php wp_nav_menu( 
				array( 
					'theme_location' => 'toolbar',
					'container' => false,
					'menu_class' => 'nav'
				) 
			); ?>
			<?php if(!is_user_logged_in()) : ?>
				<ul class="nav secondary-nav">
					<li class="dropdown" data-dropdown="dropdown">					
						<a href="/wp-login.php" class="dropdown-toggle" data-controls-modal="modal-login" data-backdrop="static"><?php echo __('Login', 'wpbootstrap'); ?></a>					
					</li>
				</ul>
			<?php else : ?>
				<?php 
				global $current_user;
				$user_identity = get_currentuserinfo();	
				?>
				<ul class="nav secondary-nav">
					<li>
						<a href="<?php echo wp_logout_url(apply_filters('the_permalink', get_permalink($post_id))); ?>">
							<?php echo __('Logout', 'wpbootstrap'); ?>
						</a>
					</li>
				</ul>
			<?php endif; ?>				
			
            <?php get_search_form(); ?>
		</div>
	</div>
</div>

<div class="container" role="document">		
	<div class="hero-unit">
		<h1><a href="<?php echo home_url( '/' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<p class="sub"><?php bloginfo( 'description' ); ?></p>
	</div>

	<?php echo bootstrap_breadcrumbs(); ?>
	
