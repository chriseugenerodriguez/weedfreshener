<?php get_header(); ?>
<?php global $post;?>
 <div class="clearfix">
<header class="page-header">
<h1 class="page-title"><?php the_title(); ?></h1>
</header> 
 <section class="page-content">
    <?php while ( have_posts() ): the_post(); ?>
    <div class="container margintop">
        <ul class="post-meta group">
      <li><?php the_author_posts_link(); ?> </li>
      <li><?php the_time('j M, Y'); ?></li>
    </ul>

      <div class="single-post">
      <?php the_post_thumbnail('blog-post');  ?>
        
        <?php the_content(); ?>
      </div>
      </article>
      <?php echo get_the_tag_list('<div class="entry-tags"><span class="tags-title">Tags:</span> ',' ','</div>'); ?>
    </div>
    <?php endwhile; // end of the loop. ?>
    </div>
</section>
<?php get_footer(); ?>