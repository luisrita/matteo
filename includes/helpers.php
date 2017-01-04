<?php 

if ( ! function_exists( 'getBurelBreadcrumbs' ) ){

	function getBurelBreadcrumbs($ancestorsID, $paddingTop = ''){

		$breadcrumbs = array();
		$count = count($ancestorsID);
		$k = 1;
		$paddingTop ? $xtraClass = ' top-padded' : $xtraClass = ''; 


		foreach ( $ancestorsID as $id):

			if (is_page($id) || is_single($id) ):

				if ( $k == $count):
					array_push($breadcrumbs, '<span class="current-breadcrumb">'.get_the_title($id).'</span>');
				else:
					array_push($breadcrumbs, '<a href="'.get_permalink( $id ).'">'.get_the_title($id).'</a>');
				endif;

			elseif ( term_exists( $id, 'faqtax') ):

				$term = get_term_by('id', $id, 'faqtax');
			
				if ( $k == $count):
					array_push($breadcrumbs, '<span class="current-breadcrumb">'.$term->name.'</span>');
				else:
					array_push($breadcrumbs, '<a href="'.get_term_link( $id ).'">'.$term->name.'</a>');
				endif;

			elseif ( get_term_by('id', $id, 'category') ):

				$term = get_term_by('id', $id, 'category');

				if ( $k == $count):
					array_push($breadcrumbs, '<span class="current-breadcrumb">'.$term->name.'</span>');
				else:
					array_push($breadcrumbs, '<a href="'.get_term_link( $id ).'">'.$term->name.'</a>');
				endif;

			endif;

			$k++;

		endforeach;

		echo '<nav class="breadcrumbs'.$xtraClass.'"><a href="' . site_url(). '">' . __('home', 'burel') . '</a><span class="sep">/</span>'.implode('<span class="sep">/</span>', $breadcrumbs).'</nav>';
	}

}


if ( ! function_exists( 'shareBurelContent' ) ){

	function shareBurelContent($id, $sidebar = false){

		$url = get_permalink($id);
		$title = get_the_title($id);
		$sidebar ? $s = ' sidebar' : $s = '';

		$html = '';
		$html .= '<div class="row share-module'.$s.'">';
		$html .= '<span>'.pll__('Share').'</span>';
		$html .= '<a href="//www.facebook.com/sharer/sharer.php?u='.$url.'">'.insertIcon('icon-facebook').'</a>';
		$html .= '<a href="//twitter.com/home?status='.$url.' '.$title.'">'.insertIcon('icon-twitter').'</a>';
		$html .= '<a href="//plus.google.com/share?url='.$url.'">'.insertIcon('icon-google-plus').'</a>';
		$html .= '<a href="//www.linkedin.com/shareArticle?mini=true&url='.$url.'&title='.$title.'">'.insertIcon('icon-linkedin').'</a>';
		$html .= '</div>';

		return $html;
	}
}



use InlineSvg\Collection;
use InlineSvg\Sources\FileSystem;

if ( ! function_exists( 'insertIcon' ) ){
	function insertIcon($icon){

		$svgFolder = get_template_directory_uri();
		$symbol = '../assets/images/svg/';
		$source = new FileSystem(get_template_directory() . '/assets/images/svg');
		$icons = new Collection($source);

		return $icons->get($icon); // <svg ... </svg>
	}
}



?>