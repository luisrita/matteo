<?php

/**
 * Require Composer autoloader if installed on it's own
 */
if (file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
  require_once $composer;
}



/**********************************************************
** Includes
/**********************************************************/
$includes_path = TEMPLATEPATH . '/includes/';

/* comment delete lines if not needed */

//load basic filters and security for wordpress
require_once $includes_path . 'base_security.php';

//include styles and js
require_once $includes_path . 'assets.php';

//create and manage menus
require_once $includes_path . 'menus.php';

//create and manage images
require_once $includes_path . 'images.php';

//include custom post types and custom taxonomies
require_once $includes_path . 'post_types.php';

//include the "Manager" role - user with back-office capability but with less permissions than the Administrator
require_once $includes_path . 'manager.php';

//include the "Manager" role - user with back-office capability but with less permissions than the Administrator
require_once $includes_path . 'acf.php';

//include the "Manager" role - user with back-office capability but with less permissions than the Administrator
require_once $includes_path . 'helpers.php';


/**********************************************************
** Register Sidebars
/**********************************************************/
function createSidebars(){
  register_sidebar( 
    array(
        'name'         => __( 'Language' ),
        'id'           => 'sidebar-1',
        'description'  => __( 'A sidebar to insert a language switcher widget' ),
        'before_widget' => '<div>',
        'after_widget'  => '</div>'
    ) 
  );

  register_sidebar( 
    array(
        'name'          => __( 'Mailchimp' ),
        'id'            => 'sidebar-2',
        'description'   => __( 'A sidebar to insert a Mailchimp form' ),
        'before_widget' => '<div>',
        'after_widget'  => '</div>'
    ) 
  );
}
add_action( 'init', 'createSidebars' );


add_filter('tiny_mce_before_init', 'tiny_mce_remove_unused_formats' );

function tiny_mce_remove_unused_formats($init) {
	$init['block_formats'] = 'Paragraph=p;Heading 3=h3;Heading 4=h4;Heading 5=h5';
	return $init;
}





?>