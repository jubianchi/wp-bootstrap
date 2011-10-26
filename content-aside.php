<article id="post-<?php the_ID(); ?>" class="aside span-one-third">
	<header class="page-header">		
		<?php if(!is_singular()) : ?>
			<h2>
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'basics' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
					<?php the_title(); ?>
				</a>											
			</h2>
		<?php else : ?>
			<h1>
				<?php the_title(); ?>
				<?php if ( 'post' == $post->post_type ) : ?>     
					<small><?php echo bootstrap_posted_on(); ?></small>
				<?php endif; ?>
					
				<?php if(comments_open() || (!comments_open() && get_comments_number() > 0)) : ?>
					<span class="pull-right label" style="font-size: 1em;">
						<a href="#comments"><?php echo get_comments_number() ?></a>
					</span>
				<?php endif; ?>
			</h1>
		<?php endif; ?>
	</header>
	
	<div class="row" style="height: 200px;">
		<div class="span-one-third">
			<?php if (is_singular()) : ?>
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'bootstrap') ); ?>				
			<?php else : ?>
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'bootstrap' ) ); ?>
			<?php endif; ?>
		</div>
	</div>

	<footer>
		<?php if ( 'post' == $post->post_type ) : ?>     
			<small><?php echo bootstrap_posted_on(); ?></small>
		<?php endif; ?>
	</footer>
</article>