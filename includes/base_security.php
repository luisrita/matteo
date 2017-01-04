<?php 

/**********************************************************
** Remove adminbar from top
/**********************************************************/
add_filter('show_admin_bar', '__return_false');


/**********************************************************
** Remove head unnecessary tags
/**********************************************************/
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'wp_shortlink_wp_head');

//remove REST API
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );


//remove feed links
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );



/**********************************************************
** Change admin title
/**********************************************************/
function change_title_on_logo() {
	return get_bloginfo( 'name' );
}
add_filter('login_headertitle', 'change_title_on_logo');



/**********************************************************
** Customization of login page logo
/**********************************************************/
function custom_login_logo() {

	$custom_logo = get_template_directory_uri() .'/assets/images/m-logo.png';

	echo '<style type="text/css">
	body.login{background:#fff;}
	h1 a { background-image:url('. $custom_logo .') !important; height: auto !important; min-height: 79px !important; width: 80px !important; background-size: contain !important;} </style>';
}

add_action('login_head', 'custom_login_logo');


/**********************************************************
** Remove Wordpress version
/**********************************************************/
remove_action('wp_head', 'wp_generator');
function wpt_remove_version() {
	 return '';
}
add_filter('the_generator', 'wpt_remove_version');


/**********************************************************
** Disable xmlrpc - security reasons
/**********************************************************/
add_filter('xmlrpc_enabled', '__return_false');


/**********************************************************
** Remove emojis 
/**********************************************************/
function disable_emojicons_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
	return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
	return array();
	}
}

function disable_wp_emojicons() {
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' ); 
?>