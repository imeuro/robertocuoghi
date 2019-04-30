<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rcuoghi_public
 */

?>
<article id="rc-artwork-<?php the_ID(); ?>" <?php post_class(); ?>>


	<div class="rc-artwork-photos">

		<?php
		$is_unlocated = get_post_custom_values('art_unlocated', get_the_ID())[0];
		$is_damaged = get_post_custom_values('art_damaged', get_the_ID())[0];

		$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );

		// altre foto
		$otherphotos = get_field('art_additional_images', get_the_ID());
		$otherphotos_check = get_field('art_additional_images', get_the_ID())[0]['art_attached_images'];

		// var_dump($otherphotos_check);

		$generated_code = '';
		if (!empty($otherphotos_check)) { // più foto: genero swiper con featured alla fine

			$generated_code .= "\n<figure data-mode=\"swiper\">\n\n<div class=\"swiper-container\" id=\"fl_swipercontainer\">\n<div class=\"swiper-wrapper\">";
			foreach ($otherphotos as $otherphoto) {
				// print_r($otherphoto['art_attached_images']['type']);
				if ($otherphoto['art_attached_images']['type'] == 'image') {
					$pic_id = $otherphoto['art_attached_images']['ID'];
					$generated_code .= "\n<div class=\"swiper-slide\">\n\t<a href=\"".wp_get_attachment_image_src($pic_id,'medium_large')[0]."\" data-lity>\n\t\t<img src=\"".wp_get_attachment_image_src($pic_id,'medium_large')[0]."\" alt=\"".get_the_title()."\" />\n\t</a>\n</div>";
				}
			}
			// aggiungo la featured alla fine (...#@*!)
			$generated_code .= "\n<div class=\"swiper-slide\">\n\t<a href=\"".wp_get_attachment_image_src($post_thumbnail_id,'medium_large')[0]."\" data-lity>\n\t\t<img src=\"".wp_get_attachment_image_src($post_thumbnail_id,'medium_large')[0]."\"alt=\"".get_the_title()."\" />\n\t</a>\n</div>";
			$generated_code .= "\n</div>\n<div class=\"swiper-pagination\"></div>\n</div>\n\n</figure>\n\n";

		} else { // una sola foto: semplice img src

			$generated_code .= "<figure><a href=\"".wp_get_attachment_image_src($post_thumbnail_id,'medium_large')[0]."\" data-lity>";
			if ($is_unlocated == 1 || $is_damaged == 1) {
				$generated_code .= "<script src=\"".plugins_url()."/catalogo-ragionato/inc/usr_public/three.min.js\"></script>";
				$generated_code .= "<canvas class=\"p-canvas-webgl\" id=\"canvas-webgl\"></canvas>";
			} else {
				$generated_code .= "<img src=\"".wp_get_attachment_image_src($post_thumbnail_id,'medium_large')[0]."\" alt=\"".get_the_title()."\" />";
			}
			$generated_code .= "</a></figure>\n";

		}


		// finally... printo to screen
		echo $generated_code;
		?>

	</div>


	<div id="rc-artwork-caption" class="entry-content">
		<?php
		if ( is_singular() ) :

			the_title( '<h1 class="entry-title">', '</h1>' );
			$artwork_years = get_the_terms( get_the_ID(), array( 'artwork_year' ) );
			if ($artwork_years) {
		    $artwork_year = $artwork_years[0]->name;
				echo '<p>'.$artwork_year.'</p>';
			}


		// video
		// $videos = get_field('art_additional_video', get_the_ID());
		// $videos_check = get_field('art_additional_video', get_the_ID())[0]['art_attached_video'];
		// // print_r($videos_check);
		// $videos_code = '';
		// if ($videos_check && $videos_check != '') {
		// 	foreach ($videos as $video) {
		// 		$videos_code.= $video['art_attached_video']['url'].',';
		// 	}
		// }
		// print_r($videos_code);


			$public_fields = array(
				"art_dimensions",
				"art_materials",
				"art_weight",
				"art_photo_credits",
				"art_edition",
				"art_unlocated",
				"art_notes",
				"art_additional_video",
				"art_exhibitions",
				"art_bibliography"
			);

			foreach ($public_fields as $public_field) :
				$public_field_value = get_post_custom_values($public_field, get_the_ID())[0];
				$pre_field = $post_field = '';


				if ($public_field == 'art_photo_credits') { $pre_field = 'Photo: '; }
				if ($public_field == 'art_additional_video') {
					$vidz = get_field('art_additional_video', get_the_ID());
					if ($vidz && $vidz!== '') {
						foreach ($vidz as $vid) {
							// var_dump($vid['art_attached_video']);
							$vidUrl = $vid['art_attached_video']['url'];
							$vidCap = $vid['art_attached_video']['description'];
							$vidW = $vid['art_attached_video']['width'];
							$vidH = $vid['art_attached_video']['height'];
							echo '<span class="videocont" data-video="'.$vidUrl.'"  data-video-width="'.$vidW.'"  data-video-height="'.$vidH.'" data-video-description="'.$vidCap.'" ></span>';
						}
					}
					continue;
				}
				if ($public_field == 'art_exhibitions') {
					$pre_field = '<span id="viewmore_txt" class="closed"><span>Exhibitions:</span><br />';
					$post_field = '</span><hr class="divider" /><button id="viewmore_btn"></button>';
				}

				if ($public_field == 'art_unlocated' && $public_field_value == 1) { echo '<p class="unlocated-work">UNLOCATED WORK</p>'; continue; }
				else if ($public_field_value && !empty($public_field_value)) {
					echo '<p class="'.$public_field.'">'.$pre_field.nl2br($public_field_value).$post_field.'</p>';
				}
			endforeach;



			// print_r(get_post_custom(get_the_ID()));
		endif;
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php rcuoghi_public_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->

<div id="fl_background"<?php if (empty($otherpics_code)) : echo' class="singlepic"'; endif;?>>
	<a id="fl_close">Close</a>
</div>


<?php
if ($is_unlocated == 1 || $is_damaged == 1) :
	$pic_data = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );
?>
	<script>
	var picUrl = '<?php echo $pic_data[0]; ?>';
	var picWidth = '<?php echo $pic_data[1]; ?>';
	var picHeight = '<?php echo $pic_data[2]; ?>';
	</script>
	<?php if (empty($otherpics_code)) : ?>
		<script id="glitchJS" src="<?php echo plugins_url() ?>/catalogo-ragionato/inc/usr_public/glitch.js"></script>
	<?php else : ?>
		<script id="glitchJS"></script>
	<?php endif; ?>
<?php endif; ?>
