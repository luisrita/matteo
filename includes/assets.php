<?php

/* ********************************************************
** Load js, css and fonts
******************************************************** */
function my_init_method() {
		
	if (!is_admin()) {

		//load compiled site style and fonts
		wp_enqueue_style( 'general', get_template_directory_uri()."/assets/css/style.css" );
		wp_enqueue_style('montserrat', "//fonts.googleapis.com/css?family=Montserrat:400,700");

		//Let's load our own versions
		wp_deregister_script( 'jquery' );
		wp_deregister_script( 'wp-embed' );

		wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js', false, '2.1.4' );
		wp_enqueue_script( 'main', get_template_directory_uri()."/assets/javascript/main.min.js", array( 'jquery' ), '1', 'true' );	

	}
}
add_action('wp_enqueue_scripts', 'my_init_method');


/* ********************************************************
** Clean up output of stylesheet <link> tags
******************************************************** */
function clean_style_tag($input)
{
    preg_match_all("!<link rel='stylesheet'\s?(id='[^']+')?\s+href='(.*)' type='text/css' media='(.*)' />!", $input, $matches);
    // Only display media if it's print
    $media = $matches[3][0] === 'print' ? ' media="print"' : '';
    return '<link rel="stylesheet" href="' . $matches[2][0] . '"' . $media . '>' . "\n";
}
add_filter('style_loader_tag', 'clean_style_tag');


?>
