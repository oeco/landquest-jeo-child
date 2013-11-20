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
		<div class="container">
			<div class="four columns">
				<div id="masthead-nav">
					<nav>
						<ul>
							<li>
								<span class='lsf'>&#xE051;</span>
								about
							</li>
							<li>
								<span class='lsf'>&#xE055;</span>
								data and resources
							</li>
							<li>
								<span class='lsf'>&#xE08a;</span>
								contact
							</li>
						</ul>
					</nav>
				</div>
			</div>
			<div class="four columns">
				<div class="site-meta">
					<img width="245" height="100" src='<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png'>
				</div>
			</div>			
			<div class="four columns">
				<nav>
					<ul>
						english
					</ul>
					<ul>
						español
					</ul>							
				</nav>
				<div id="masthead-nav">
					<div class="clearfix">
						<nav id="main-nav">
							<?php wp_nav_menu(array('theme_location' => 'header_menu')); ?>
						</nav>
						<?php get_search_form(); ?>
					</div>
				</div>
			</div>
		</div>
	</header>