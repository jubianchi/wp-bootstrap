<?php if(!is_user_logged_in) : ?>
	<div id="modal-login" class="modal hide fade">
		<form class="form-stacked" style="margin: 0px">
			<div class="modal-header">
				<a class="close" href="#">×</a>
				<h3><?php echo __('Login', 'bootstrap'); ?></h3>
			</div>
			<div class="modal-body">
				<div class="clearfix">
					<label for="username"><?php echo __('Username', 'bootstrap'); ?></label>
					<div class="input">
						<input type="text" size="30" name="username" id="username" class="xlarge">
					</div>
				</div>
				<div class="clearfix">
					<label for="password"><?php echo __('Password', 'bootstrap'); ?></label>
					<div class="input">
						<input type="text" size="30" name="password" id="password" class="xlarge">
					</div>
				</div>
				<div class="clearfix">
					<label>
						<input type="checkbox" name="optionsCheckboxes" value="option1">
						<span><?php _e('Remember me', 'bootstrap'); ?></span>
					</label>
				</div>
			</div>
			<div class="modal-footer">
				<?php if(get_option('users_can_register') == 1): ?>
					<a href="/wp-login.php?action=register" class="pull-left" style="padding: 6px 15px 7px" onclick="$('#modal-login').modal('hide')">
						<?php echo __('Register', 'bootstrap'); ?>
					</a> 
				<?php endif; ?>			           		
				<a href="#" class="pull-right" style="font-size: 13px; padding: 6px 15px 7px" onclick="$('#modal-login').modal('hide'); return false"><?php echo __('Cancel', 'bootstrap'); ?></a>    
				<a class="btn primary" href="#" onclick="$('#modal-login').modal('hide'); return false;"><?php echo __('Sign in', 'bootstrap'); ?></a>			
			</div>
		</form>
	</div>
<?php endif; ?>