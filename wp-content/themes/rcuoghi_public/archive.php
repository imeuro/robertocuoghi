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


		<header class="page-header">

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

		<?php if ( have_posts() ) { ?>

		<div class="archive-posts">
		<?php
			while ( have_posts() ) {
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


						// PIC SIZE IS (NOT ANYMORE) BASED ON REAL WORLD DIMENSIONS
						// BUT YOU CAN STILL APPLY A VARIATION
						$manage_dimensions = get_field('manage_dimensions');
						if (!is_null($manage_dimensions)) {
							$dimensions_override = $manage_dimensions['dimensions_variation'];
							$dimensions_reset = $manage_dimensions['dimensions_reset'];
						} else {
							$dimensions_override = null;
							$dimensions_reset = null;
						}

						if ( isset($dimensions_override) && (!isset($dimensions_reset) || $dimensions_reset == '') ) {
							$multiplier = $dimensions_override;
						} else {
							$multiplier = 100;

							$manage_dimensions = array(
								'dimensions_variation' 	=> round($multiplier),
								'dimensions_reset'		=> '',

							);
							// set the dimensions override CPT for future reference 
							update_field( 'manage_dimensions', $manage_dimensions, get_the_ID() );
						}
						echo '<img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="'.$ThumbImgData[0].'" width="'.$ThumbImgData[1].'" height="'.$ThumbImgData[2].'" alt ="Roberto Cuoghi - '.the_title_attribute( array( 'echo' => false, ) ).'" class="rc-lazyload"  data-adjusted-size="'.$multiplier.'" />';
						?>
					</a>
				</article>

			<?php
			}
		?>
		</div>

		<?php
			the_posts_navigation();

		} else { // no posts
			get_template_part( 'template-parts/content', 'none' );
		}

		// Restore original Post Data
		wp_reset_postdata();
		?>
		</main><!-- #main -->

		<?php
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		?>
		<aside class="artworks-navi <?php echo 'render-'.$pcls; ?>" data-tax="<?php echo $term->taxonomy ?>" data-term="<?php echo $term->name ?>">
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
