<?php
/*
@package WordPress
@subpackage Basics
@author Bruno Bichet <bruno.bichet@gmail.com>
@version 0.2.8
@since Version 0.1.1
@todo Check the markup http://validator.w3.org/
For Those About to Rock. Fire!
*/
?>
<?php get_header(); ?>

<section role="main">
	<?php if (is_author() || is_search() || is_date()) : ?>
		<header>					
			<div class="row">											
				<?php $section = bootstrap_section_heading(); ?>
				<?php if (is_author()) : ?>				
					<hgroup class="pull-right span14">						
						<h1 class="section-title"><?php echo $section['section_title']; ?></h1>
					</hgroup>
				<?php Else : ?>
					<hgroup class="span16">	
						<h1 class="section-title"><?php echo $section['section_title']; ?> <?php echo $section['section_description']; ?></h1>
					</hgroup>
				<?php endif; ?>
			</div>
		</header>
	<?php endif; ?>

	<?php if(is_home() || is_front_page()) : ?>
		<?php 
		$args = array(
			'tax_query' => array(
				array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array('post-format-aside', 'post-format-quote'),
                    'operator' => 'IN'
				)
			),
			'showposts' => 3
		);
		$query = new WP_Query( $args ); 
		?>
		<?php if( $query -> have_posts() ) : ?>
			<div class="row">
				<?php while ( $query -> have_posts() ) : $query -> the_post(); ?>
					<?php get_template_part('content', 'aside'); ?>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
		<br style="clear: both" />
		
		<?php
		$args = array(
			'tax_query' => array(
				array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array('post-format-aside', 'post-format-quote'),
					'operator' => 'NOT IN'
				)
			)
		);
        $args = array_merge($wp_query -> query, $args);
        query_posts($args);
		?>
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
	<section role="complementary">
		<?php comments_template(); ?>
	</section>
<?php endif; ?>

		
<?php get_footer(); ?>