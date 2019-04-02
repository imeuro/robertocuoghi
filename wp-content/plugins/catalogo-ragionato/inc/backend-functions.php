<?php

// Aggiornamento opere -> vedi ajax-update-artworks.php
add_action('admin_menu', 'update_artworks_submenu_page');
function update_artworks_submenu_page() {
    add_submenu_page(
        'tools.php',
        'Update Artworks (alpha!)',
        'Update Artworks',
        'manage_options',
        'update-artworks.php',
        'update_artworks_submenu_page_callback' );
}
require_once('ajax-update-artworks.php');



// add number of opere a catalogo in dashboard
add_filter( 'dashboard_glance_items', 'custom_glance_items', 10, 1 );
function custom_glance_items( $items = array() ) {
  $post_types = array( 'artworks' );
  foreach( $post_types as $type ) {
    if( ! post_type_exists( $type ) ) continue;
    $num_posts = wp_count_posts( $type );
    if( $num_posts ) {
      $published = intval( $num_posts->publish );
      $post_type = get_post_type_object( $type );
      $text = _n( '%s ' . $post_type->labels->singular_name, '%s ' . $post_type->labels->name, $published, 'your_textdomain' );
      $text = sprintf( $text, number_format_i18n( $published ) );
      if ( current_user_can( $post_type->cap->edit_posts ) ) {
        $output = '<a href="edit.php?post_type=' . $post_type->name . '">' . $text . '</a>';
        echo '<li class="post-count ' . $post_type->name . '-count">' . $output . '</li>';
      } else {
        $output = '<span>' . $text . '</span>';
        echo '<li class="post-count ' . $post_type->name . '-count">' . $output . '</li>';
      }
    }
  }
  return $items;
}

// Remove Unwanted Admin Menu Items
function remove_admin_menu_items() {
	$remove_menu_items = array(__('Comments'),__('Posts'));
	global $menu;
	end ($menu);
	while (prev($menu)){
		$item = explode(' ',$menu[key($menu)][0]);
		if(in_array($item[0] != NULL?$item[0]:"" , $remove_menu_items)){
		unset($menu[key($menu)]);}
	}
}

add_action('admin_menu', 'remove_admin_menu_items');



// sortable column in backend
// https://wpdreamer.com/2014/04/how-to-make-your-wordpress-admin-columns-sortable/
add_filter( 'manage_edit-artworks_sortable_columns', 'ffm_sortable_columns' );
function ffm_sortable_columns( $sortable_columns ) {
  $sortable_columns[ 'taxonomy-media_type' ] = 'media_type';
   //$sortable_columns[ 'column-meta' ] = 'anno_opera';
   $sortable_columns[ '5ab038f995028' ] = 'art_code';
   $sortable_columns[ '5ab038f9954ef' ] = 'thumbnail_id';
	 return $sortable_columns;
}
add_action( 'pre_get_posts', 'manage_wp_posts_be_qe_pre_get_posts', 1 );
function manage_wp_posts_be_qe_pre_get_posts( $query ) {
   if ( $query->is_main_query() && ( $orderby = $query->get( 'orderby' ) ) ) {
      switch( $orderby ) {
        case 'media_type':
          $query->set( 'tax_query', 'media_type' );
          $query->set( 'orderby', 'name' );
          break;
       	case 'art_code':
          $query->set( 'meta_key', 'art_code' );
          $query->set( 'orderby', 'meta_value' );
          break;
        case 'column-featured_image':
           $query->set( 'meta_key', 'thumbnail_id' );
           $query->set( 'compare', '==' );
           $query->set( 'value', '' );
           $query->set( 'orderby', 'meta_value' );
           break;
      }
   }
}


?>
