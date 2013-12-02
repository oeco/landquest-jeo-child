<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<title><?php
	global $page, $paged;

	wp_title( '|', true, 'right' );

	bloginfo( 'name' );

	$site_description = get_bloginfo('description', 'display');
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	if ( $paged >= 2 || $page >= 2 )
		echo ' | Página ' . max($paged, $page);

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/img/favicon.ico" type="image/x-icon" />
<?php wp_head(); ?>
</head>
<body <?php body_class(get_bloginfo('language')); ?>>
	<header id="masthead">
		<div class="gradient"></div>
		<div class="container">
			<div class="four columns">
				<div id="masthead-nav">
					<nav>
						<ul>
							<li>
                                <a href="<?php echo landquest_home_url('/about/'); ?>" title="<?php _e('About', 'landquest'); ?>">
                                    <span class='lsf'>&#xE051;</span>
                                    <?php _e('about', 'landquest'); ?>
                                </a>
							</li>
							<li>
                                <a href="<?php echo landquest_home_url('/datasets/'); ?>" title="<?php _e('Data & Resources', 'landquest'); ?>">
                                    <span class='lsf'>&#xE055;</span>
                                    <?php _e('data and resources', 'landquest'); ?>
                                </a>
							</li>
							<li>
								<span class='lsf'>&#xE08a;</span>
								<?php _e('contact', 'landquest'); ?>
							</li>
						</ul>
					</nav>
				</div>
			</div>
			<div class="four columns">
				<div class="site-meta">
					<h1>
						<a href="<?php echo landquest_home_url('/'); ?>"><?php bloginfo('title'); ?><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png" /></a>
					</h1>
				</div>
			</div>
			<div class="offset-by-one three columns">
				<?php if(function_exists('qtrans_getLanguage')) : ?>
					<nav id="lang-nav">
						<ul>
							<?php
							global $q_config;
							if(is_404()) $url = get_option('home'); else $url = '';
							$current = qtrans_getLanguage();
							foreach($q_config['enabled_languages'] as $language) {
								$attrs = '';
								if($language == $current)
									$attrs = 'class="active"';
								echo '<li><a href="' . qtrans_convertURL($url, $language) . '" ' . $attrs . '>' . $q_config['language_name'][$language] . '</a></li>';
							}
							?>
						</ul>
					</nav>
				<?php endif; ?>
				<div class="clearfix">
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>
	</header>