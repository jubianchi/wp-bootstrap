<?php
/**
 * @package WordPress
 * @subpackage wp-bootstrap
 * @author jubianchi <contact@jubianchi.fr>
 * @version 2.0
 * @link http://wpbootstrap.jubianchi.fr
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('span12 clearfix'); ?>>
    <header class="page-header">
        <?php if(!is_singular()) : ?>
            <h2>
                <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'wpbootstrap'), the_title_attribute('echo=0')); ?>" rel="bookmark">
                    <?php the_title(); ?>
                </a>
                <?php if ('post' == $post->post_type ) : ?>
                    <small><?php echo bootstrap_posted_on(); ?></small>
                <?php endif; ?>

                <?php if(comments_open() || (!comments_open() && get_comments_number() > 0)) : ?>
                    <span class="pull-right label">
                        <a href="<?php the_permalink(); ?>#comments" title="<?php printf(__('%d comment(s)'), get_comments_number()); ?>">
                          <?php echo get_comments_number() ?>
                        </a>
                    </span>
                <?php endif; ?>
            </h2>
        <?php else : ?>
            <h1>
                <?php the_title(); ?>
                <?php if ('post' == $post->post_type ) : ?>
                    <small><?php echo bootstrap_posted_on(); ?></small>
                <?php endif; ?>

                <?php if(comments_open() || (!comments_open() && get_comments_number() > 0)) : ?>
                    <span class="pull-right label">
                        <a href="#comments"><?php echo get_comments_number() ?></a>
                    </span>
                <?php endif; ?>
            </h1>
        <?php endif; ?>
    </header>


    <div class="row-fluid">
        <?php if (is_singular()) : ?>
            <?php the_content( __('Continue reading <span class="meta-nav">&rarr;</span>', 'wpbootstrap')); ?>

            <?php bootstrap_post_nav('post-nav', 'menu'); ?>
        <?php else : ?>
            <?php the_excerpt( __('Continue reading <span class="meta-nav">&rarr;</span>', 'wpbootstrap')); ?>
        <?php endif; ?>
    </div>

    <hr/>

	<footer>		
		<?php echo bootstrap_posted_in(); ?>
	</footer>
</article>