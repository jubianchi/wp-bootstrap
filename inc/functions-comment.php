<?php
if(!function_exists('bootstrap_comments')) {
	function bootstrap_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		
		switch($comment->comment_type) {
			case '' :
				include get_template_directory() . '/comment.php';
				break;
			case 'pingback'  :
			case 'trackback' :
				include get_template_directory() . '/comment-pingback.php';
				break;
        }
	}
}

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
              <textarea name="comment" id="comment" class="xxlarge" placeholder="' . __( 'Write your response here...', 'wpbootstrap' ) . '"></textarea>
            </div>
          </div>';
}

/*
 * Customise the comments fields with HTML5 form elements
 */
add_filter('comment_form_defaults', 'bootstrap_respond');
if (!function_exists( 'bootstrap_respond')) {
	function bootstrap_respond($post_id = null) {
		global $user_identity, $id;

        $post_id   = $post_id ? $post_id : $id;
		$commenter = wp_get_current_commenter();
		$required  = get_option('require_name_email');

        $requiredMarker = $required ? ' <span class="required">*</span>' : '';
        $requiredAttr   = $required ? ' required' : '';
        
		$fields = array( 
			'open_tag' => '<fieldset>',
			'author' => '<div class="clearfix comment-form-author">' . 
						'<label for="author">' . __('Name', 'wpbootstrap') . $requiredMarker . '</label> ' .
						'<div class="input">' .
						'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" class="xlarge" placeholder = "' . __( 'What can we call you?', 'wpbootstrap' ) . '"' . $requiredAttr . ' />' .
						'</div></div>',
			'email'  => '<div class="clearfix comment-form-email">' . 
						'<label for="email">' . __( 'Email', 'wpbootstrap' ) . $requiredMarker . '</label> ' .
						'<div class="input">' .
						'<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" class="xlarge" placeholder="' . __( 'How can we reach you?', 'wpbootstrap' ) . '"' . $requiredAttr . ' />' .
						'</div></div>',
			'url'    => '<div class=" clearfixcomment-form-url">' .
						'<label for="url">' . __( 'Website', 'wpbootstrap' ) . '</label>' .
						'<div class="input">' .
						'<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" class="xxlarge" placeholder="' . __('Have you got a website?', 'wpbootstrap') .'" />' .
						'</div></div>',
			'close_tag' => '</fieldset>'
		);

		$defaults = array(
			'fields'      => apply_filters('comment_form_default_fields', $fields),
			'must_log_in' => sprintf(
                '<p class="must-log-in">%s</p>',
                sprintf(
                    __('You must be <a href="%s">logged in</a> to post a comment.', 'wpbootstrap'),
                    wp_login_url(apply_filters('the_permalink', get_permalink($post_id)))
                )
            ),
			'logged_in_as' => sprintf(
                '<p class="logged-in-as">%s</p>',
                sprintf(
                    __('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'wpbootstrap'),
                    admin_url( 'profile.php' ),
                    $user_identity,
                    wp_logout_url(apply_filters('the_permalink', get_permalink($post_id))))
            ),
			'comment_notes_before' => sprintf(
                '<p class="comment-notes">%s%s</p>',
                __('Your email address will not be published.', 'wpbootstrap'),
                (
                    $required
                    ? sprintf(
                        '<br/>' . __('Required fields are marked %s'),
                        '<span class="required">*</span>'
                    )
                    : ''
                )
            ),
			'comment_notes_after' => sprintf(
                '<p class="form-allowed-tags">%s</p>',
                sprintf(
                    __('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'wpbootstrap'),
                    sprintf('<code>%s</code>', allowed_tags())
                )
            ),
			'id_form'              => 'commentform',
			'id_submit'            => 'submit',
			'title_reply'          => __('Leave a Reply', 'wpbootstrap'),
			'title_reply_to'       => __('Leave a Reply to %s', 'wpbootstrap'),
			'cancel_reply_link'    => __('Cancel reply', 'wpbootstrap'),
			'label_submit'         => __('Post Comment', 'wpbootstrap'),
		);

		return $defaults;
	}
}
?>