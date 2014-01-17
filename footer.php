<footer id="colophon">
	<div class="container">
		<div class="row">
			<?php /*
			<div class="six columns">
				<h3><?php _e('Contact us', 'landquest'); ?></h3>
				<?php echo do_shortcode('[landquest-contact]'); ?>
			</div>
			*/ ?>
			<div class="six columns">
				<?php
				$creators = array();
				$partners = get_posts(array('post_type' => 'partner', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'menu_order'));
				if($partners) :
					?>
					<h3><?php _e('A collaboration between', 'landquest'); ?></h3>
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
			</div>
			<div class="six columns">
				<?php if(!empty($creators)) : ?>
					<h3><?php _e('Built with support from', 'landquest'); ?></h3>
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
		<div class="twelve columns row">
			<p class="credits">
				<?php _e('developed using', 'landquest'); ?> <a href="http://lab.oeco.org.br/projects/jeo/" target="_blank">JEO</a>, <?php _e('design by', 'landquest'); ?> <a href="http://cardume.art.br/" title="Cardume" class="cardume">Cardume</a> <?php _e('and some icons by', 'landquest'); ?> <a href="http://entypo.com/" title="Entypo">Entypo</a>
			</p>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>