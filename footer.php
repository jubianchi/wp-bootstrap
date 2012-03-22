<?php
/**
 * @package WordPress
 * @subpackage wp-bootstrap
 * @author jubianchi <contact@jubianchi.fr>
 * @version 2.0
 * @link http://wpbootstrap.jubianchi.fr
 */
?>
<?php global $theme_config; ?>
</div>

<footer class="footer">
	<div class="container">
			<?php if(is_active_sidebar('foot-col-1') || is_active_sidebar('foot-col-2') || is_active_sidebar('foot-col-3')) : ?>
				<div class="row-fluid">
					<?php if (is_active_sidebar('foot-col-1')) : ?>
						<div id="foot-col-1" class="span4">
							<?php dynamic_sidebar('foot-col-1'); ?>
						</div>
					<?php endif; ?>

					<?php if (is_active_sidebar('foot-col-2')) : ?>
						<div id="foot-col-2" class="span4">
							<?php dynamic_sidebar('foot-col-2'); ?>
						</div>
					<?php endif; ?>

					<?php if (is_active_sidebar('foot-col-3')) : ?>
						<div id="foot-col-3" class="span4">
							<?php dynamic_sidebar('foot-col-3'); ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<div class="row-fluid">
				<?php if (is_active_sidebar('foot-row-2')) : ?>
					<?php dynamic_sidebar('foot-row-2'); ?>
				<?php else : ?>
					<p>
						Built with <a href="http://www.wordpress.org">Wordpress</a> and <a href="http://twitter.github.com/jubianchi/wp-bootstrap/">wp-bootstrap</a> theme from <a href="http://www.twitter.com/jubianchi">@jubianchi</a>
					</p>
				<?php endif; ?>
			</div>

	</div>
</footer>
    
<?php wp_footer(); ?>

<?php if($theme_config[SHOW_LOGIN_KEY]) : ?>
    <?php get_template_part('login', 'modal'); ?>
<?php endif; ?>
</body>
</html>