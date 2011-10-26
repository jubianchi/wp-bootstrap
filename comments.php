<div id="comments">
	<?php if ( post_password_required() ) : ?>
		<div class="alert-message block-message error"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'bootstrap' ); ?></div>
	<?php else : ?>
		<?php if(comments_open()) : ?>
			<header class="page-header">
				<hgroup>
					<h2 class="section-description">
						<?php _e( 'Enter the comments area.', 'bootstrap' ); ?>
						<?php if ( have_comments() ) : ?>
							<small>
								<?php comments_popup_link( 
									__( 'No response yet to', 'bootstrap' ), 
									__( '1 response to', 'bootstrap' ), 
									__( '% responses to', 'bootstrap' ), 
									'comments-link', 
									__( 'Comments are off for', 'bootstrap' ) 
								); ?>
								<em><?php echo get_the_title(); ?></em>						
							</small>
						<?php endif; ?>
					</h2>
				</hgroup>
			</header>
		<? endif; ?>

		<?php if(have_comments()) : ?>					
			<ol class="commentlist">
				<?php wp_list_comments( array( 'callback' => 'bootstrap_comments' ) ); ?>
			</ol>
		
			<?php if(get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
				<?php
					$prev_link = get_previous_comments_link(__('&larr; Older Comments', 'bootstrap'));
					if($prev_link == '') {
						$prev_class = 'class="disabled"';
						$prev_link = '<a href="#" onclick="return false;">' . __('&larr; Older Comments', 'bootstrap') . '</a>';
					}
					
					$next_link = get_next_comments_link(__('Newer Comments &rarr;', 'bootstrap'));
					if($next_link == '') {
						$next_class = 'class="disabled"';
						$next_link = '<a href="#" onclick="return false;">' . __('Newer Comments &rarr;', 'bootstrap') . '</a>';
					}
				?>
				<nav class="pagination">
					<ul>
						<li <?php echo $prev_class; ?>><?php echo $prev_link; ?></li>
						<li <?php echo $next_class; ?>><?php echo $next_link; ?></li>
					</ul>
				</nav>
			<?php endif; ?>
		<?php endif; ?>

		<?php if (comments_open()) : ?>			
			<div class="alert-message block-message default"><?php comment_form(array(
                'cancel_reply_link' => '<span class="btn small danger">' . __( 'Cancel reply' ) . '</span>'
            )); ?></div>
		<?php else : ?>
			<div class="alert-message block-message notice"><?php _e( 'Comments are closed for this post', 'bootstrap' ); ?></div>
		<?php endif; ?>
	<?php endif; ?>
</div><!-- eo #comments -->