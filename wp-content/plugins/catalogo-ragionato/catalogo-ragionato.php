<?php
/*
Plugin Name: Artworks Catalogue
Plugin URI: http://imeuro.io/
Description: Catalogo delle opere di Roberto Cuoghi
Version: 1.0
Author: Mauro Fioravanzi
Author URI: http://imeuro.io/
*/


include('inc/custom-post-types-fields-taxonomies.php');
include('inc/backend-functions.php');
//include('inc/ajax-update-artworks.php');


/**
		switch theme and functions:
		if user is staff vs. if user is public:
**/


function rcuoghi_change_theme($themename) {
    //if ( current_user_can('edit_posts') ) {
		$current_user = wp_get_current_user();
		if ( $current_user && ($current_user->user_login == 'meuro' || $current_user->user_login == 'retrobalera') ) {
      $themename = 'fukasawa';
    } else {
			$themename = 'rcuoghi_public';
		}
    return $themename;
}
add_filter('template', 'rcuoghi_change_theme');
add_filter('stylesheet', 'rcuoghi_change_theme');



function catalogo_scriptsnstyles() {
	//$usr_path = 'inc/usr_staff';

	/*

	*/

	$themeinfo = wp_get_theme();
	//var_dump($themeinfo->Name);
	if ($themeinfo->Name == 'Fukasawa' ) {
		$usr_path = 'inc/usr_staff';
	} else {
		$usr_path = 'inc/usr_public';
	}


	$cacheBusterCSS = date("mdHi", filemtime( plugin_dir_path( __FILE__ ) . $usr_path . '/catalogo-ragionato.css'));
	$cacheBusterJS = date("mdHi", filemtime( plugin_dir_path( __FILE__ ) . $usr_path . '/catalogo-ragionato.js'));

	// echo 'TEST $cacheBusterJS: '.$cacheBusterJS.' | '.plugin_dir_path( __FILE__ ) . $usr_path . '/catalogo-ragionato.js';
	// echo 'TEST $cacheBusterCSS: '.$cacheBusterCSS.' | '.plugin_dir_path( __FILE__ ) . $usr_path . '/catalogo-ragionato.css';


	if ($themeinfo->Name == 'rcuoghi_public' ) {

		wp_deregister_script( 'jquery' );
		wp_enqueue_script( 'rcuoghi_public-jquery', plugin_dir_url( __FILE__ ) . $usr_path . '/jquery-3.3.1.min.js', array(), '20151215', false );


		if ( is_home() || is_front_page() ) {
			wp_enqueue_style( 'slick', plugin_dir_url( __FILE__ ) . $usr_path . '/slick.css', array(), '', 'all');
			wp_enqueue_style( 'home', plugin_dir_url( __FILE__ ) . $usr_path . '/home.css', array(), '', 'all');
			wp_enqueue_script( 'home', plugin_dir_url( __FILE__ ) . $usr_path . '/home.js', array('rcuoghi_public-jquery'), '', true );
			wp_enqueue_script( 'slick', plugin_dir_url( __FILE__ ) . $usr_path . '/slick.min.js', array('rcuoghi_public-jquery'), '', true );
		} else {

			//wp_enqueue_style( 'rcuoghi_public-font', 'https://fonts.googleapis.com/css?family=Hind:300,500' );
			wp_enqueue_style( 'rcuoghi_public-font', 'https://fonts.googleapis.com/css?family=Lato:300,700' );
			wp_enqueue_style( 'rcuoghi_public-style', get_stylesheet_uri() );


			wp_enqueue_script( 'rcuoghi_public-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
			wp_enqueue_script( 'rcuoghi_public-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );


			if ( is_archive() || is_search() ) {
				wp_enqueue_script( 'rcuoghi_public-infinitescroll', plugin_dir_url( __FILE__ ) . $usr_path . '/jquery.infinitescroll.min.js', array('rcuoghi_public-jquery'), '20181215', true );
				wp_enqueue_script( 'rcuoghi_vanilla-lazyload', 'https://cdn.jsdelivr.net/npm/vanilla-lazyload@8.17.0/dist/lazyload.min.js', array(), '20151215', true );

			}

			if ( is_single() ) {
				wp_enqueue_style( 'swiper', plugin_dir_url( __FILE__ ) . $usr_path . '/swiper.min.css', array(), $cacheBusterCSS, 'all');
				wp_enqueue_script( 'swiper', plugin_dir_url( __FILE__ ) . $usr_path . '/swiper.min.js', array('rcuoghi_public-jquery'), $cacheBusterJS, true );
				wp_enqueue_style( 'lity', plugin_dir_url( __FILE__ ) . $usr_path . '/lity.min.css', array(), $cacheBusterCSS, 'all');
				wp_enqueue_script( 'lity', plugin_dir_url( __FILE__ ) . $usr_path . '/lity.min.js', array('rcuoghi_public-jquery'), $cacheBusterJS, true );
			}


		}


	}

	wp_enqueue_script( 'catalogo', plugin_dir_url( __FILE__ ) . $usr_path . '/catalogo-ragionato.js', array('rcuoghi_public-jquery'), $cacheBusterJS, true );
	wp_enqueue_style( 'catalogo', plugin_dir_url( __FILE__ ) . $usr_path . '/catalogo-ragionato.css', array(), $cacheBusterCSS, 'all');

}
add_action( 'wp_enqueue_scripts', 'catalogo_scriptsnstyles' );










/**
		MISC FUNCTIONS & UTILITIES
**/

// nome template in pagina:
// get_current_template(true)
add_filter( 'template_include', 'var_template_include', 1000 );
function var_template_include( $t ){
    $GLOBALS['current_theme_template'] = basename($t);
    return $t;
}

function get_current_template( $echo = false ) {
    if( !isset( $GLOBALS['current_theme_template'] ) )
        return false;
    if( $echo )
        echo $GLOBALS['current_theme_template'];
    else
        return $GLOBALS['current_theme_template'];
}


// se l'archivio mostra solo 1 post, vai diretto al post
function redirect_to_post(){
    global $wp_query;
    if( is_archive() && $wp_query->post_count == 1 ){
        the_post();
        $post_url = get_permalink();
        wp_redirect( $post_url );
    }

} add_action('template_redirect', 'redirect_to_post');


//
// https://support.advancedcustomfields.com/forums/topic/no-p-tags-with-wysiwyg-field/
function my_acf_add_local_field_groups() {
    add_filter('acf_the_content', 'wpautop' );
}
add_action('acf/init', 'my_acf_add_local_field_groups');


add_image_size( 'public-square', '480', '480', true );
add_image_size( 'stupid-thumbs', '25', '25', false );

function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'extra-menu' => __( 'Artworks Menu' ),
      'private-menu' => __( 'Private Menu' )
    )
  );
}
add_action( 'init', 'register_my_menus' );

?>
