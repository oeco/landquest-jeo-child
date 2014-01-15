<?php if(have_posts()) : ?>
	<section class="posts-section">
		<div class="container">
			<ul class="posts-list">
				<?php while(have_posts()) : the_post(); ?>
					<li id="post-<?php the_ID(); ?>" <?php post_class('four columns'); ?>>
						<article id="post-<?php the_ID(); ?>">
							<?php if ( has_post_thumbnail()) : ?>
								<section class="post-thumbnail">
								   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
								   <?php the_post_thumbnail('front-loop', array('class' => 'scale-with-grid')); ?>
								   </a>
								</section>
							<?php endif; ?>
							<header class="post-header">
								<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
								<?php
								$author = landquest_get_author();
								if($author) :
									?>
									<p class="meta">
										<span class="author"><?php echo get_the_title($author->ID); ?></span>
									</p>
								<?php endif; ?>
							</header>
							<section class="post-content">
								<div class="post-excerpt">
									<?php the_excerpt(); ?>
								</div>
							</section>
							<aside class="actions clearfix">
								<a href="<?php the_permalink(); ?>"><?php _e('Read more', 'jeo'); ?></a>
							</aside>
						</article>
					</li>
				<?php endwhile; ?>
			</ul>
		</div>
	</section>
<?php endif; ?>