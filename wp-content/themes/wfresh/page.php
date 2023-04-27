<?php get_header(); ?>

 <div class="clearfix">
<header class="page-header">
<h1 class="page-title"><?php the_title(); ?></h1>
</header>
 <section class="page-content clearfix">    
 <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <?php the_content(); ?>
    <?php endwhile; // end of the loop. ?>
  </section>
<!--/.content-->
</div>
<?php get_footer(); ?>