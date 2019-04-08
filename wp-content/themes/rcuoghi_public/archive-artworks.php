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
						$custom_thumb_id= get_field('custom_thumb',get_the_ID());
						if ($custom_thumb_id && $custom_thumb_id != '') :
							$ThumbImgData = wp_get_attachment_image_src( $custom_thumb_id, $picsz );
						else :
							$ThumbImgData = wp_get_attachment_image_src( get_post_thumbnail_id(), $picsz );
						endif;
						echo '<img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="'.$ThumbImgData[0].'" width="'.$ThumbImgData[1].'" height="'.$ThumbImgData[2].'" alt ="Roberto Cuoghi - '.the_title_attribute( array( 'echo' => false, ) ).'" class="rc-lazyload" />';
						?>
					</a>
				</article>

			<?php }
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

			<!-- <div id="wip">
				<p><strong>Please note:</strong> as this is a work in progress, some artworks may be missing. The full collection will be available before the official release.</p>
				<a class="close">dismiss</a>
			</div> -->

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
