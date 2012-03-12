<?php global $theme_config; ?>

<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<ul class="nav">
				<?php 
				$menu = wp_nav_menu( 
					array( 
						'theme_location'    => 'home',
						'container'         => false,
						'menu_class'        => 'dropdown-menu',
						'fallback_cb'       => false,
						'echo'              => false
					) 
				); 							
				?>
				<li class="<?php if($menu) : ?>dropdown<?php endif; ?>">
					<a class="brand<?php if($menu) : ?> dropdown-toggle<?php endif; ?>" <?php if($menu) : ?>data-toggle="dropdown"<?php endif; ?> href="<?php echo home_url('/'); ?>">
                        <?php echo get_bloginfo('name'); ?>
                    </a>
					<?php echo $menu ?>
				</li>
			</ul>			
			<?php wp_nav_menu( 
				array( 
					'theme_location'    => 'toolbar',
					'container'         => false,
					'menu_class'        => 'nav'
				) 
			); ?>

            <?php if($theme_config['show_login']) : ?>
                <?php if(!is_user_logged_in()) : ?>
                    <ul class="nav pull-right">
                        <li>
                            <?php
                            $href = wp_login_url(apply_filters('the_permalink', get_permalink($post_id)));
                            ?>
                            <a href="#modal-login" data-toggle="modal">
                                <?php _e('Login', 'wpbootstrap'); ?>
                            </a>
                        </li>
                    </ul>
                <?php else : ?>
                    <?php
                    global $current_user;
                    $user_identity = get_currentuserinfo();
                    ?>
                    <ul class="nav pull-right">
                        <li>
                            <?php
                            $href = wp_logout_url(apply_filters('the_permalink', get_permalink($post_id)));
                            ?>
                            <a href="<?php echo $href; ?>">
                                <?php _e('Logout', 'wpbootstrap'); ?>
                            </a>
                        </li>
                    </ul>
                <?php endif; ?>
            <?php endif; ?>
            <?php if($theme_config['show_search']) : ?>
                <form action="#" method="get" class="navbar-search pull-left">
                    <input type="text" placeholder="<?php _e('Search in (hit Enter)', 'wpbootstrap'); ?>" class="search-query span3" required="" name="s">
                </form>
            <?php endif; ?>
		</div>		
	</div>		
</div>