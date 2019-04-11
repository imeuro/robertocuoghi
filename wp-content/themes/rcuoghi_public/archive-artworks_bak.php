<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rcuoghi_public
 */

get_header();
?>
	<div id="primary" class="content-area">


		<header class="page-header">
			<h1 class="page-title">Artworks</h1>
		</header><!-- .page-header -->


		<main id="main" class="archive-main">

		<?php if ( have_posts() ) : ?>

			<div class="archive-posts">

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				// get_template_part( 'template-parts/content', get_post_type() );
				?>
				<article id="thumb-<?php the_ID(); ?>" <?php post_class('rc-square-thumb'); ?>>
					<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
						<?php
						$custom_thumb_id= get_field('custom_thumb',get_the_ID());
						// if ($custom_thumb_id && $custom_thumb_id != '') :
						// 	echo wp_get_attachment_image($custom_thumb_id,'public-square', array(
						// 		'alt' => the_title_attribute( array( 'echo' => false, ) ),
						// 	) );
						// else :
							echo get_the_post_thumbnail( $post->ID, 'public-square', array(
								'alt' => the_title_attribute( array( 'echo' => false, ) ),
							) );
						// endif;
						?>
					</a>
				</article>
				<?php
				wp_cache_flush();
			endwhile;
			?>
			</div>

			<?php the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>


		</main><!-- #main -->

		<aside class="artworks-navi">
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
				<p class="infinite-scroll-error">- - -</p>
			</div>

	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
