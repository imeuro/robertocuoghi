<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package rcuoghi_public
 */

get_header();
?>

<?php
		$ppp=3;
		$pcls='one-column';
		$picsz = 'medium_large';
?>


	<div id="primary" class="content-area">


		<header class="page-header">
			<!-- <a class="backhome" href="<?php // echo esc_url( home_url( '/artworks/' ) ); ?>" rel="back">&nbsp;</a> -->
			<?php
			if (is_tax()) :
				echo '<h1 class="page-title">'.single_term_title( '', false ).'</h1>';
			else :
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
			endif;
			?>
		</header><!-- .page-header -->


		<main id="main" class="archive-main <?php echo 'render-'.$pcls; ?>">

		<?php if ( have_posts() ) : ?>

		<div class="archive-posts">
		<?php
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

	<aside class="artworks-navi <?php echo 'render-'.$pcls; ?>">
		<?php get_template_part( 'template-parts/artworks', 'nav' ); ?>
	</aside>

	<div class="page-load-status">
		<div class="loader-ellips infinite-scroll-request">
			<span class="loader-ellips__dot"></span>
			<span class="loader-ellips__dot"></span>
			<span class="loader-ellips__dot"></span>
			<span class="loader-ellips__dot"></span>
		</div>
		<p class="infinite-scroll-last">* * *</p>
		<p class="infinite-scroll-error">whopsie!</p>
	</div>

</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
