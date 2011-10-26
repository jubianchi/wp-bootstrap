
</div>

<footer class="footer">
	<div class="container">
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
		<br/>
		<div id="foot-col-4" class="row">
			<div class="span16">
				<?php if (is_active_sidebar( 'foot-col-4' ) ) : ?>			
					<?php dynamic_sidebar( 'foot-col-4' ); ?>
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

<?php get_template_part('login', 'modal'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/prettify.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/facebox.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap-modal.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap-alerts.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap-twipsy.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap-popover.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap-dropdown.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap-scrollspy.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap-tabs.js"></script>
<?php if(get_post_format() == 'gallery') : ?>
 <script>
    $(function() {
        var ul = $('<ul class="media-grid"/>');
        $('article .row img').each(function() {
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

        ul.appendTo('article.post .row .span16');
    })
</script>
<?php endif; ?>
<script>
$(function() {
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

	prettyPrint();
})
</script>

</body>