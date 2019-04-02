<?php

// Register Custom Post Type
function catalogo_ragionato_post_type() {

	$labels = array(
		'name'                  => 'Artworks',
		'singular_name'         => 'Artwork',
		'menu_name'             => 'Artworks',
		'name_admin_bar'        => 'Artworks',
		'archives'              => 'Archive',
		'slug'									=> 'artworks-catalogue',
		//	'parent_item_colon'     => 'Parent Item:',
		// 'all_items'             => 'Tutte le opere',
		// 'add_new_item'          => 'Aggiungi opera',
		// 'add_new'               => 'Aggiungi opera',
		// 'new_item'              => 'Nuova opera',
		// 'edit_item'             => 'Modifica opera',
		// 'update_item'           => 'Aggiorna opera',
		// 'view_item'             => 'Visualizza opera',
		// 'search_items'          => 'Cerca opera',
		// 'not_found'             => 'Non trovata',
		// 'not_found_in_trash'    => 'Non trovata nel Cestino',
		// 'featured_image'        => 'Immagine Principale',
		// 'set_featured_image'    => 'Imposta Immagine Principale',
		// 'remove_featured_image' => 'Rimuovi Immagine Principale',
		// 'use_featured_image'    => 'Usa come Immagine Principale',
	);
	$args = array(
		'label'                 => 'Artwork',
		'description'           => 'Catalogo delle opere di Roberto Cuoghi',
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-book',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'artworks', $args );

}
add_action( 'init', 'catalogo_ragionato_post_type', 0 );




// Register Custom Fields for "Catalogo" post type
function catalogo_ragionato_custom_fields() {
	// qui andr√† inserito il codice esportato da ACF

}
add_action( 'init', 'catalogo_ragionato_custom_fields', 0 );





//create a custom taxonomy name it topics for your posts

function artworks_custom_taxonomy() {

// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI

	$labels2 = array(
    'name' => _x( 'Media Type', 'taxonomy general name' ),
    'singular_name' => _x( 'Medium Type', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Media Type' ),
    'all_items' => __( 'All Media Type' ),
    'edit_item' => __( 'Edit Medium Type' ),
    'update_item' => __( 'Update Medium Type' ),
    'add_new_item' => __( 'Add New Medium Type' ),
    'new_item_name' => __( 'New Medium Type' ),
    'menu_name' => __( 'Media Type' ),
  );


	$labels3 = array(
		'name' => _x( 'Keywords', 'taxonomy general name' ),
    'singular_name' => _x( 'Keyword', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Keywords' ),
    'all_items' => __( 'All Keywords' ),
    'edit_item' => __( 'Edit Keyword' ),
    'update_item' => __( 'Update Keyword' ),
    'add_new_item' => __( 'Add New Keyword' ),
    'new_item_name' => __( 'New Keyword' ),
    'menu_name' => __( 'Keywords' ),
  );

	$labels4 = array(
		'name' => _x( 'Materials', 'taxonomy general name' ),
		'singular_name' => _x( 'Material', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Materials' ),
    'all_items' => __( 'All Materials' ),
    'edit_item' => __( 'Edit Material' ),
    'update_item' => __( 'Update Material' ),
    'add_new_item' => __( 'Add New Material' ),
    'new_item_name' => __( 'New Material' ),
    'menu_name' => __( 'Materials' ),
	);

	$labels5 = array(
		'name' => _x( 'Year', 'taxonomy general name' ),
		'singular_name' => _x( 'Year', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Years' ),
    'all_items' => __( 'All Years' ),
    'edit_item' => __( 'Edit Year' ),
    'update_item' => __( 'Update Year' ),
    'add_new_item' => __( 'Add New Year' ),
    'new_item_name' => __( 'New Year' ),
    'menu_name' => __( 'Years' ),	);

	$labels6 = array(
		'name' => _x( 'Works', 'taxonomy general name' ),
		'singular_name' => _x( 'Works', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Works' ),
    'all_items' => __( 'All Works' ),
    'edit_item' => __( 'Edit Works' ),
    'update_item' => __( 'Update Works' ),
    'add_new_item' => __( 'Add New Works' ),
    'new_item_name' => __( 'New Works' ),
    'menu_name' => __( 'Works' ),	);



// Now register the taxonomy

	register_taxonomy('material_list',array('artworks'), array(
    'hierarchical' => false,
    'labels' => $labels4,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'material-list' ),
  ));

	register_taxonomy('series',array('artworks'), array(
    'hierarchical' => true,
    'labels' => $labels6,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'titles' ),
  ));

	register_taxonomy('artwork_year',array('artworks'), array(
    'hierarchical' => false,
    'labels' => $labels5,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'year' ),
  ));

	register_taxonomy('media_type',array('artworks'), array(
    'hierarchical' => true,
    'labels' => $labels2,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'media-type' ),
  ));

	register_taxonomy('keywords',array('artworks'), array(
    'hierarchical' => false,
    'labels' => $labels3,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'keywords' ),
  ));


}

add_action( 'init', 'artworks_custom_taxonomy', 0 );



/**
* elenca tutti i custom fields di uno specifico gruppo
* https://dream-encode.com/acf-get-all-fields-in-a-field-group/
**/
function get_artworks_fields() {
	global $post;
	$artworks_group_id = 196; // Post ID of the artworks field group.
	$artworks_fields = array();

	$fields = acf_get_fields( $artworks_group_id );

	foreach ( $fields as $field ) {
		$field_value = get_field( $field['name'] );

		if ( $field_value && !empty( $field_value ) ) {
			$artworks_fields[$field['name']] = $field;
			$artworks_fields[$field['name']]['value'] = $field_value;
		}
	}
	return $artworks_fields;
}


?>
