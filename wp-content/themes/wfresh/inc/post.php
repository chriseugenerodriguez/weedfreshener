<?php $format = get_post_format(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('group row'); ?>>
  <div class="media"><?php get_template_part('inc/post-format'); ?></div>
  <div class="content-text">
    <div class="post-inner">
        <h2 class="post-title uppercase"><?php the_title(); ?></h2>
         <?php the_excerpt();?>
         <a class="button" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">Read More</a>
    </div>
  </div>
</article>