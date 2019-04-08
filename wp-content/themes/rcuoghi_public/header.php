<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rcuoghi_public
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="manifest" href="<?php echo esc_url( home_url() ); ?>/manifest.json">
	<link rel="shortcut icon" href="<?php echo esc_url( home_url() ); ?>/favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?php echo esc_url( home_url() ); ?>/favicon.ico" type="image/x-icon">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<?php if ( !is_front_page() ) : ?>

		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'rcuoghi_public' ); ?></a>
		<header id="masthead" class="site-header">
			<div class="site-branding rc-container">

				<div id="rc_searchform">
					<?php get_search_form(); ?>
				</div>

				<?php the_custom_logo(); ?>

				
					<?php if ( is_post_type_archive('artworks') ) : ?>
						<h1 class="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<img class="shake" src="<?php echo get_template_directory_uri()."/icons/icon-192x192.png"; ?>" alt="<?php bloginfo( 'name' ); ?>" />
							</a>
						</h1>
					<?php else: ?>
						<h2 class="site-title">
							<a href="<?php echo esc_url( home_url( '/artworks/' ) ); ?>" rel="prev">
								<span><img class="shake" src="<?php echo get_template_directory_uri()."/icons/icon-192x192.png"; ?>" alt="<?php bloginfo( 'name' ); ?>" /></span>
							</a>
						</h2>
					<?php endif; ?>
					
				


				<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="menu-rcuoghi-public" aria-expanded="false"><?php esc_html_e( 'MENU', 'rcuoghi-public' ); ?></button>
				<?php
				wp_nav_menu( array(
					'menu'		=> 'rcuoghi-public'
				) );
				?>
			</nav><!-- #site-navigation -->
			</div><!-- .site-branding -->


		</header><!-- #masthead -->

		<div id="content" class="site-content rc-container">

	<?php endif; ?>
