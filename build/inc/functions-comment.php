<?php
if(!function_exists('bootstrap_comments')) :
	function bootstrap_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		
		switch($comment->comment_type) :
			case '' :
				?>
				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
					<article id="comment-<?php comment_ID(); ?>" class="alert-message block-message default comment">
						<div class="row">
							<div class="pull-left span1">
								<?php echo get_avatar($comment, 40); ?>					
							</div>			
							<div class="pull-right span14">
								<div class="comment-meta commentmetadata">
									<p>
										<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
											<time datetime="<?php comment_time('c'); ?>">
												<?php 
												printf( 
													__('On %s at %s', 'wpbootstrap'), 
													get_comment_date(),  
													get_comment_time() 
												);
												?>
											</time>
										</a>,
										<?php 
										printf(
											__('%s <span class="says">says:</span>', 'wpbootstrap'), 
											sprintf(
												'<cite class="fn">%s</cite>', 
												get_comment_author_link() 
											) 
										); 
										?>
									</p>
									
									<?php if($comment->comment_approved == '0') : ?>
										<p class="alert-message notice">
											<?php _e('Your comment is awaiting moderation.', 'wpbootstrap'); ?>
										</p>
									<?php endif; ?>
								</div><!-- eo .comment-meta .commentmetadata -->

								<div class="comment-content"><?php comment_text(); ?></div>

								<?php if ( $comment->comment_approved != '0' ) : ?>
									<div class="reply">
										<?php 
										comment_reply_link(array_merge(
											$args, 
											array(
												'depth' => $depth, 
												'max_depth' => $args['max_depth']
											)
										)); 
										?>
										<?php edit_comment_link(__('Edit', 'wpbootstrap')); ?>
									</div><!-- eo .reply -->
								<?php endif; ?>
						</div>			
					</article><!-- eo #comment-##  -->
				</li>
				<?php
				break;
			case 'pingback'  :
			case 'trackback' :
				?>
				<li class="post pingback">
					<p><?php _e('Pingback:', 'wpbootstrap'); ?> <?php comment_author_link(); ?></p>
				</li>
				<?php
				break;
		endswitch;
	}
endif;

add_filter('comment_reply_link', 'bootstrap_comment_reply_link');
function bootstrap_comment_reply_link($link) {
	global $user_ID;	

	$comment = get_comment($comment);
	$post = get_post($comment->comment_post_ID);
	if(!comments_open($post->ID)) return false;

	$link = '';
	if (get_option('comment_registration') && !$user_ID) {
		$link = '<a rel="nofollow" class="btn small default comment-reply-login" href="' . esc_url( wp_login_url( get_permalink() ) ) . '">' . $login_text . '</a>';
	} else {
		$link = "<a class='btn small default comment-reply-link' href='" . esc_url( add_query_arg( 'replytocom', $comment->comment_ID ) ) . "#respond'>" . __('Reply', 'wpbootstrap') . "</a>";
	}
	
	return $link;
}

add_filter('edit_comment_link', 'bootstrap_comment_edit_link');
function bootstrap_comment_edit_link($link) {
	global $user_ID;	
	
	$comment = get_comment($comment);
	if (empty($post)) $post = $comment->comment_post_ID;
	
	$post = get_post($post);
	if (!comments_open($post->ID)) return false;

	$link = '';
		
	$link = '<a class="btn small default comment-reply-link" href="' . esc_url( add_query_arg(array('c'=>$comment->comment_ID,  'action'=>'editcomment'), '/wp-admin/comment.php')) . '">' . __( 'Edit', 'wpbootstrap' ) . '</a>';
	
	return $link;
}


add_filter('comment_form_field_comment', 'bootstrap_comment_form_field_comment');
function bootstrap_comment_form_field_comment($args) {
	return '<div class="clearfix">
            <label for="textarea">' .  __( 'Comment', 'wpbootstrap' ) . ' <span class="required">*</span></label>
            <div class="input">
              <textarea rows="3" name="comment" id="comment" class="xxlarge" aria-required="true"></textarea>
            </div>
          </div>';
}

add_filter('comment_form_field_submit', 'bootstrap_comment_form_field_submit');
function bootstrap_comment_form_field_submit($args) {
	return '<div class="clearfix">
            <label for="textarea">' .  __( 'Comment', 'wpbootstrap' ) . ' <span class="required">*</span></label>
            <div class="input">
              <textarea rows="3" name="comment" id="comment" class="xxlarge" aria-required="true"></textarea>
            </div>
          </div>';
}

/*
 * Customise the comments fields with HTML5 form elements
 */
add_filter('comment_form_defaults', 'bootstrap_respond');
if (!function_exists( 'bootstrap_respond')) :
	function bootstrap_respond($post_id = null) {
		global $user_identity, $id;

		if (null === $post_id) {
			$post_id = $id;
		} else {
			$id = $post_id;
		}

		$commenter = wp_get_current_commenter();

		$req = get_option('require_name_email');
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$fields = array( 
			'open_tag' => '<fieldset>',
			'author' => '<div class="clearfix comment-form-author">' . 
						'<label for="author">' . __( 'Name', 'wpbootstrap' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
						'<div class="input">' .
						'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" class="xlarge"' . $aria_req . ' placeholder = "' . __( 'What can we call you?', 'wpbootstrap' ) . '"' . ( $req ? ' required' : '' ) . ' />' .
						'</div></div>',
			'email'  => '<div class="clearfix comment-form-email">' . 
						'<label for="email">' . __( 'Email', 'wpbootstrap' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' . 
						'<div class="input">' .
						'<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" class="xlarge"' . $aria_req . ' placeholder="' . __( 'How can we reach you?', 'wpbootstrap' ) . '"' . ( $req ? ' required' : '' ) . ' />' . 
						'</div></div>',
			'url'    => '<div class=" clearfixcomment-form-url">' .
						'<label for="url">' . __( 'Website', 'wpbootstrap' ) . '</label>' .
						'<div class="input">' .
						'<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" class="xlarge" placeholder="' . __('Have you got a website?', 'wpbootstrap') .'" />' .
						'</div></div>',
			'close_tag' => '</fieldset>'
		);

		$required_text = sprintf( ' ' . __('Required fields are marked %s'), '<span class="required">*</span>' );

		$defaults = array(
			'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
			'comment_field'        => '<div class="comment-form-comment"><p><label for="comment">' . _x( 'Comment', 'noun', 'wpbootstrap' ) . '</label></p><p><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p></div>',
			'must_log_in'          => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.','wpbootstrap' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
			'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'wpbootstrap' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
			'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.', 'wpbootstrap' ) . ( $req ? $required_text : '' ) . '</p>',
			'comment_notes_after'  => '<p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'wpbootstrap' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
			'id_form'              => 'commentform',
			'id_submit'            => 'submit',
			'title_reply'          => __( 'Leave a Reply', 'wpbootstrap'),
			'title_reply_to'       => __( 'Leave a Reply to %s', 'wpbootstrap'),
			'cancel_reply_link'    => __( 'Cancel reply', 'wpbootstrap'),
			'label_submit'         => __( 'Post Comment', 'wpbootstrap'),
		);

		return $defaults;
	}
endif;
?>