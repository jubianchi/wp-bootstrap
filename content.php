<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if(!is_page()) : ?>
        <header class="page-header">
            <?php if(!is_singular()) : ?>
                <h2>
                    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'basics' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
                        <?php the_title(); ?>
                    </a>
                    <?php if ( 'post' == $post->post_type ) : ?>
                        <small><?php echo bootstrap_posted_on(); ?></small>
                    <?php endif; ?>

                    <?php if(comments_open() || (!comments_open() && get_comments_number() > 0)) : ?>
                        <span class="pull-right label" style="font-size: 1em; height: 1.3em;">
                            <?php echo get_comments_number() ?>
                        </span>
                    <?php endif; ?>
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
	<?php endif; ?>
    
	<div class="row">
		<div class="span16">
			<?php if (is_singular()) : ?>			
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'bootstrap') ); ?>
				<?php wp_link_pages(array( 'before' => '<div class="page-link">' . __('Pages:', 'bootstrap' ), 'after' => '</div>') ); ?>
			<?php else : ?>
				<?php the_excerpt( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'bootstrap' ) ); ?>			
			<?php endif; ?>		
		</div>
	</div>
	<br style="clear: both"/>
	<footer>		
		<?php echo bootstrap_posted_in(); ?>
	</footer>
</article>