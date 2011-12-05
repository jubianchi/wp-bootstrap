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

					<?php if (is_active_sidebar( 'foot-col-2' ) ) : ?>
						<div id="foot-col-2" class="span-one-third">
							<?php dynamic_sidebar( 'foot-col-2' ); ?>
						</div>
					<?php endif; ?>

					<?php if (is_active_sidebar( 'foot-col-3' ) ) : ?>
						<div id="foot-col-3" class="span-one-third">
							<?php dynamic_sidebar( 'foot-col-3' ); ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<div class="row">
				<?php if (is_active_sidebar( 'foot-row-2' ) ) : ?>			
					<?php dynamic_sidebar( 'foot-row-2' ); ?>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/lab.js"></script>
<script type="text/javascript" async>
	<?php include(get_template_directory() . '/js/bootstrap-dropdown.js'); ?>
</script>

<script type="text/javascript" async>	
	$(function() {
		$LAB.setGlobalDefaults({
			BasePath: '<?php echo get_template_directory_uri(); ?>/js/'
		});

		$LAB.script("bootstrap-twipsy.js")
		    .script("bootstrap-scrollspy.js")
		    .script("bootstrap-alerts.js")
		    .script("bootstrap-modal.js")
		    .script("bootstrap-popover.js")
		    .script("bootstrap-tabs.js")
		    .script("dotdotdot.js")
		    .script("facebox.js")
		    .script("prettify.js")
			.wait(function() {
				prettyPrint();

				$('.ellipsis').dotdotdot();	
				$('article.aside div.content').css('height', '200px').dotdotdot({
					after: "a.more-link"
				});
				$('article header h2').css('height', '40px').dotdotdot({
					watch: "window",
					after: ".label"
				});
				
				<?php if(get_post_format() == 'gallery') : ?>
					var ul = $('<ul class="media-grid"/>');
					$('article img').each(function() {
						var a = $(this).parent(),
							li = $('<li/>').appendTo(ul),
							nxt = a.next(),
							p = a.parent('p'),
							img = $('img:first', a),
							str = nxt.text();

						nxt.parent('.wp-caption').remove();
						if(nxt.hasClass('wp-caption-text')) {
							a.attr('data-content', str)
							 .attr('data-original-title', img.attr('alt'))
							 .attr('data-controls-modal', 'modal')
							 .attr('rel', 'popover')
							 .popover({placement: 'below'})
							 .facebox({
								loadingImage : '<?php echo get_template_directory_uri(); ?>/img/loading.gif',
								closeImage   : '<?php echo get_template_directory_uri(); ?>/img/closelabel.png'
							 });

						}
						a.appendTo(li);
						p.remove();
					});

					ul.appendTo('article.gallery .content');
				<?php endif; ?>

				<?php if(isset($_GET['replytocom'])) : ?>
					var form = $('#commentform').parent().parent(),
						target = $('#comment-<?php echo (int)$_GET['replytocom']; ?>').parent();

					if(form && target) {
						form.appendTo(target);
					}		
				<?php endif; ?>

				$('[type=submit], [type=button], [type=reset], button').addClass('btn');
				$('[type=submit]').addClass('primary');
				$('[type=button], [type=reset], button').addClass('default');

				$('.topbar ul.sub-menu').each(function() {
					var e = $(this),
						p = $(this).parent('li');

					e.addClass('dropdown-menu');
					p.addClass('dropdown')
					 .attr('data-dropdown', 'dropdown');
					$('a:first', p).addClass('dropdown-toggle');
				});
			});		
	});
</script>
</body>