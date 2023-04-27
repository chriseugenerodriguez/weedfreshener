<?php /* Template Name: Blog */ ?>
<?php get_header(); ?>

 <div class="clearfix">
<header class="page-header">
<h1 class="page-title"><?php the_title(); ?></h1>
</header> 
 <section class="page-content">
  <div class="container-fluid paddingtop paddingbottom clearfix">
    <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;?>
    <?php query_posts(array('posts_per_page'=>get_option('premiumwd_blog_perpage'), 'paged'=>$paged)); ?>
    <?php if ($wp_query->have_posts()) : ?>
    <div class="content">
      <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
      <?php get_template_part('post'); ?>
      <?php endwhile; ?>
    </div>
    <?php echo pagination(); ?>
    <?php endif; ?>
  </div>
  <!--/.pad-->
  </section>
  </div>
<!--/.content-->

<?php get_footer(); ?>