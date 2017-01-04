<?php

/**********************************************************
** Register menus
/**********************************************************/

//more info at: https://developer.wordpress.org/reference/functions/register_nav_menus/
function register_my_menus() {
	register_nav_menus(
		array(
			'top_menu' => __('Top Menu'),
			'help_menu' => __('Help Menu'),
			'about_menu' => __('About Menu')
		)
	);
}
add_action( 'init', 'register_my_menus' );



/**********************************************************
** Markup para o submenu
/**********************************************************/

class Sublevel_Walker extends Walker_Nav_Menu{
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent<div class='wrap wrap".($depth+1)."'><ul class='sub-menu'>";
			
	}
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul></div>";
	}
}


?>