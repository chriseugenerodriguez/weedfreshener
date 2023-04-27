<?php /* Template Name: Form */ ?>
<?php get_header(); ?>

<div class="row paddingtop greybg">
  <section class="container">
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <?php the_content(); ?>
    <?php endwhile; // end of the loop. ?>
  </section>

<?php get_footer(); ?></div>