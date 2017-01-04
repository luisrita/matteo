<?php
/*
Template Name: Search Page
*/
?>

<?php get_header(); ?>

<?php 

	global $query_string;
	$query_args = explode("&", $query_string);

	foreach($query_args as $key => $string):
		$query_split = explode("=", $string);
	endforeach;

	$s = urldecode($query_split[1]);

	//search general fields on all post types
	$args = array( 
		'posts_per_page' => -1,
		'post_status' => 'publish',
		's'              => $s,
		'post_type'      => array( 'page', 'event', 'program', 'news' )
	);
	$q1 = new WP_Query( $args );

	//search custom fields on all pages
	$args = array(
        'post_type' => 'page',
        'post_status' => 'publish',
        'meta_query' => array(
			'relation' => 'OR',
			array(
				'key'     => 'president_intro',
				'value'   => $s,
				'compare' => 'LIKE',
			),
			array(
				'key'     => 'about_us',
				'value'   => $s,
				'compare' => 'LIKE',
			),
			array(
				'key'     => 'friends_intro',
				'value'   => $s,
				'compare' => 'LIKE',
			),
			array(
				'key'     => 'board',
				'value'   => $s,
				'compare' => 'LIKE',
			),
			array(
				'key'     => 'top_text',
				'value'   => $s,
				'compare' => 'LIKE',
			),
			array(
				'key'     => 'top_text_bold',
				'value'   => $s,
				'compare' => 'LIKE',
			)
		),
	);
	$q2 = new WP_Query( $args );

	//search custom fields on all events
	$args = array(
        'post_type' => 'event',
        'post_status' => 'publish',
        'meta_query' => array(
			'relation' => 'OR',
			array(
				'key'     => 'subtitulo',
				'value'   => $s,
				'compare' => 'LIKE',
			),
			array(
				'key'     => 'index_subtitle',
				'value'   => $s,
				'compare' => 'LIKE',
			),
			array(
				'key'     => 'program_legend',
				'value'   => $s,
				'compare' => 'LIKE',
			),
			array(
				'key'     => 'technical_area',
				'value'   => $s,
				'compare' => 'LIKE',
			),
			array(
				'key'     => 'description',
				'value'   => $s,
				'compare' => 'LIKE',
			),
			array(
				'key'     => 'localization',
				'value'   => $s,
				'compare' => 'LIKE',
			)
		),
	);
	$q3 = new WP_Query( $args );

	$merged = array_merge( $q1->posts, $q2->posts, $q3->posts );

	$post_ids = array();
	foreach( $merged as $item ):
	    $post_ids[] = $item->ID;
	endforeach;
	$unique = array_unique($post_ids);

?>

<div class="search-page">

	<div class="page-header">
		<h2><?php echo $s; ?></h2>
		<h4><?php printf( __('%s resultados foram encontrados para "%s"'), count($unique), $s); ?>
	</div>
	

	<?php 
		

		if( count($unique) > 0 ):

			echo '<ul>';

			foreach ($unique as $postID):
				$postType = get_post_type($postID);

				switch($postType):
					case 'page':
						echo '<li>';
						echo '<div class="wrapper">';
						echo '<hr class="top-separator">';
						echo '<h1>' . get_the_title($postID) . '</h1>';
						echo '<hr class="middle-separator">';
						echo '<h3>' . __('página', 'fundacao-luso-brasileira') . '</h3>';
						echo '<a href="' . get_the_permalink($postID) . '" class="icon-plus"></a>'; 
						echo '</div>';
						echo '</li>';
						break;

					case 'event':
						echo '<li>';
						echo '<div class="wrapper">';
						echo '<hr class="top-separator">';
						echo '<h1>' . get_the_title($postID) . '</h1>';
						echo '<h2>' . get_field('subtitulo', $postID) . '</h2>';
						echo '<hr class="middle-separator">';
						echo '<h3>' . __('evento', 'fundacao-luso-brasileira') . '</h3>';
						echo '<a href="' . get_the_permalink($postID) . '" class="icon-plus"></a>'; 
						echo '</div>';
						echo '</li>';
						break;

					case 'program':
						echo '<li>';
						echo '<div class="wrapper">';
						echo '<hr class="top-separator">';
						echo '<h1>' . get_the_title($postID) . '</h1>';
						echo '<hr class="middle-separator">';
						echo '<h3>' . __('programa', 'fundacao-luso-brasileira') . '</h3>';
						echo '<a href="' . get_the_permalink($postID) . '" class="icon-plus"></a>'; 
						echo '</div>';
						echo '</li>';
						break;

					case 'news':
						echo '<li>';
						echo '<div class="wrapper">';
						echo '<hr class="top-separator">';
						echo '<h1>' . get_the_title($postID) . '</h1>';
						echo '<hr class="middle-separator">';
						echo '<h3>' . __('notícia', 'fundacao-luso-brasileira') . '</h3>';
						echo '<a href="' . get_the_permalink($postID) . '" class="icon-plus"></a>'; 
						echo '</div>';
						echo '</li>';
						break;

				endswitch;

			endforeach;

			echo '</ul>';

		endif;

	?>

	</div>
</div>

<?php get_footer(); ?>