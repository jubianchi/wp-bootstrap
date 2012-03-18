<?php
/**
 * @package WordPress
 * @subpackage wp-bootstrap
 * @author jubianchi <contact@jubianchi.fr>
 * @version 2.0
 * @link http://wpbootstrap.jubianchi.fr
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('sticky aside span4'); ?>>
	<header class="page-header">
        <h2>
            <a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'wpbootstrap'), the_title_attribute('echo=0')); ?>" rel="bookmark">
                <?php the_title(); ?>
            </a>
        </h2>
	</header>
	
	<div class="content">
        <?php if(($content = get_the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'wpbootstrap')))) : ?>
            <?php echo $content; ?>
        <?php else : ?>
            <?php the_excerpt(__('Continue reading <span class="meta-nav">&rarr;</span>', 'wpbootstrap')); ?>
        <?php endif; ?>
	</div>

    <hr/>

	<footer>
		<?php if ('post' == $post->post_type) : ?>
			<small><?php echo bootstrap_posted_on(); ?></small>
		<?php endif; ?>
	</footer>
</article>