<?php get_header(); ?>

<?php if(have_posts()) : the_post(); ?>

	<?php jeo_map(); ?>

	<article id="content" class="single-post">
		<header id="post-header" class="page-header">
			<div class="container">
				<div class="seven columns offset-by-one">
					<h1><?php the_title(); ?></h1>
					<?php
					$source = get_the_terms($post->ID, 'source');
					if($source) :
						$source = array_shift($source);
						$source_url = get_field('url', 'source_' . $source->term_id);
						?>
						<p class="source">Source: <a href="<?php echo $source_url; ?>" target="_blank" rel="external"><?php echo $source->name; ?></a></p>
					<?php endif; ?>
					<?php
					$license = get_the_terms($post->ID, 'license');
					if($license) :
						$license = array_shift($license);
						$license_url = get_field('url', 'license_' . $license->term_id);
						?>
						<p class="license">License: <a href="<?php echo $license_url; ?>" target="_blank" rel="external"><?php echo $license->name; ?></a></p>
					<?php endif; ?>
				</div>
				<div class="three columns">
					<?php
					$url = get_field('full_download') ? get_field('full_download') : get_field('source_url');
					if($url) :
						?>
						<p class="download-button">
							<a href="<?php echo $url; ?>" title="<?php _e('Download data', 'landquest'); ?>" rel="external" target="_blank"><?php _e('Download data', 'landquest'); ?></a>
						</p>
					<?php endif; ?>
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

<?php endif; ?>

<?php get_footer(); ?>