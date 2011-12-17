<?php global $theme_config; ?>

<div class="topbar">
	<div class="fill">
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
				<li class="<?php if($menu) : ?>dropdown<?php endif; ?>" data-dropdown="dropdown">										
					<a class="brand<?php if($menu) : ?> dropdown-toggle<?php endif; ?>" href="<?php echo home_url('/'); ?>">
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
                    <ul class="nav secondary-nav">
                        <li>
                            <?php
                            $href = wp_login_url(apply_filters('the_permalink', get_permalink($post_id)));
                            ?>
                            <a href="<?php echo $href; ?>" data-controls-modal="modal-login" data-backdrop="static">
                                <?php _e('Login', 'wpbootstrap'); ?>
                            </a>
                        </li>
                    </ul>
                <?php else : ?>
                    <?php
                    global $current_user;
                    $user_identity = get_currentuserinfo();
                    ?>
                    <ul class="nav secondary-nav">
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
                <form class="search pull-right" action="<?php echo home_url('/'); ?>" method="get" role="search">
                    <input type="text" name="s" placeholder="<?php _e('Search in (hit Enter)', 'wpbootstrap'); ?>" required>
                </form>
            <?php endif; ?>
		</div>		
	</div>		
</div>