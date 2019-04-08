<?php

$list_series_args = array(
	'taxonomy' 	=> 'series',
	'title_li' 	=> '<h2>ARTWORKS</h2>',
	'hierarchical' => true,
	'orderby'		=> 'slug',
	'exclude_tree'		=> 	430	// childs of 'non-categories'
);
$list_series_noncats_args = array(
	'taxonomy' 	=> 'series',
	'title_li' 	=> '<span class="hidden">aggregates</span>',
	'hierarchical' => true,
	'orderby'		=> 'slug',
	'child_of'		=> 	430	// childs of 'non-categories'
);

$list_media_args = array(
	'taxonomy' => 'media_type',
	'title_li' => '<h2>MEDIA</h2>',
	'hierarchical' => true,
);

$list_year_args = array(
	'taxonomy' => 'artwork_year',
	'title_li' => '<h2>YEARS</h2>',
	'hierarchical' => false,
);
wp_list_categories( $list_series_args );
wp_list_categories( $list_series_noncats_args );
wp_list_categories( $list_media_args );
wp_list_categories( $list_year_args );
?>
