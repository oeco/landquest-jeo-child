<?php query_posts(array(
	'post_type' => 'any',
	'meta_query' => array(
		array(
			'key' => '_jeo_featured',
			'value' => 1
		)
	),
	'posts_per_page' => -1
));

if(have_posts()) :
	?>
	<div class="container">
		<div class="twelve columns">
			<div id="lq-slider">
				<div class="row">
					<h3 class="slider-title"><?php _e('Investigations', 'landquest'); ?>:</h3>
					<ul class="slider-navigation">
						<?php while(have_posts()) : the_post(); ?>
							<li>
								<p><?php the_title(); ?></p>
							</li>
						<?php endwhile; ?>
					</ul>
				</div>
				<div class="slider-content">
					<ul>
						<?php while(have_posts()) : the_post(); ?>
							<li>
								<article>
									<header>
										<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
										<div class="post-meta">
											<?php
											$author = landquest_get_author();
											if($author) :
												?>
												<p class="post-author">
													<span><?php echo get_the_title($author->ID); ?></span>
												</p>
											<?php endif; ?>
										</div>
									</header>
									<section>
										<?php the_excerpt(); ?>
									</section>
									<footer>
										<div class="row">
											<div class="share-container">
												<h4><?php _e('Share', 'landquest'); ?></h4>
												<ul class="share">
													<li class="facebook"><a href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" rel="external" target="_blank"><?php _e('Share on Facebook', 'landquest'); ?></a></li>
													<li class="twitter"><a href="https://www.twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>" rel="external" target="_blank"><?php _e('Tweet about it', 'landquest'); ?></a></li>
													<li class="gplus"><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" rel="external" target="_blank"><?php _e('Share on Google Plus', 'landquest'); ?></a></li>
												</ul>
											</div>
										</div>
									</footer>
								</article>
							</li>
						<?php endwhile; ?>
					</ul>
				</div>
				<p class="slider-arrows">
					<a class="previous" href="#" title="<?php _e('Previous', 'landquest'); ?>"><?php _e('Previous', 'landquest'); ?></a>
					<a class="next" href="#" title="<?php _e('Next', 'landquest'); ?>"><?php _e('Next', 'landquest'); ?></a>
				</p>
			</div>
		</div>
	</div>
	<?php
endif;
wp_reset_query();
?>