<?php
/**
 * The template for displaying archive of CINEMA PUTIFERIO page
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

				<article id="title-<?php the_ID(); ?>" <?php post_class('rc-text-tit'); ?>>
					<a class="post-ttitle" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
						<?php the_title_attribute( array( 'echo' => true, ) ); ?>
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
