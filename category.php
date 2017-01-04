<?php 

get_header(); 
$currentTerm = get_queried_object(); 

//$ancestors = get_ancestors( $id, 'category' );

$categories = get_categories( 
	array(
    'exclude' => array($currentTerm->term_id)
	)
);

$ancestors = array( (int)get_field('about_us_page', 'options') );
array_push($ancestors, $currentTerm->term_id);


?>

<section class="posts-archive">
	
	<div class="wrapper">

		<?php getBurelBreadcrumbs($ancestors, true); ?>
		
		
		<div class="row">
				<h1 class="posts-archive__title"><?php echo $currentTerm->name; ?></h1>
		</div>

		<div class="row">

			<div class="col s5 offset-s1">
				<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<article class="posts-archive__item">
							<a href="<?php echo get_permalink( $post->ID ); ?>">
								
								<?php if ( has_post_thumbnail() ): ?>
									<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'posts-archive__item-image' ) ); ?>
								<?php endif; ?>
								<h3 class="posts-archive__item-title">
									<time><?php the_field('start_date', $post->ID); ?></time>
									<?php the_title(); ?>
										
								</h3>
								<div class="posts-archive__item-content"><?php the_excerpt(); ?></div>

							</a>
						</article>

					<?php endwhile; ?>

				<?php endif; ?>

				<?php wp_reset_postdata(); ?>

			</div>

			<div class="col s4 offset-s1">
				
				<?php foreach ($categories as $category): ?>
					<h2 class="posts-archive__others-title">
						<?php echo $category->name; ?> 
						<a class="posts-archive__others-link" href="<?php echo get_category_link($category->term_id); ?>">
							<?php pll_e('read more', 'burel'); ?>
						</a>
					</h2>

					<?php

						$args = array(
							'posts_per_page' => 3,
							'cat' => $category->term_id,
							'meta_query' => array(
								'relation' => 'OR',
								array( //check to see if date has been filled out
									'key' => 'start_date',
									'compare' => '>=',
									'value' => date('Ymd')
							   ),
							  array( //if no date has been added show these posts too
									'key' => 'start_date',
									'value' => date('Ymd'),
									'compare' => 'NOT EXISTS'
							   )
							),
							'meta_type' => 'DATE',
							'orderby' => 'meta_value',
							'order' => 'DESC'
						); 

						$query = new WP_Query( $args );

						if ( $query->have_posts() ):
							while ( $query->have_posts() ): $query->the_post();

					?>
							<article class="posts-archive__item">
								<a href="<?php echo get_permalink( $post->ID ); ?>">
									<h4 class="posts-archive__item-title-small">
										<?php if (get_field('start_date', $post->ID)): ?>
											<time><?php the_field('start_date', $post->ID); ?></time>
										<?php endif; ?>
										<?php the_title(); ?>
									</h4>
								</a>
							</article>

					<?php  
							endwhile;
						endif;
					?>

				<?php endforeach; ?>

			</div>

		</div>

	</div>

</section>

<?php get_footer();
