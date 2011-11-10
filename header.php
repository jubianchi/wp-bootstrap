<!DOCTYPE HTML>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php echo strtolower( get_bloginfo( 'charset' ) ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="description" content="<?php echo bootstrap_description(); ?>" />
	<meta name="author" content="<?php the_author_meta( 'display_name', 1 ); ?>" />
	<meta name="viewport" content="width=device-width,initial-scale=1" />
	<?php echo bootstrap_extra_head(); ?>
	
	<title><?php echo bootstrap_title(); ?></title>
	
	<?php 
	/* 
	 * Drop these lines if you combined your CSS 
	 */ 
	?>
    <!--
	<link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri(); ?>/css/facebox.css" rel="stylesheet">	
	<link href="<?php echo get_template_directory_uri(); ?>/css/style.css" rel="stylesheet">	
	-->
    <link rel="stylesheet/less" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/less/bootstrap.less">
	<style type="text/css">
		<?php include(get_template_directory() . '/css/prettify.css'); ?>
        <?php include(get_template_directory() . '/css/facebox.css'); ?>
	</style>

    <script type="text/javascript">
        less = { env: 'development' };
        less.watch();
    </script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/less.js" type="text/javascript"></script>

	<?php 
	/* 
	 * Uncomment this line if you combined your CSS
	 *                  |
	 *                 _|_
	 *                \  /
	 *                 \/
	 * <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/wp-bootstrap.css"/>
	 */ 
	?>
	
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
					<a class="brand<?php if($menu) : ?> dropdown-toggle<?php endif; ?>" href="<?php echo home_url( '/' ); ?>">
                        <?php echo get_bloginfo('name'); ?>
                    </a>
					<?php echo $menu ?>
				</li>
        <li>
          <a href="<?php echo home_url( '/' ); ?>">
              <?php echo __('Home'); ?>
          </a>
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
					<li>					
						<a href="/wp-login.php" data-controls-modal="modal-login" data-backdrop="static"><?php echo __('Login', 'wpbootstrap'); ?></a>					
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
	<div class="hero-unit" style="position: relative;">
		<a href="https://github.com/jubianchi/wp-bootstrap">
			<img style="position: absolute; top: 0; right: 0; border: 0;" src="https://a248.e.akamai.net/assets.github.com/img/7afbc8b248c68eb468279e8c17986ad46549fb71/687474703a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6461726b626c75655f3132313632312e706e67" alt="Fork me on GitHub">
		</a>
		
		<h1><a href="<?php echo home_url( '/' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<p class="sub"><?php bloginfo( 'description' ); ?></p>
	</div>

    <?php if(!is_404()) : ?>
	    <?php echo bootstrap_breadcrumbs(); ?>
    <?php else : ?>
        <div class="hero-unit" style="background-color: transparent; border: none; padding: 40px;">
            <div class="pull-left span5">
                <p class="sub">Ooops... this is a</p>
                <h1 style="font-size: 10em;">404</a></h1>
            </div>
            <div class="pull-right span10">
                <p>
                    It seems like the page your are lokking for does not exist.
                </p>
            </div>
        </div>
    <?php endif; ?>
	
