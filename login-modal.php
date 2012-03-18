<?php
/**
 * @package WordPress
 * @subpackage wp-bootstrap
 * @author jubianchi <contact@jubianchi.fr>
 * @version 2.0
 * @link http://wpbootstrap.jubianchi.fr
 */
?>
<?php if(!is_user_logged_in()) : ?>
	<div id="modal-login" class="modal hide fade">
		<form class="form-stacked" action="<?php echo wp_login_url(get_permalink()); ?>" method="post" style="margin: 0px">
			<div class="modal-header">
				<a class="close" href="#">×</a>
				<h3><?php _e('Login', 'wpbootstrap'); ?></h3>
			</div>
			<div class="modal-body">
				<div class="clearfix">
					<label for="username"><?php _e('Username', 'wpbootstrap'); ?></label>
					<div class="input">
						<input type="text" size="50" name="log" id="username" class="xxlarge">
					</div>
				</div>
				<div class="clearfix">
					<label for="password"><?php _e('Password', 'wpbootstrap'); ?></label>
					<div class="input">
						<input type="password" size="50" name="pwd" id="password" class="xxlarge">						
					</div>
				</div>
				<div class="clearfix">									
					<label for="rememberme">
                        <input type="checkbox" name="rememberme" id="rememberme" value="forever">
                        <?php _e('Remember me', 'wpbootstrap'); ?>
                    </label>
				</div>
			</div>
			<div class="modal-footer">
				<?php if(get_option('users_can_register') == 1): ?>
					<a href="/wp-login.php?action=register" class="pull-left" style="padding: 6px 15px 7px" onclick="$('#modal-login').modal('hide')">
						<?php _e('Register', 'wpbootstrap'); ?>
					</a> 
				<?php endif; ?>			           		
				<a href="#" class="pull-right" style="font-size: 13px; padding: 6px 15px 7px" onclick="$('#modal-login').modal('hide'); return false">
					<?php _e('Cancel', 'wpbootstrap'); ?>
				</a>    
				<input type="submit" class="btn primary" onclick="$('#modal-login').modal('hide');" value="<?php _e('Sign in', 'wpbootstrap'); ?>"/>
			</div>
		</form>
	</div>
<?php endif; ?>