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

	<!-- <a class="backhome" href="<?php //echo esc_url( home_url( '/artworks/' ) ); ?>" rel="back">&nbsp;</a> -->

	<div class="rc-artwork-photos">

		<?php
		$is_unlocated = get_post_custom_values('art_unlocated', get_the_ID())[0];
		$is_damaged = get_post_custom_values('art_damaged', get_the_ID())[0];

		$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );

		$otherphotos = get_field('art_additional_images', get_the_ID());
		$otherphotos_check = get_field('art_additional_images', get_the_ID())[0]['art_attached_images'];

		$otherpics_code = '';
		$otherpics_big_code = '';
		if ($otherphotos_check && $otherphotos_check != '') {
			foreach ($otherphotos as $otherphoto) {
				$pic_id = $otherphoto['art_attached_images']['ID'];
				$otherpics_code.= wp_get_attachment_image_src($pic_id,'medium_large')[0].',';
				$otherpics_big_code.= wp_get_attachment_image_src($pic_id,'full')[0].',';
			}
		}

		?>
		<figure <?php if (!empty($otherpics_code)) :
			echo 'data-otherpics="'. substr($otherpics_code, 0, -1).'"';
			echo 'data-otherpics-big="'. substr($otherpics_big_code, 0, -1).'"';
		endif; ?> data-mode="swiper">
		<a href="<?php echo wp_get_attachment_image_src($post_thumbnail_id,'medium_large')[0]; ?>"  data-lity data-big-pic="<?php echo wp_get_attachment_image_src($post_thumbnail_id,'full')[0]; ?>">
			<?php
			if ($is_unlocated == 1 || $is_damaged == 1) :
				echo '<script src="'.plugins_url().'/catalogo-ragionato/inc/usr_public/three.min.js"></script>';
				echo '<canvas class="p-canvas-webgl" id="canvas-webgl"></canvas>';
			else :
				//the_post_thumbnail('large');
				echo '<img src="'.wp_get_attachment_image_src($post_thumbnail_id,'medium_large')[0].'" alt="'.get_the_title().'" />';
			endif;
			?>
		</a>
		</figure>
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



			$public_fields = array(
				"art_dimensions",
				"art_weight",
				"art_photo_credits",
				"art_edition",
				//"art_number_elements",
				"art_unlocated",
				"art_notes",
				"art_exhibitions",
				"art_bibliography"
			);

			foreach ($public_fields as $public_field) :
				$public_field_value = get_post_custom_values($public_field, get_the_ID())[0];
				$pre_field = $post_field = '';


				if ($public_field == 'art_photo_credits') { $pre_field = 'Photo: '; }
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
