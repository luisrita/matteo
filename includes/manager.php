<?php  

/**********************************************************
** Add manager and hide menus
/**********************************************************/

//more info at:
//https://developer.wordpress.org/reference/functions/add_role/
//https://developer.wordpress.org/reference/hooks/admin_menu/


$manager = add_role( 'manager', __('Manager' ), 
	array(
		'read'                  				=> true,
		'read_private_posts'						=> true,
		'read_private_pages'						=> true,
		'edit_posts'                    => true,
		'edit_published_posts'          => true,
		'edit_others_posts'							=> true,
		'edit_private_posts'						=> true,
		'delete_posts' 									=> true,
		'delete_published_posts'				=> true,
		'delete_others_posts'						=> true,
		'delete_private_posts'					=> true,
		'publish_posts'									=> true,
		'edit_pages'										=> true,
		'edit_published_pages'					=> true,
		'edit_others_pages'							=> true,
		'edit_private_pages'						=> true,
		'delete_pages'									=> true,
		'delete_published_pages'				=> true,
		'delete_others_pages'						=> true,
		'delete_private_pages'					=> true,
		'publish_pages'									=> true,
		'upload_files'									=> true,
		'edit_theme_options'						=> true,
		'manage_categories'							=> true
	)
);



function custom_remove_menus(){
		$current_user = wp_get_current_user();
		$user_id = $current_user->ID;
		$user = new WP_User( $user_id );
		if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
				if( in_array( 'manager', $user->roles ) ) {

						remove_menu_page( 'edit-comments.php' );
						remove_menu_page( 'tools.php' );
						remove_menu_page( 'options-general.php' );
						remove_submenu_page( 'themes.php', 'themes.php' );
						remove_submenu_page( 'themes.php', 'customize.php' );
						remove_submenu_page( 'themes.php', 'widgets.php' );
				}
		}
}
add_action( 'admin_menu', 'custom_remove_menus' );




function remove_customize() {
	$current_user = wp_get_current_user();
	$user_id = $current_user->ID;
	$user = new WP_User( $user_id );
	if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
		if( in_array( 'manager', $user->roles ) ) {
	    $customize_url_arr = array();
	    $customize_url_arr[] = 'customize.php'; // 3.x
	    $customize_url = add_query_arg( 'return', urlencode( wp_unslash( $_SERVER['REQUEST_URI'] ) ), 'customize.php' );
	    $customize_url_arr[] = $customize_url; // 4.0 & 4.1
	    if ( current_theme_supports( 'custom-header' ) && current_user_can( 'customize') ) {
	        $customize_url_arr[] = add_query_arg( 'autofocus[control]', 'header_image', $customize_url ); // 4.1
	        $customize_url_arr[] = 'custom-header'; // 4.0
	    }
	    if ( current_theme_supports( 'custom-background' ) && current_user_can( 'customize') ) {
	        $customize_url_arr[] = add_query_arg( 'autofocus[control]', 'background_image', $customize_url ); // 4.1
	        $customize_url_arr[] = 'custom-background'; // 4.0
	    }
	    foreach ( $customize_url_arr as $customize_url ) {
	        remove_submenu_page( 'themes.php', $customize_url );
	    }
	   }
	}
}
add_action( 'admin_menu', 'remove_customize', 999 );

?>