<?php
/*
@package WordPress
@subpackage wp-bootstrap
@author jubianchi <contact@jubianchi.fr>
@version 0.1
*/
?>
<?php get_header(); ?>
<?php global $theme_config; ?>

<?php if($theme_config['sticky_enabled'] && (is_home() || is_front_page())) : ?>
	<section class="row">
		<?php 
		$args = array(
			'tax_query' => array(
				array(
					'taxonomy'  => 'post_format',
					'field'     => 'slug',
					'terms'     => $theme_config['sticky_formats'],
					'operator'  => 'IN'
				)
			),
			'showposts' => 3 * $theme_config['sticky_rows']
		);
		$query = new WP_Query($args);
		?>
		<?php if( $query -> have_posts() ) : ?>
			<?php while ( $query -> have_posts() ) : $query -> the_post(); ?>
				<?php get_template_part('content', 'aside'); ?>
			<?php endwhile; ?>
		<?php endif; ?>

		<?php               
		$args = array(
			'tax_query' => array(
				array(
					'taxonomy'  => 'post_format',
					'field'     => 'slug',
					'terms'     => $theme_config['sticky_formats'],
					'operator'  => 'NOT IN'
				)
			)
		);
		query_posts(array_merge($wp_query -> query, $args));
		?>
	</section>
<?php endif; ?>


<section class="row">
	<?php if (is_author() || is_search() || is_date()) : ?>
		<header class="span16">
            <?php $section = bootstrap_section_heading(); ?>
            <?php if (is_author()) : ?>
                <hgroup>
                    <h1 class="section-title"><?php echo $section['section_title']; ?></h1>
                </hgroup>
            <?php else : ?>
                <hgroup>
                    <h1 class="section-title"><?php echo $section['section_title']; ?> <small><?php echo $section['section_description']; ?></small></h1>
                </hgroup>
            <?php endif; ?>
		</header>
	<?php endif; ?>
	
	<?php while ( have_posts() ) : the_post(); ?>
		<?php if(is_singular()) : ?>
            <?php switch(get_post_format()) {
                case 'gallery':
                    get_template_part('content', get_post_format());
                    break;
                default:
                    get_template_part('content');
                    break;
            } ?>
        <?php else : ?>
            <?php get_template_part('content'); ?>
        <?php endif; ?>
	<?php endwhile; ?>	
		
	<?php bootstrap_content_nav( 'nav-below', 'menu' ); ?>
</section>
			
<?php if(is_singular()) : ?>
	<section>
		<?php comments_template(); ?>
	</section>
<?php endif; ?>

<?php get_footer(); ?>