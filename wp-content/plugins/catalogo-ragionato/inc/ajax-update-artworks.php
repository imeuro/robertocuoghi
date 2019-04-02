<?php
add_action( 'admin_enqueue_scripts', 'enqueue_artworks_js' );
function enqueue_artworks_js() {
	wp_enqueue_script( 'ajax-script', plugins_url( '/ajax-update-artworks.js', __FILE__ ), array('jquery') );
}
function update_artworks_submenu_page_callback() {
  echo '<div class="wrap">';
  echo '<h1>update artworks (very beta!)</h1>';


	echo '<div class="card">';
	echo '<h2>Update artworks DATA:</h2>';
	if ($_SERVER['HTTP_HOST'] != 'www.roberto-cuoghi.com') {
		echo '<h4>Hey, un attimo di attenzione!<br>Stai per aggiornare i dati del catalogo da un file CSV!</h4>';
		if(function_exists( 'wp_enqueue_media' )) {
	    wp_enqueue_media();
		} else {
	    wp_enqueue_style('thickbox');
	    wp_enqueue_script('media-upload');
	    wp_enqueue_script('thickbox');
		}
		echo '<strong>Carica il file CSV:</strong><br />';

		echo '<input class="custom_media_url" type="text" name="attachment_url" value="">';
		echo '&nbsp;&nbsp;<a href="#" class="custom_media_upload button">Scegli file</a>';

		echo '<div class="custom_media_file" style="display:none;"></div>';
		echo '<br /><br /><button id="startbutton" class="button button-primary" disabled="disabled">Sei sicuro?</button>';
	} else {
		echo '<h4>Volevi aggiornare il db direttamente in produzione?</h4>';
		echo '<p>sicuramente ti sarai sbagliato!</p>';
	}
	echo '</div>';

	echo '<br>';
	echo '<div id="insert-result"></div><br>';

	echo '<table id="run_update_content" class="wp-list-table widefat striped tags" style="max-width: 100%; overflow-x: scroll; display: block;">';
	echo '<tr id="loading" style="display:none; text-align: center;"><td><p>Aggiornamento contenuti in corso...</p></td></tr>';
	echo '</table>';

  echo '</div>';

}


