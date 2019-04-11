<?php
/**
 * rcuoghi_public functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package rcuoghi_public
 */

if ( ! function_exists( 'rcuoghi_public_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function rcuoghi_public_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on rcuoghi_public, use a find and replace
		 * to change 'rcuoghi_public' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'rcuoghi_public', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );


		add_theme_support('nav-menus');
	}
endif;
add_action( 'after_setup_theme', 'rcuoghi_public_setup' );



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function rcuoghi_public_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'rcuoghi_public_content_width', 640 );
}
add_action( 'after_setup_theme', 'rcuoghi_public_content_width', 0 );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';


//
// https://wordpress.stackexchange.com/questions/176347/pagination-returns-404-after-page-20
add_action( 'pre_get_posts', 'wpse176347_pre_get_posts' );
function wpse176347_pre_get_posts( $q ) {
    if(    !is_admin()
        && $q->is_main_query()
        && ( $q->is_post_type_archive( 'artworks' ) || $q->is_archive() || $q->is_search() )
    ) {
        $q->set( 'posts_per_page', 999 );
				$q->set( 'post_status', 'publish' );
				$q->set( 'meta_key', 'art_code' );
				$q->set( 'orderby', 'meta_value' );
				$q->set( 'order', 'DESC' );
    }
}



// for the slideshow in public homepage
function get_images_from_media_library($num) {
    $args = array(
        'post_type' => 'attachment',
        'post_mime_type' =>'image',
        'post_status' => 'inherit',
        'posts_per_page' => $num,
        'orderby' => 'rand'
    );
    $query_images = new WP_Query( $args );
    $images = array();
    foreach ( $query_images->posts as $image) {
        $images[]= $image->ID;
    }
    return $images;
}
function display_images_from_media_library($num) {

	$imgs = get_images_from_media_library($num);
	$html = '<div id="home-media-gallery">';
	$html .= '	<div class="swiper-container">';
  $html .= '		<div class="swiper-wrapper">';

	foreach($imgs as $img) {
		$imgdata = wp_get_attachment_image_src($img,'large');
		$html .= '<div class="swiper-slide swiper-lazy" style="background-image:url(' . $imgdata[0] . ')"></div>';

	}

	$html .= '		</div>';
	$html .= '	</div>';
	$html .= '</div>';

	return $html;

}


// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
