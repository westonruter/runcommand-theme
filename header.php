<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<header class="site-header">
		<div class="row">
			<div class="columns medium-5 large-6">
				<a class="site-title" href="<?php echo home_url( '/' ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/running-man.svg' ); ?>">runcommand</a> <span class="social"><a href="https://github.com/runcommand"><i class="fa fa-github"></i></a> <a href="https://twitter.com/runcommand"><i class="fa fa-twitter"></i></a></span>
				<p class="site-description"><?php bloginfo( 'description' ); ?></p>
			</div>
			<div class="columns medium-6 medium-offset-1 large-5">
				<ul class="inline-list header-nav">
					<li><a href="<?php echo esc_url( home_url( 'for-hosts/' ) ); ?>">For Hosts</a></li>
					<li><a href="<?php echo esc_url( home_url( 'for-agencies/' ) ); ?>">For Agencies</a></li>
					<li><a href="<?php echo esc_url( home_url( 'pricing/' ) ); ?>">Pricing</a></li>
				</ul>
			</div>
		</div>
	</header>

