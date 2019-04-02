<?php /* Template Name: Home Sito */  get_header(); ?>


<div class="container-full homepage">

	<div id="heading">
		<h1>ROBERTO CUOGHI</h1>
		<p>This is the official website of Roberto Cuoghi (born September 23, 1973, Modena, Italy)</p>
	</div>

	<a href="<?php echo get_site_url().'/artworks/'; ?>" title="ROBERTO CUOGHI / ARTWORKS" class="enter"></a>

		<div class="onecol">
				<?php the_content(); ?>
		</div>


</div>

<?php get_footer(); ?>
