<?php get_header();?>

<div id="container" class="container">
  <section class="col_12">

    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <?php the_content(); ?>
    <?php endwhile; // end of the loop. ?>
  </section>
</div>
<!--/.content-->

<?php get_footer();?>
