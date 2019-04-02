<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package rcuoghi_public
 */

get_header();
?>
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
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'rcuoghi_public' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><canvas class="p-canvas-webgl" id="canvas-webgl"></canvas></p>
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'rcuoghi_public' ); ?></p>

					<?php
					get_search_form();

					?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

	</div><!-- #primary -->
	<script src="<?php echo plugins_url() ?>/catalogo-ragionato/inc/usr_public/glitch.js"></script>

<?php
get_footer();
