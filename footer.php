<?php global $theme_config; ?>
</div>

<footer class="footer">
	<div class="container">
		<div class="content">
			<?php if(is_active_sidebar('foot-col-1') || is_active_sidebar('foot-col-2') || is_active_sidebar('foot-col-3')) : ?>
				<div class="row">
					<?php if (is_active_sidebar('foot-col-1')) : ?>
						<div id="foot-col-1" class="span-one-third">
							<?php dynamic_sidebar('foot-col-1'); ?>
						</div>
					<?php endif; ?>

					<?php if (is_active_sidebar('foot-col-2')) : ?>
						<div id="foot-col-2" class="span-one-third">
							<?php dynamic_sidebar('foot-col-2'); ?>
						</div>
					<?php endif; ?>

					<?php if (is_active_sidebar('foot-col-3')) : ?>
						<div id="foot-col-3" class="span-one-third">
							<?php dynamic_sidebar('foot-col-3'); ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<div class="row">
				<?php if (is_active_sidebar('foot-row-2')) : ?>
					<?php dynamic_sidebar('foot-row-2'); ?>
				<?php else : ?>
					<p>
						&copy; <a href="http://www.jubianchi.fr">jubianchi.fr</a> 2011
						<br/>
						Built using <a href="http://twitter.github.com/bootstrap/">Bootstrap, from Twitter</a>
					</p>
				<?php endif; ?>
			</div>
		</div>		
	</div>
</footer>
    
<?php wp_footer(); ?>

<?php if($theme_config['show_login']) : ?>
    <?php get_template_part('login', 'modal'); ?>
<?php endif; ?>
</body>
</html>