add_action('wp_ajax_run_update', 'run_update_callback');
function run_update_callback() {
	// Set path to CSV file
	$csvFile = $_POST['file'];
	$csv = readCSV($csvFile);

	/* debug
	echo '<pre>';
	foreach ($csv[0] as $csvfield) {
		echo $csvfield.'<br>';
	}
	print_r($csv);
	echo '</pre>';
	die();
	*/

	$i = 0;

	foreach ($csv as $csvitem) {

		if ($i == 0) {
			echo '<thead>';
			echo '<tr>';

			echo '<th scope="col" id="ID" class="manage-column column-name column-primary"><span>ID</span></th>';
			foreach ($csv[0] as $csvfield) {
				echo '<th scope="col" id="'.$csvfield.'" class="manage-column column-name column-primary"><span>'.$csvfield.'</span></th>';
			}
			echo '<th scope="col" id="result" class="manage-column column-name column-primary"><span>RESULT</span></th>';

			echo '</tr>';
			echo '</thead>';
			echo '<tbody>';
		}
		if ($i > 0) {
			$n = 0;
			echo '<tr>';
			// INSERT OR UPDATE?
			// look for a specific custom field with unique value, if there is a post with that value already, find its $post_id
			global $post;
			$val = $csvitem[0]; // the unique field : art_code
			$args = array(
				'numberposts'	=> 1,
				'post_type'		=> 'artworks',
				'meta_key'		=> 'art_code',
				'meta_value'	=> $val,
				'post_status' => 'any'
			);
			$chkposts = new WP_Query( $args );
			echo '<td>';
			if( $chkposts->have_posts() ):
				while( $chkposts->have_posts() ) : $chkposts->the_post();
					setup_postdata($post);
					echo $post->ID;
				endwhile;

				// add the post_id key/val to the array
				// so wp_insert_post knows wether to just update the post data
				$csvitem['ID'] = $post->ID;

			else:
				echo 'new!';
				//$csvitem['post_id'] = '0';
			endif;
			$csvitem['post_type'] = 'artworks';
			$csvitem['post_status'] = 'publish';
			echo '</td>';
			wp_reset_postdata();

			// Print all other values on screen
			foreach ($csv[0] as $csvfield) {
				$csvitem[$csvfield] = $csvitem[$n];
				//echo '$csvitem['.$csvfield.'] = $csvfield$csvitem['.$n.']<br>';
				unset($csvitem[$n]);
				echo '<td>'.$csvitem[$csvfield].'</td>';
				$n++;
			}


			// Update the post into the database (!)
			$post_id = wp_insert_post( $csvitem, true );

			if ( !is_wp_error($post_id) ) {
			}


			if (is_wp_error($post_id)) {
					$errors = $post_id->get_error_codes();
					foreach ($errors as $error) {
						echo '<td class="result result-error"><b style="color:#f00">'.$error.'</b> <small><a href="edit.php?s=%22'.$csvitem['art_code'].'%22&post_status=all&post_type=artworks" target="_blank"  class="dashicons dashicons-search" alt="locate artwork by art_code">&nbsp</a></td>';
					}
			} else {
					echo '<td class="result result-ok"><b>aggiornato!</b><br>';
					//insert custom fields
					foreach ($csvitem as $key => $csvalue) {
						if ( $csvalue && $csvalue !== '') {
							if (strpos($key, 'art_') === 0) {
								handle_post_meta($post_id,$key,$csvalue);
								if ($key == 'art_imgref') {
									// time to import images!!
									$arr_img = explode(',', $csvalue);
									foreach ($arr_img as $key => $imgname) {
										$imgname = str_replace( '/', '', strtolower($imgname) );
										if ($key == 0) {
											$isfeat = 'true';
										} else { $isfeat= 'false'; }
										$file_url = get_site_url().'/out/'.$imgname.'.jpg';
										echo '$arr_img -> $key: '.$key.' - $file_url: '.$file_url.' - $isfeat:'.$isfeat.'<br>';

										// import media only if jpg file is present in /out folder (http=200)
										$array = get_headers($file_url);
										if(strpos($array[0],"200")) {
											// AND $imgname not already attached to post -> spostato in fetch_media
									    fetch_media($file_url, $post_id, $isfeat);
									  } else {
											echo '<strong>Warning: image not found!</strong>';
										}


									}
								}
							}
							//insert taxonomies
							else if(strpos($key, 'tax_') === 0) {
								//echo "taxxxxx";
								if(substr($key, -3) == '_l1') {
									$parent_tax = str_replace('_l1','',$key);
									$parent_tax = str_replace('tax_','',$parent_tax);
									//print_r($csvitem);
									//echo '<br>lev_1.1: $post_id: '.$post_id.' $parent_tax: '.$parent_tax;
									$term_list = wp_get_post_terms($post_id, $parent_tax, array("fields" => "all"));
									//echo '<br>lev_1.2: $term_list: ';
									//print_r($term_list);
									// die();
									$parent_term_id = $term_list[0]->term_id ;
									//echo '<br>lev_1.3: $parent_term_id: '.$parent_term_id;

									//echo '<br>lev_1.4';
								} else {
									$parent_tax = '0';
									$parent_term_id = '0';
								}
								//echo '<br>Final (pre-action):<br>$post_id: '.$post_id.'<br>$key :'.$key.'<br>$csvalue :'.$csvalue.'<br>$parent_term: '.$parent_term.'<br>$parent_term_id:'.$parent_term_id.'<br><br>';

								handle_taxonomy($post_id,$key,$csvalue,$parent_tax,$parent_term_id);
								//echo '<br>.........<br>.........<br><br><br>';
							}
						}
					}

					echo '<small><a href="post.php?post='.$csvitem['ID'].'&action=edit" target="_blank" class="dashicons dashicons-visibility" alt="wiew artwork entry">&nbsp</a></small></td>';
			}
			echo '</tr>';
			/*
			echo '<tr><td colspan="32">';
			echo '<pre>debug:<br>';
			print_r($csvitem);
			echo '</pre>';
			echo '</td></tr>';
			*/
		}

		$i++;
	}

	echo '</tbody>';
}


function readCSV($csvFile){
		$file_handle = fopen($csvFile, 'r');
		while (!feof($file_handle) ) {
				$line_of_text[] = fgetcsv($file_handle, 1024);
		}
		fclose($file_handle);
		return $line_of_text;
}

function my_theme_custom_upload_mimes( $existing_mimes ) {
	// add webm to the list of mime types
	$existing_mimes['csv'] = 'text/csv';
	// return the array back to the function with our added mime type
	return $existing_mimes;
}
add_filter( 'mime_types', 'my_theme_custom_upload_mimes' );



function handle_post_meta( $post_id, $field_name, $value = '' ) {
  if ( empty( $value ) OR ! $value ) {
    delete_post_meta( $post_id, $field_name );
  } elseif ( ! get_post_meta( $post_id, $field_name ) ) {
    add_post_meta( $post_id, $field_name, $value );
  } else {
    update_post_meta( $post_id, $field_name, $value );
  }
}



