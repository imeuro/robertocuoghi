


<?php /* Template Name: Home Sito */  get_header(); ?>





<div class="container-full homepage">

	<div id="heading">
		<h1>ROBERTO CUOGHI</h1>
		<p>This is the official website of Roberto Cuoghi (born September 23, 1973, Modena, Italy)</p>
	</div>

	<a href="<?php echo get_site_url().'/artworks/'; ?>" title="ROBERTO CUOGHI / ARTWORKS" class="enter">
		<div class="onecol">

				<div class="slick marquee downward">

					<div class="slick-slide">
							<div class="inner">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/lil_fellows.svg" alt="ROBERTO CUOGHI" width="217" height="300" />
							</div>
					</div>
					<div class="slick-slide">
						<div class="inner">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/lil_fellows.svg" alt="ROBERTO CUOGHI" width="217" height="300" />
						</div>
					</div>
					<div class="slick-slide">
						<div class="inner">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/lil_fellows.svg" alt="ROBERTO CUOGHI" width="217" height="300" />
						</div>
					</div>
					<div class="slick-slide">
						<div class="inner">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/lil_fellows.svg" alt="ROBERTO CUOGHI" width="217" height="300" />
						</div>
					</div>
					<div class="slick-slide">
						<div class="inner">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/lil_fellows.svg" alt="ROBERTO CUOGHI" width="217" height="300" />
						</div>
					</div>
					<div class="slick-slide">
						<div class="inner">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/lil_fellows.svg" alt="ROBERTO CUOGHI" width="217" height="300" />
						</div>
					</div>
					<div class="slick-slide">
						<div class="inner">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/lil_fellows.svg" alt="ROBERTO CUOGHI" width="217" height="300" />
						</div>
					</div>
					<div class="slick-slide">
						<div class="inner">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/lil_fellows.svg" alt="ROBERTO CUOGHI" width="217" height="300" />
						</div>
					</div>
					<div class="slick-slide">
						<div class="inner">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/lil_fellows.svg" alt="ROBERTO CUOGHI" width="217" height="300" />
						</div>
					</div>

				</div>

				<div class="slick marquee upward">

					<div class="slick-slide">
						<div class="inner">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/lil_fellows.svg" alt="ROBERTO CUOGHI" width="217" height="300" />
						</div>
					</div>
					<div class="slick-slide">
						<div class="inner">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/lil_fellows.svg" alt="ROBERTO CUOGHI" width="217" height="300" />
						</div>
					</div>
					<div class="slick-slide">
						<div class="inner">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/lil_fellows.svg" alt="ROBERTO CUOGHI" width="217" height="300" />
						</div>
					</div>
					<div class="slick-slide">
						<div class="inner">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/lil_fellows.svg" alt="ROBERTO CUOGHI" width="217" height="300" />
						</div>
					</div>
					<div class="slick-slide">
						<div class="inner">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/lil_fellows.svg" alt="ROBERTO CUOGHI" width="217" height="300" />
						</div>
					</div>
					<div class="slick-slide">
						<div class="inner">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/lil_fellows.svg" alt="ROBERTO CUOGHI" width="217" height="300" />
						</div>
					</div>
					<div class="slick-slide">
						<div class="inner">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/lil_fellows.svg" alt="ROBERTO CUOGHI" width="217" height="300" />
						</div>
					</div>
					<div class="slick-slide">
						<div class="inner">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/lil_fellows.svg" alt="ROBERTO CUOGHI" width="217" height="300" />
						</div>
					</div>
					<div class="slick-slide">
						<div class="inner">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/lil_fellows.svg" alt="ROBERTO CUOGHI" width="217" height="300" />
						</div>
					</div>

				</div>
		</div>

	</a>
</div>












<?php
/**
		OLD STUFF
**/
	// public homepage content (webcam feed?)
	// $feedURL = 'http://nas.imeuro.io:333/media/?action=stream&user=none&pwd=';
	// $file_headers = @get_headers($feedURL);
	// if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
	//     $feed = false;
	// }
	// else {
	//     $feed = true;
	// }
	//
	//
	// if ($feed == true) :
	//
	// 	echo '<div id="vstream_home"></div>';
	//
	// else : // SLIDESHOW
	//
	// 	echo display_images_from_media_library(15);
	//
	// endif;
?>

<?php get_footer(); ?>
