<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rcuoghi_public
 */

?>

<?php if ( !is_front_page() ) : ?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-info site-content rc-container">
			<div class="right site-navigation">
				<?php wp_nav_menu( array( 'menu'	=> 'rcuoghi-public' ) ); ?>
			</div>
			<span class="left copyright">&copy; ROBERTO CUOGHI</span>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->


<?php else: ?>
	<footer id="colophon" class="site-footer">
		<div class="microfooter copyright align-center">&copy; ROBERTO CUOGHI</div>
	</footer>
<?php endif; ?>

</div><!-- #page -->


<?php wp_footer();
// echo '<!--<span class="tplname">'.get_current_template().'</span>-->';
?>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-134415424-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-134415424-1');
</script>
</body>
</html>
