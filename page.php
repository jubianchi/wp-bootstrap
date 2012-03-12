<?php
/*
@package WordPress
@subpackage wp-bootstrap
@author jubianchi <contact@jubianchi.fr>
@version 0.1
*/
?>
<?php global $theme_config; ?>

<?php get_header(); ?>

<section class="row">
    <article id="page-<?php the_ID(); ?>" <?php post_class('span12 clearfix'); ?>>


        <div class="row-fluid">
            <?php the_content(); ?>
            <?php echo apply_filters('the_content', get_page($post->ID)->post_content); ?>
        </div>

        <hr/>

        <?php bootstrap_post_nav('post-nav', 'menu'); ?>
    </article>
</section>


<section class="row">
    <?php comments_template(); ?>
</section>

<?php get_footer(); ?>