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

	<?php 
	$paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
	$args = array(
	    'orderby' => 'date',
	    'order'   => 'DESC',
	    'post_type' => 'artworks',
		'tax_query' => array(
		        array (
		            'taxonomy' => 'series',
		            'field' => 'slug',
		            'terms' => 'cinema-putiferio',
		        )
		    ),
	    'posts_per_page' => 20,
	    'paged' => $paged
	);

	$query = new WP_Query( $args );

	//print_r($query);
	// die();
	if ( $query->have_posts() ) { ?>

		<div class="archive-posts cinema-putiferio">
			<?php 
			if (term_description( 701, 'series' ) !== null) {
				echo '<h4 class="tax-term-description">'.term_description( 701, "series" ).'</h4>';
			} 
			$term = get_queried_object();
			$mobDesc = get_field('tax_desc_mobile', $term);
			if ($mobDesc && $mobDesc!=='') {
				echo '<h4 class="tax-term-description-mobile">'.$mobDesc.'</h4>';
			}

			?>
		<?php
			// while ( have_posts() ) {
			while ($query->have_posts()) {
				$query->the_post();
				//var_dump($post);
				$vid = get_field('art_additional_video', $post->ID)[0]["art_attached_video"];
				$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
				$poster="";
				if($post_thumbnail_id) {
					$poster = 'poster="'.get_the_post_thumbnail_url("$post->ID",'medium_large').'"';
				}

				?>

				<article id="title-<?php the_ID(); ?>" <?php post_class('rc-text-tit'); ?>>
					<video id='video-<?php the_ID(); ?>' class='video-js initvid' controls preload='auto' width='640' height='264' <?php echo $poster ?> data-setup='{"controls": true, "preload": "auto", "fluid": true}'>
    				<source src='<?php echo $vid['url']; ?>' type='video/mp4'>
    			</video>
					<?php // the_title_attribute( array( 'echo' => true, ) ); ?>
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
			<ul id="cat-filter">
				<li class="series cinema-putiferio" style="width: 100%"><h2 class="noclick">Cinema Putiferio</h2></li>
			</ul>
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
