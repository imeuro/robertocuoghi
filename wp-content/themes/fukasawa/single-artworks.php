<?php get_header(); ?>

<div class="content">

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class( 'single' ); ?>>

			<?php

			$post_format = get_post_format();

			if ( $post_format == 'video' ) :

				if ( $pos = strpos( $post->post_content, '<!--more-->' ) ) : ?>

					<div class="featured-media">

						<?php

						// Fetch post content
						$content = get_post_field( 'post_content', get_the_ID() );

						// Get content parts
						$content_parts = get_extended( $content );

						// oEmbed part before <!--more--> tag
						$embed_code = wp_oembed_get($content_parts['main']);

						echo $embed_code;

						?>

					</div><!-- .featured-media -->

				<?php endif;

			elseif ( $post_format == 'gallery' ) : ?>

				<div class="featured-media">

					<?php fukasawa_flexslider( 'post-image' ); ?>

					<div class="clear"></div>

				</div><!-- .featured-media -->

			<?php endif; ?>

			<div class="post-inner-top">
				<div class="post-header">

					<?php
					$terms = wp_get_post_terms( $post->ID, array( 'media_type' ) );
					if ( $terms ) : ?>
						<h2 class="post-categories">
							<?php
							foreach ( $terms as $term ) :
								echo get_term_parents_list( $term->term_id, 'media_type', array( 'separator' => ' / ' ) );
							endforeach; ?>
						</h2>
					<?php endif; ?>
					<?php the_title( '<h1 class="post-title">', '</h1>' ); ?>


				</div><!-- .post-header -->
			</div><!-- .post-inner -->

				<?php if ( has_post_thumbnail() ) : ?>

					<div class="featured-media">

						<?php the_post_thumbnail( 'medium_large' ); ?>

						<?php
						if (get_field('art_copyright') && (get_field('art_copyright')=='1')) :
							echo '<span class="copy">&copy; - all rights reserved</span>';
						endif;
						?>

					</div><!-- .featured-media -->

				<?php endif; ?>

			<div class="post-inner">
			    <div class="post-content">

			    	<?php
					if ( $post_format == 'video' ) {
						$content = $content_parts['extended'];
						$content = apply_filters( 'the_content', $content );
						echo $content;
					} else {
						the_content();
					}
					?>

			    </div><!-- .post-content -->

					<div class="clear"></div>

					<div class="post-data">
						<ul>
						<?php
				    $artworks_fields = get_artworks_fields();
				    foreach ( $artworks_fields as $name => $field ):

						$key = $field['label'];
						$value = $field['value'];

						if (is_array($value) === true) :
							// echo '<pre>';
							// print_r($name);
							// echo '</pre>';

							if ($name == 'art_additional_images') {
								$arr_name = 'art_attached_images';
							} elseif ($name == 'art_additional_video') {
								$arr_name = 'art_attached_video';
							} elseif ($name == 'art_attachments') {
								$arr_name = 'art_attachment';
							}

							$value = array_filter($value);
							echo '<li class="key"><strong>'.$key.':</strong></li>';
							echo '<li class="value">';
							
							foreach ( $value as $arr_field ) :
								// echo '<pre>';
								// print_r( $arr_field);
								// echo '</pre>';
								if (!empty($arr_field[$arr_name])) :
									echo '<a href="'.$arr_field[$arr_name]['url'].'" target="_blank">'.wp_get_attachment_image($arr_field[$arr_name]['ID'],'thumbnail',true).'</a><br>';
								endif;
							endforeach;

							continue;

						elseif ($name != 'art_unlocated' && !empty($value)) :




							if ($name == 'art_copyright' ) :

								//$value = array_filter($value);
								echo '<li class="key"><strong>'.$key.':</strong></li>';
								echo '<li class="value">yes';

							else:
								echo '<li class="key"><strong>'.$key.':</strong></li>';
								echo '<li class="value">';
								echo $value;
							endif;

							echo '</li>';

						endif;

				    endforeach;

						if (get_field('art_unlocated') && (get_field('art_unlocated')=='1')) :
							echo '<li class="key key-art-unlocated"><strong>* unlocated artwork *</strong></li>';
						endif;
						?>
						</ul>

					</div><!-- .post-data -->

					<div class="clear"></div>

				<div class="post-meta-bottom">

					<ul>
						<?php edit_post_link( __( 'Edit artwork', 'fukasawa' ), '<li><span class="genericon genericon-edit"></span>', '</li>' ); ?>
					</ul>

					<div class="clear"></div>

				</div><!-- .post-meta-bottom -->

			</div><!-- .post-inner -->

		</div><!-- .post -->

	<?php endwhile;

	else: ?>

		<p><?php _e( "We couldn't find any posts that matched your query. Please try again.", "fukasawa" ); ?></p>

	<?php endif; ?>

</div><!-- .content -->

<?php get_footer(); ?>
