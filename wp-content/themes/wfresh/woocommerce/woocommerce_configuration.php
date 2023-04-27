<?php

// Adds theme support for woocommerce 
add_theme_support('woocommerce');

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

add_action( 'woocommerce_before_shop_loop', 'woocommerce_pagination', 10 );



function empty_wc_add_to_cart_message( $message, $product_id ) { 
    return ''; 
}; 
         
// add the filter 
add_filter( 'wc_add_to_cart_message', 'empty_wc_add_to_cart_message', 10, 2 );

// Display 24 products per page. Goes in functions.php
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 5;' ), 20 );



function woocustomers ( $atts, $content = null ) {
		$args 	=	shortcode_atts( array('status' => 'completed'), $atts );
		
		$status_list	=	$args['status'];
		$statuses 	=	array_map( 'trim', explode( ',', $status_list ) );	
		$order_count = 0;
		
		foreach ($statuses as $status) 
		{
			$status = str_replace( $status, 'wc-' . $status, $status );
			$total_orders = wp_count_posts( 'shop_order' )->$status; 
			$order_count += $total_orders;
			}
		ob_start();
		echo $order_count;
		return ob_get_clean();
		}
		
	add_shortcode( 'wc_order_count', 'woocustomers' );

/*--------------------------------------------------------------------*/                							
/*  Product Slider                							
/*--------------------------------------------------------------------*/
if (!function_exists('woocommerce_product_slider')) {
    function woocommerce_product_slider($atts, $content = null) {
        $args = array(
			"title" => "",
            "title_tag"             => "h3",
			"product_type" => "", // all/featured/on_sale
			"orderby" => "",  // random/alphabetically/most recent/price/sales
			"order" => "", // asc/desc
			"autoplay" => 'true',
			"category" => "",
			"number_of_posts" => 0,	
        );

        extract(shortcode_atts($args, $atts));

        $headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

        //get correct heading value. If provided heading isn't valid get the default one
        $title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];
		
		$args = array('post_type' => 'product');
		if(!empty($orderby)){
			if($orderby == 'random') $args['orderby'] = 'rand';
			else if($orderby == 'alphabetically') $args['orderby'] = 'title';
			else if($orderby == 'recent') $args['orderby'] = 'date';
			else if($orderby == 'price'){
				$args['meta_key'] = '_regular_price';
				 $args['orderby'] = 'meta_value_num';
			} else if($orderby == 'sales'){
				$args['meta_key'] = 'total_sales';
				 $args['orderby'] = 'meta_value_num';
			}
		}
		if(!empty($order)) $args['order'] = $order;
		if(!empty($category)) $args['tax_query'] = array(array("taxonomy" => "product_cat" , "field" => "slug", "terms" => explode(",", $category)));
		if($number_of_posts != 0) $args['posts_per_page'] = $number_of_posts;
		
		$args['meta_query'] = array();
		if(!empty($product_type))
			if($product_type == 'featured')
				$args['meta_query'] = array(array('key' => '_featured' , 'value' => 'yes' , 'compare' => '='));
			else if($product_type == 'on_sale') {
				$args['meta_query'] = array(
													'relation' => 'OR',
													array( // Simple products type
														'key'           => '_sale_price',
														'value'         => 0,
														'compare'       => '>',
														'type'          => 'numeric'
													),
													array( // Variable products type
														'key'           => '_min_variation_sale_price',
														'value'         => 0,
														'compare'       => '>',
														'type'          => 'numeric'
													)
												);
			}

		
        $q = new WP_Query($args);
		$GLOBALS['woocommerce_loop']['title_tag'] = $title_tag;
		if($q->have_posts()) :
        $html = "";
		if(!empty($title)) 
		$html .= '<h2>'.$title.'</h2>';
        $html .= '<div class="products-slider-wrapper container-fluid">';
		$html .= '<div class="products-slider">';
		$html .= '<div class="products-slider-roller">';
        $html .= '<ul class="products">';

        while($q->have_posts()) : $q->the_post();
		ob_start();
			wc_get_template_part( 'content', 'product' ); 
		$html .= ob_get_contents();
		ob_get_clean();
		endwhile;
		
        $html .= '</ul>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		endif;
		
		remove_filter('loop_shop_columns' , 'premiumwd_slider_col');
		remove_filter('post_class', 'premiumwd_slider_columns');
		
        return $html;
    }

}
add_shortcode('woocommerce_slider', 'woocommerce_product_slider');

function hide_coupon_field_on_checkout( $enabled ) {
	if ( is_checkout() ) {
		$enabled = false;
	}
	return $enabled;
}
add_filter( 'woocommerce_coupons_enabled', 'hide_coupon_field_on_checkout' );