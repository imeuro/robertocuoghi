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

<?php
		$ppp=3;
		$pcls='one-column';
		$picsz = 'medium_large';
?>


	<div id="primary" class="content-area">

		<main id="main" class="archive-main <?php echo 'render-'.$pcls; ?>">

		<?php if ( have_posts() ) { ?>

		<div class="archive-posts">

			<?php while ( have_posts() ) {
				the_post();
				?>

				<article id="thumb-<?php the_ID(); ?>" <?php post_class('rc-square-thumb'); ?>>
					<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
						<?php

						// PIC SIZE IS BASED ON REAL WORLD DIMENSIONS
						
						$dims = get_field('art_dimensions');
						//$string = "200 x 554 x 5 cm / 78.74 x 218.11 x 21.65 in";
						$pattern = "/(\d+(?:\.\d+)?) (x|×) (\d+(?:\.\d+)?)/";
						preg_match($pattern, $dims, $matches);
						
						/*
						echo '<pre>';
						print_r($dims);
						echo '<br>';
						print_r($matches);
						echo '<br>';
						print_r($matches[1]);
						echo '<br>';
						print_r($matches[32]);
						echo '<br>';
						print_r(($matches[1] * $matches[3] ));
						echo '<br>';
						print_r(($matches[1] * $matches[3] )/5000);
						echo '</pre>';
						*/

						$custom_thumb_id= get_field('custom_thumb',get_the_ID());
						if ($custom_thumb_id && $custom_thumb_id != '') :
							$ThumbImgData = wp_get_attachment_image_src( $custom_thumb_id, $picsz );
						else :
							$ThumbImgData = wp_get_attachment_image_src( get_post_thumbnail_id(), $picsz );
						endif;

						if (isset($matches[3]) && $matches[3] != null) :
							$multiplier = ($matches[3] / $ThumbImgData[1])*400;
						else :
							$multiplier = 100;
						endif;

						echo '<img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="'.$ThumbImgData[0].'" width="'.$multiplier.'%" height="'.$ThumbImgData[2]*$multiplier.'" alt ="Roberto Cuoghi - '.the_title_attribute( array( 'echo' => false, ) ).'" class="rc-lazyload" />';

						?>
					</a>
				</article>

			<?php 
			// echo '$multiplier: '.$multiplier;
			}
			the_posts_navigation(); ?>

		</div>
		<?php } else { // no posts
			get_template_part( 'template-parts/content', 'none' );
		}

		// Restore original Post Data
		wp_reset_postdata();
		?>
		</main><!-- #main -->

		<aside class="artworks-navi <?php echo 'render-'.$pcls; ?>">
			<ul id="cat-filter"><?php get_template_part( 'template-parts/artworks', 'nav' ); ?></ul>
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
