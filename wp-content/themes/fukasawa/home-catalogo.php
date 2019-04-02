<?php /* Template Name: Home Catalogo */  get_header(); ?>

<div class="content">


		<?php // include('searchform-catalogo.php'); ?>


	<?php
	$args = array(
		'post_type' 				=> 'artworks',
		'nopaging'					=> false,
		'paged' 						=> $page,
		'orderby'						=> 'date',
		'order'							=> 'DESC'
	);

	$page = (get_query_var('page')) ? get_query_var('page') : 1;
	$args['page'] = $page;

	$wp_query = new WP_Query( $args );

	if ( $wp_query->have_posts() ) :
		$total_post_count = wp_count_posts();
		$published_post_count = $total_post_count->publish;
		$total_pages = ceil( $published_post_count / $posts_per_page );

		if ( 1 < $page ) : ?>

			<div class="page-title">

				<h4><?php printf( __( 'Page %s of %s', 'fukasawa' ), $page, $wp_query->max_num_pages ); ?></h4>

			</div><!-- .page-title -->

			<div class="clear"></div>

		<?php endif; ?>

		<div class="posts" id="posts">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'content', get_post_format() );

			endwhile;

		endif; ?>

	</div><!-- .posts -->

	<?php if ( $wp_query->max_num_pages > 1 ) : ?>

		<div class="archive-nav">

			<?php echo get_next_posts_link( __( 'Older posts', 'fukasawa' ) . ' &rarr;' ); ?>

			<?php echo get_previous_posts_link( '&larr; ' . __( 'Newer posts', 'fukasawa' ) ); ?>

			<div class="clear"></div>

		</div><!-- .archive-nav -->

	<?php endif; ?>

</div><!-- .content -->

<?php get_footer(); ?>
