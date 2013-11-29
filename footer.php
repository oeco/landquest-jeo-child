<footer id="colophon">
	<div class="container">
		<div class="four columns">
			<h3><?php _e('Like us on Facebook', 'landquest'); ?></h3>
			<div class="fb-like-box" data-href="https://www.facebook.com/siteoeco" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
		</div>
		<div class="four columns">
			<h3><?php _e('Contact us', 'landquest'); ?></h3>
			<?php echo do_shortcode('[landquest-contact]'); ?>
		</div>
		<div class="four columns">
			<?php
			$creators = array();
			$partners = get_posts(array('post_type' => 'partner', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'menu_order'));
			if($partners) :
				?>
				<h3><?php _e('Partners', 'landquest'); ?></h3>
				<ul class="partner-list row">
					<?php foreach($partners as $partner) :
						if(get_field('partner_is_creator', $partner->ID)) {
							$creators[] = $partner;
							continue;
						}
						?>
						<li>
							<a href="<?php echo get_permalink($partner->ID); ?>" title="<?php echo get_the_title($partner->ID); ?>"><?php echo get_the_post_thumbnail($partner->ID, 'footer-thumbnail', array('alt' => get_the_title($partner->ID))); ?></a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

			<?php if(!empty($creators)) : ?>
				<h3><?php _e('Project by', 'landquest'); ?></h3>
				<ul class="partner-list row">
					<?php foreach($creators as $creator) : ?>
						<li>
							<a href="<?php echo get_permalink($creator->ID); ?>" title="<?php echo get_the_title($creator->ID); ?>"><?php echo get_the_post_thumbnail($creator->ID, 'footer-thumbnail', array('alt' => get_the_title($creator->ID))); ?></a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>