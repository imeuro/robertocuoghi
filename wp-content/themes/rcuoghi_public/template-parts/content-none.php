<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rcuoghi_public
 */

?>
<?php  if ( is_search() ) : ?>
	<script src="<?php echo plugins_url() ?>/catalogo-ragionato/inc/usr_public/three.min.js"></script>
	<script>
	var picUrl = '<?php echo get_template_directory_uri()."/icons/icon-512x512.jpg" ?>';
	var picWidth = window.innerWidth;
	var picHeight = window.innerHeight;
	if (picWidth>picHeight) {
		picHeight = picWidth;
	} else {
		picWidth = picHeight;
	}
	</script>

	<div id="primary" class="content-area">

	<section class="error-404 not-found">

		<div class="page-content">
			<p><canvas class="p-canvas-webgl" id="canvas-webgl"></canvas></p>
			<p><strong>Sorry, but nothing matched your search terms.<br /> Please try again with some different keywords.</strong></p>
			<?php
			get_search_form();

			?>

		</div><!-- .page-content -->
	</section><!-- .error-404 -->

	</div><!-- #primary -->
	<script src="<?php echo plugins_url() ?>/catalogo-ragionato/inc/usr_public/glitch.js"></script>

<?php else: ?>

	<section class="no-results not-found">
		<header class="page-header">
			<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'rcuoghi_public' ); ?></h1>
		</header><!-- .page-header -->

		<div class="page-content">
			<?php
			if ( is_home() && current_user_can( 'publish_posts' ) ) :

				printf(
					'<p>' . wp_kses(
						/* translators: 1: link to WP admin new post page. */
						__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'rcuoghi_public' ),
						array(
							'a' => array(
								'href' => array(),
							),
						)
					) . '</p>',
					esc_url( admin_url( 'post-new.php' ) )
				);

			else :
				?>

				<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'rcuoghi_public' ); ?></p>
				<?php
				get_search_form();

			endif;
			?>
		</div><!-- .page-content -->
	</section><!-- .no-results -->

<?php endif; ?>