function handle_taxonomy( $post_id, $tax_name, $term_value, $tax_parent, $tax_parent_id ) {
		// echo '<br><br>Final (post-action):<br>';
		// echo '$tax_parent_id='.$tax_parent_id;
		///echo '$tax_parent='.$tax_parent;
		$tax_clean_name = str_replace('tax_','',$tax_name);
		if ($tax_parent != '0') {
			$tax_clean_name = $tax_parent;
		}
		if ( empty( $term_value ) OR ! $term_value ) { // se campo term vuoto
			// remove eventuali values
			// ...
		} else { // se campo term compilato
			// spezzetto a ogni virgola
			$arr_term_value = explode(',', $term_value);
			// check se esistono già i terms:
			foreach($arr_term_value as $single_term_value) {

				$existent_term = term_exists( $single_term_value, $tax_clean_name );

				if ( $existent_term && isset($existent_term['term_id']) ) {
		        $term_id = $existent_term['term_id'];
		    } else {
	        //insert the term if it doesn't exsit
					$single_term_value = wp_insert_term(
						$single_term_value, // the term
						$tax_clean_name, // the taxonomy
						array(
							'parent' => $tax_parent_id // the parent
						)
					);

	        if( !is_wp_error($single_term_value ) && isset($single_term_value['term_id']) ) {
						$term_id = $single_term_value['term_id'];
	        }
		   	}

				//Fill the array of terms for later use on wp_set_object_terms
				$terms[] = (int) $term_id;

		 	}

			wp_set_object_terms( $post_id, $terms, $tax_clean_name );

			// NOTE: should i set the parent term, too?
			// REPLY: no because it will remove the post from the child term!!!

		}
}


/* Import media from url
 *
 * @param string $file_url URL of the existing file from the original site
 * @param int $post_id The post ID of the post to which the imported media is to be attached
 *
 * @return boolean True on success, false on failure
 */

function fetch_media($file_url, $post_id, $featured='false') {
	require_once(ABSPATH . 'wp-load.php');
	require_once(ABSPATH . 'wp-admin/includes/image.php');
	global $wpdb;

	if(!$post_id) {
		return false;
	}

	//directory to import to
	$artDir = 'wp-content/uploads/importedmedia/';

	//if the directory doesn't exist, create it
	if(!file_exists(ABSPATH.$artDir)) {
		mkdir(ABSPATH.$artDir);
	}

	//rename the file... alternatively, you could explode on "/" and keep the original file name
	$ext = array_pop(explode(".", $file_url));
	$filename = sanitize_title_with_dashes(str_replace($ext,'',array_pop(explode("/", $file_url))));
	echo 'img: '.$filename.'.'.$ext.'<br>';
	$new_filename = $post_id.'_'.$filename.'.'.$ext; //if your post has multiple files, you may need to add a random number to the file name to prevent overwrites

	if (@fclose(@fopen($file_url, "r"))) { //make sure the file actually exists
		copy($file_url, ABSPATH.$artDir.$new_filename);

		$siteurl = get_option('siteurl');
		$file_info = getimagesize(ABSPATH.$artDir.$new_filename);

		//create an array of attachment data to insert into wp_posts table
		$artdata = array();
		$artdata = array(
			'post_author' => 1,
			'post_date' => current_time('mysql'),
			'post_date_gmt' => current_time('mysql'),
			'post_title' => $new_filename,
			'post_status' => 'inherit',
			'comment_status' => 'closed',
			'ping_status' => 'closed',
			'post_name' => sanitize_title_with_dashes(str_replace("_", "-", $new_filename)),
			'post_modified' => current_time('mysql'),
			'post_modified_gmt' => current_time('mysql'),
			'post_parent' => $post_id,
			'post_type' => 'attachment',
			'guid' => $siteurl.'/'.$artDir.$new_filename,
			'post_mime_type' => $file_info['mime'],
			'post_excerpt' => '',
			'post_content' => ''
		);

		$uploads = wp_upload_dir();
		$save_path = $uploads['basedir'].'/importedmedia/'.$new_filename;

		// check se immagine gia presente come attachment
		$cur_img_situa = get_attached_media( 'image',$post_id );
		$imgalready='false';
		foreach ($cur_img_situa as $image_situa) :
			echo '$image_situa->post_title:'.$image_situa->post_title.' - ';
			if ($image_situa->post_title == $new_filename) {
				$imgalready='true';
			}
		endforeach;
		echo '<br>image already present: '.$imgalready.'<br>';

		if ($imgalready=='false') {
			//insert the database record
			$attach_id = wp_insert_attachment( $artdata, $save_path, $post_id );

			//generate metadata and thumbnails
			if ($attach_data = wp_generate_attachment_metadata( $attach_id, $save_path)) {
				wp_update_attachment_metadata($attach_id, $attach_data);
			}

			//optional make it the featured image of the post it's attached to
			if ($featured == 'true') {
				$rows_affected = $wpdb->insert($wpdb->prefix.'postmeta', array('post_id' => $post_id, 'meta_key' => '_thumbnail_id', 'meta_value' => $attach_id));
			}
		}

	}
	else {
		return false;
	}

	return true;
}
?>
