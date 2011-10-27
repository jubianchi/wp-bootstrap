<?php if(!is_user_logged_in()) : ?>
	<div id="modal-login" class="modal hide fade">
		<form class="form-stacked" action="<?php echo wp_login_url( get_permalink() ); ?>" method="post" style="margin: 0px">
			<div class="modal-header">
				<a class="close" href="#">×</a>
				<h3><?php echo __('Login', 'wpbootstrap'); ?></h3>
			</div>
			<div class="modal-body">
				<div class="clearfix">
					<label for="username"><?php echo __('Username', 'wpbootstrap'); ?></label>
					<div class="input">
						<input type="text" size="50" name="log" id="username" class="xlarge">
					</div>
				</div>
				<div class="clearfix">
					<label for="password"><?php echo __('Password', 'wpbootstrap'); ?></label>
					<div class="input">
						<input type="password" size="50" name="pwd" id="password" class="xlarge">
					</div>
				</div>
				<div class="clearfix">
					<label>
						<input type="checkbox" name="rememberme" value="forever">
						<span><?php _e('Remember me', 'wpbootstrap'); ?></span>
					</label>
				</div>
			</div>
			<div class="modal-footer">
				<?php if(get_option('users_can_register') == 1): ?>
					<a href="/wp-login.php?action=register" class="pull-left" style="padding: 6px 15px 7px" onclick="$('#modal-login').modal('hide')">
						<?php echo __('Register', 'wpbootstrap'); ?>
					</a> 
				<?php endif; ?>			           		
				<a href="#" class="pull-right" style="font-size: 13px; padding: 6px 15px 7px" onclick="$('#modal-login').modal('hide'); return false">
					<?php echo __('Cancel', 'wpbootstrap'); ?>				
				</a>    
				<input type="submit" class="btn primary" onclick="$('#modal-login').modal('hide');" value="<?php echo __('Sign in', 'wpbootstrap'); ?>"/>
			</div>
		</form>
	</div>
<?php endif; ?>