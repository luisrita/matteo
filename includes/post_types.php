<?php 

//more info: https://codex.wordpress.org/Function_Reference/register_post_type
function create_post_type() {

	register_post_type( 'projects',
		array(
			'labels' => array(
				'name' => __( 'Projects' ),
				'singular_name' => __( 'Project' ),
				'add_new' => __( 'New Project' ),
				'add_new_item' => 'Add New Project',
				'edit_item' => 'Edit Project'
			),
			'public' => true,
			'has_archive' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'project'),
			'supports' => array(
				'title',
				'editor',
				'thumbnail'
			)
		)
	);

	flush_rewrite_rules( true );

}    
add_action( 'init', 'create_post_type' );


// *******************************************************************************  
// DONT'ADD SELECTED CATS TO TOP | PRESERVE CATS TREE ****************************
// *******************************************************************************
add_filter( 'wp_terms_checklist_args', 'bschaf_wp_terms_checklist_args', 1, 2 );
function bschaf_wp_terms_checklist_args( $args, $post_id ) {
   $args[ 'checked_ontop' ] = false;
   return $args;
}

?>