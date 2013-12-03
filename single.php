<?php get_header(); ?>

<?php if(have_posts()) : the_post(); ?>

	<?php jeo_map(); ?>

	<article id="content" class="single-post">
		<header id="post-header" class="page-header">
			<div class="container">
				<div class="ten columns offset-by-one">
					<h1><?php the_title(); ?></h1>
				</div>
			</div>
		</header>
		<section class="content">
			<div class="container">
				<div class="ten columns offset-by-one">
					<?php if($post->post_excerpt) : ?>
						<section id="post-excerpt">
							<?php the_excerpt(); ?>
						</section>
					<?php endif; ?>
					<?php if(get_post_type() != 'author') :
						$author = landquest_get_author();
						?>
						<aside id="post-meta">
							<?php if($author) : ?>
								<p class="post-author">
									<a href="<?php echo get_permalink($author->ID); ?>"><span><?php _e('by', 'landquest'); ?> <?php echo get_the_title($author->ID); ?></span></a>
								</p>
							<?php endif; ?>
							<p class="post-date">
								<span><?php the_date(); ?></span>
							</p>
						</aside>
					<?php endif; ?>
					<section id="post-content" class="row">
						<?php the_content(); ?>
					</section>
					<section id="post-share" class="row">
						<div class="share-container">
							<h3><?php _e('Share', 'landquest'); ?></h3>
							<ul class="share">
								<li class="facebook"><a href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" rel="external" target="_blank"><?php _e('Share on Facebook', 'landquest'); ?></a></li>
								<li class="twitter"><a href="https://www.twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>" rel="external" target="_blank"><?php _e('Tweet about it', 'landquest'); ?></a></li>
								<li class="gplus"><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" rel="external" target="_blank"><?php _e('Share on Google Plus', 'landquest'); ?></a></li>
							</ul>
						</div>
					</section>
				</div>
			</div>
		</section>
	</article>

	<?php
	if(get_post_type() == 'author') :
		landquest_query_author_posts();
		if(have_posts()) :
			?>
			<section id="author-posts">
				<div class="container">
					<div class="twelve columns">
						<h3><?php _e('Investigations by', 'landquest'); ?> <?php the_title(); ?></h3>
					</div>
				</div>
				<?php get_template_part('loop', 'small'); ?>
			</section>
			<?php
		endif;
		wp_reset_query();
	endif;
	?>

	<?php if(function_exists('related_posts')) related_posts(); ?>

<?php endif; ?>

<?php get_footer(); ?>