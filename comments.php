<?php
/**
 * @package WordPress
 * @subpackage wp-bootstrap
 * @author jubianchi <contact@jubianchi.fr>
 * @version 2.0
 * @link http://wpbootstrap.jubianchi.fr
 */
?>
<div id="comments">
	<?php if(post_password_required()) : ?>
		<div class="alert alert-error">
            <?php _e('This post is password protected. Enter the password to view any comments.', 'wpbootstrap'); ?>
        </div>
	<?php else : ?>
		<?php if(($comments_open = comments_open())) : ?>
			<header class="page-header">
				<h2 class="section-description">
					<?php _e('Write a comment.', 'wpbootstrap'); ?>
					<small>
						<?php comments_popup_link(
							__('No response yet to', 'wpbootstrap'),
							__('1 response to', 'wpbootstrap'),
							__('% responses to', 'wpbootstrap'),
							'comments-link',
							__('Comments are off for', 'wpbootstrap')
						); ?>
						<em><?php echo get_the_title(); ?></em>
					</small>
				</h2>
			</header>
		<? else : ?>
			<?php if(!is_page()) : ?>
				<div class="alert alert-notice">
					<?php _e('Comments are closed for this post', 'wpbootstrap'); ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>

		<?php if(have_comments()) : ?>
			<ol class="commentlist">
				<?php wp_list_comments(array('callback' => 'bootstrap_comments')); ?>
			</ol>

			<?php if(get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
				<?php
					$prev_link = get_previous_comments_link(__('&larr; Older Comments', 'wpbootstrap'));
					if($prev_link == '') {
						$prev_class = 'class="disabled"';
						$prev_link = '<a href="#" onclick="return false;">' . __('&larr; Older Comments', 'wpbootstrap') . '</a>';
					}

					$next_link = get_next_comments_link(__('Newer Comments &rarr;', 'wpbootstrap'));
					if($next_link == '') {
						$next_class = 'class="disabled"';
						$next_link = '<a href="#" onclick="return false;">' . __('Newer Comments &rarr;', 'wpbootstrap') . '</a>';
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

		<?php if ($comments_open) : ?>
			<div class="well">
				<?php
				comment_form(array(
					'cancel_reply_link' => __('Cancel reply', 'wpbootstrap')
				)); ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>
</div><!-- eo #comments -->