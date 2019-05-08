<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rcuoghi_public
 */

?>
<article id="rc-artwork-<?php the_ID(); ?>">


	<div class="rc-cinema-putiferio">

		<?php

		the_title( '<h1 class="entry-title">', '</h1>' );

		$vidz = get_field('art_additional_video', get_the_ID());
		if ($vidz && $vidz!== '') {
			$i=0;
			foreach ($vidz as $vid) {
				// var_dump($vid['art_attached_video']);
				$vidUrl = $vid['art_attached_video']['url'];
				$vidCap = $vid['art_attached_video']['description'];
				$vidW = $vid['art_attached_video']['width'];
				$vidH = $vid['art_attached_video']['height'];
				echo '<video id="RCvideo-'.$i.'" class="video-js initvid" data-setup=\'{"controls": true, "preload": "auto", "fluid": true}\'><source src="'.$vidUrl.'" type="video/mp4"></video>';
				echo '<small class="rc-video-description">'.$vidCap.'</small>';
				$i++;
			}
		}

		?>

	</div>


	<div id="rc-artwork-caption" class="entry-content">
		<?php
		if ( is_singular() ) :

			$artwork_years = get_the_terms( get_the_ID(), array( 'artwork_year' ) );
			if ($artwork_years) {
		    $artwork_year = $artwork_years[0]->name;
				echo '<p>'.$artwork_year.'</p>';
			}


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
