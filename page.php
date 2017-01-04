<?php

/**
 * 	Template Name: Default
 */

global $post;
$id = $post->ID;
$content = apply_filters('the_content', $post->post_content);

get_header();

?>

<?php 
  $args = array(
    'post_type' => 'projects',
    'orderby'=> 'DESC',
    'post_status' =>'publish'
  );
  $query = new WP_Query( $args );
?>

<?php if ($query->have_posts()): ?>
  <ul class="projects-wrapper">
    <?php while($query->have_posts()): ?>
      <?php global $post; ?>
      <?php $query->the_post(); ?>

      <li class="project">
        <figure class="project__image">
          <img src="<?php the_field('image'); ?>" />
        </figure>
        <h3 class="project__title"><?php echo $post->post_title; ?></h3>
        <p class="project__description"><?php echo $post->post_content; ?></p>
      </li>

    <?php endwhile; ?>
    <a href="#" class="project__nav project__nav--prev js-prev"></a>
    <a href="#" class="project__nav project__nav--next js-next"></a>
  </ul>
<?php endif; ?>

<?php wp_reset_postdata(); ?>

<?php get_footer(); ?>