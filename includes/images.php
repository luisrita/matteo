<?php

/**********************************************************
**Remove images size
/**********************************************************/

//stop generating images with the medium and large sizes
//more info: https://developer.wordpress.org/reference/hooks/intermediate_image_sizes_advanced/
function filter_image_sizes( $sizes) {
	unset( $sizes['medium']);
	unset( $sizes['large']);
	return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'filter_image_sizes');


/**********************************************************
** Add images size
/**********************************************************/
function my_image_sizes_setup() {
	add_image_size( 'gallery-thumb', 193, 193, true );
	add_image_size( 'square-block', 372, 372, true );
	add_image_size( 'stores', 241, 502, true );
	add_image_size( 'product', 636, 851, true );
	add_image_size( 'product-cover', 505, 505, true );
}
add_action( 'after_setup_theme', 'my_image_sizes_setup' );


function my_image_sizes($sizes) {
	$addsizes = array(
		"gallery-thumb" => __( "Gallery Thumb")
	);
	$newsizes = array_merge($sizes, $addsizes);
	return $newsizes;
}
add_filter('image_size_names_choose', 'my_image_sizes');



/**********************************************************
** Add SVG support
/**********************************************************/
class svg_support {

	public function __construct() {
		$this->_add_filters();
	}

	private function _add_filters() {
		add_filter( 'upload_mimes', array( &$this, 'allow_svg_uploads' ) );
	}

	public function allow_svg_uploads( $existing_mime_types = array() ) {
		return $this->_add_svg_mime_type( $existing_mime_types );
	}

	private function _add_svg_mime_type( $mime_types ) {
		$mime_types[ 'svg' ] = 'image/svg+xml';

		return $mime_types;
	}

}


function svg_support_run() {
	if (class_exists('svg_support')) {
		new svg_support();
	}
}
add_action('after_setup_theme', 'svg_support_run');




/**********************************************************
** Change WP Standart Gallery
/**********************************************************/
function customFormatGallery($string,$attr){

    $posts = get_posts(array('include' => $attr['ids'],'post_type' => 'attachment'));
    $limit = 5;
    $count = count($posts);
    $k = 0;


    $output = '<div class="gallery" data-control="GALLERY">';
    
    foreach($posts as $imagePost){
      $k++;
      if ( $k == $limit ){
		    if ( $count > $limit):
      		$output .= '<a href="#" class="gallery-item" data-id="'.$imagePost->ID.'">';
      		$output .= '<img class="gbox" src="'.wp_get_attachment_image_src($imagePost->ID, 'full')[0].'">';
      		$output .= '<span class="gradient"></span>';
      		$output .= '<span class="count">+'.( $count - $limit ).'</span>';
      		$output .= '</a>';
      	else:
      		$output .= '<a href="#" class="gallery-item" data-id="'.$imagePost->ID.'">';
      		$output .= '<img class="gbox" src="'.wp_get_attachment_image_src($imagePost->ID, 'full')[0].'"></a>';
      		$output .= '</a>';

      	endif;

      } else if ( $k < $limit ){
      	$output .= '<a href="#" class="gallery-item" data-id="'.$imagePost->ID.'">';
    		$output .= '<img class="gbox" src="'.wp_get_attachment_image_src($imagePost->ID, 'full')[0].'"></a>';
    		$output .= '</a>';
      } else {
      	$output .= '<a href="#" class="gallery-item hidden" data-id="'.$imagePost->ID.'">';
    		$output .= '<img class="gbox" src="'.wp_get_attachment_image_src($imagePost->ID, 'full')[0].'"></a>';
    		$output .= '</a>';
      }
    }

    $output .= "</div>";

    return $output;
}
add_filter('post_gallery','customFormatGallery',10,2);

?>