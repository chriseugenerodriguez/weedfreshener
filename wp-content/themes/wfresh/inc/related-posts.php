<section id="blog-similar-posts" class="content clearfix">
	<div class="header-meta text-center">
		<h4>Related Articles</h4>
		<h5>Continue Reading</h5>
	</div>	
		<ul>
		<?php    $orig_post = $post;
			global $post;
			$categories = get_the_category($post->ID);
			if ($categories) {
			$category_ids = array();
			foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
			
			$args=array(
			'category__in' => $category_ids,
			'post__not_in' => array($post->ID),
			'posts_per_page'=> 4, // Number of related posts that will be shown.
			'caller_get_posts'=>1
			); 
		      
		    $my_query = new wp_query($args); 
		    if( $my_query->have_posts() ) {  while ($my_query->have_posts()) { $my_query->the_post();  
		    ?>  
		    <?php get_template_part('/inc/post'); ?>
			<?php }  
		    ?>  
		       
		<?
		}
		echo '</ul></section>';
		}
		$post = $orig_post;
		wp_reset_query(); ?>