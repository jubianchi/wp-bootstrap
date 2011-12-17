<article id="post-<?php the_ID(); ?>" <?php post_class('span16 clearfix'); ?>>
	<?php if(!is_page()) : ?>
        <header class="page-header">
            <?php if(!is_singular()) : ?>
                <h2>
                    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'wpbootstrap' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
                        <?php the_title(); ?>
                    </a>
                    <?php if ( 'post' == $post->post_type ) : ?>
                        <small><?php echo bootstrap_posted_on(); ?></small>
                    <?php endif; ?>

                    <?php if(comments_open() || (!comments_open() && get_comments_number() > 0)) : ?>
                        <span class="pull-right label" style="font-size: 1em; height: 1.3em;">
                            <a href="<?php the_permalink(); ?>#comments" title="<?php printf(__('%d comment(s)'), get_comments_number()); ?>">
                              <?php echo get_comments_number() ?>
                            </a>
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

    <?php if (is_singular()) : ?>
        <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'wpbootstrap') ); ?>
        <?php wp_link_pages(array( 'before' => '<div class="page-link">' . __('Pages:', 'wpbootstrap' ), 'after' => '</div>') ); ?>
    <?php else : ?>
        <?php the_excerpt( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'wpbootstrap' ) ); ?>
    <?php endif; ?>

	<footer>
		<?php echo bootstrap_posted_in(); ?>
	</footer>
</article>