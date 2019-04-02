<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rcuoghi_public
 */


$picsz = 'medium_large';

?>



<article id="thumb-<?php the_ID(); ?>" <?php post_class('rc-square-thumb'); ?>>
	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
		<?php
		$custom_thumb_id= get_field('custom_thumb',get_the_ID());
		if ($custom_thumb_id && $custom_thumb_id != '') :
			$ThumbImgData = wp_get_attachment_image_src( $custom_thumb_id, $picsz );
		else :
			$ThumbImgData = wp_get_attachment_image_src( get_post_thumbnail_id(), $picsz );
		endif;
		echo '<img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="'.$ThumbImgData[0].'" width="'.$ThumbImgData[1].'" height="'.$ThumbImgData[2].'" alt ="'.the_title_attribute( array( 'echo' => false, ) ).'" class="rc-lazyload" />';
		?>
	</a>
</article>
