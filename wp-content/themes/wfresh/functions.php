<?php

function pagination($pages = '', $range = 2) {
	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="navigation right"><ul>' . "\n";

	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<span class="previous"><i class="fa fa-angle-left"></i> %s</span>' . "\n", get_previous_posts_link('Prev') );

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<span>…</span>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<span>…</span>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<span class="next">%s <i class="fa fa-angle-right"></i></span>' . "\n", get_next_posts_link('Next') );

	echo '</ul></div>' . "\n";


}

function wp_title_for_home( $title )
{
  if( empty( $title ) && ( is_home() || is_front_page() ) ) {
    return __( 'Home', 'theme_domain' ) . ' | ' . get_bloginfo( 'description' );
  }
  return $title;
}
add_filter( 'wp_title', 'wp_title_for_home' );
	
	// Remove each style one by one
	add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
	function jk_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] ); // Remove the gloss
	unset( $enqueue_styles['woocommerce-layout'] ); // Remove the layout
	unset( $enqueue_styles['woocommerce-smallscreen'] ); // Remove the smallscreen optimisation
	return $enqueue_styles;
	}
	// Or just remove them all in one line
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );
	

	// Include files
	include_once (TEMPLATEPATH . "/woocommerce/woocommerce_configuration.php");
	include_once (TEMPLATEPATH . "/inc/sidebars.php");

	// WP ENQUEUE SCRIPTS / STYLES
	function  main_scripts() {	
		wp_register_style( 'stylesheet', get_stylesheet_directory_uri(). '/style.css', '', 'all');
		wp_register_style( 'main-css', get_stylesheet_directory_uri(). '/dist/styles/main.css', '', 'all');
		wp_register_style( 'font-awesome', get_stylesheet_directory_uri(). '/dist/fonts/font-awesome.min.css', '', 'all');
		
		wp_enqueue_style('stylesheet');
		wp_enqueue_style('main-css');
		wp_enqueue_style('font-awesome');
				
		wp_register_script('plugins-js', get_template_directory_uri(). '/dist/scripts/plugins.js', 'jquery');		
		wp_register_script('main-js', get_template_directory_uri(). '/dist/scripts/main.js', 'jquery');	

		wp_enqueue_script( 'plugins-js' );
		wp_enqueue_script( 'main-js' );
	}
	add_action( 'wp_enqueue_scripts', 'main_scripts' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'header' => __( 'Header Navigation', 'premiumwd' )
	) );
	
	// Enable Post Thumbnail 
	add_theme_support( 'post-thumbnails' );
	
	// Add Image Size 
	add_image_size( 'blog-post', 900, 410, true ); 
	add_image_size( 'index-recent', 200, 100, true ); 

	// Enable shortcode/
	add_filter('the_content', 'do_shortcode');
	add_filter('the_excerpt', 'do_shortcode');
	
	// Remove WordPress V.
	function wpbeginner_remove_version() {
	return '';
	}
	add_filter('the_generator', 'wpbeginner_remove_version');

	// Remove Query Strings
	function _remove_script_version( $src ){
	$parts = explode( '?', $src );
	return $parts[0];
	}
	add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
	add_filter( 'style_loader_src', '_remove_script_version', 15, 1 ); 


	// Defer parsing of JavaScript
	function defer_parsing_of_js ( $url ) {
	if ( FALSE === strpos( $url, '.js' ) ) return $url;
	if ( strpos( $url, 'jquery.js' ) ) return $url;
	return "$url' defer='defer";
	}
	add_filter( 'clean_url', 'defer_parsing_of_js', 11, 1 );
	
	
// Replaces the excerpt "more" text by a link
function new_excerpt_more($more) {
       global $post;
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

function custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function cart(){
	$items = ''; 
	$items .="<div class='cart'><ul>";
	
	if ( is_user_logged_in() ) { 
		$items .= '<li><a class="account" href="'. get_permalink( get_option("woocommerce_myaccount_page_id") ) .'" >My Account</a></li>';
	} else { 
		$items .= '<li><a href="'. esc_url( wp_login_url() ) .'">Login</a></li>';
	} 		 
	$items .= '<li><a href="/saved-items">Saved Items</a></li>';
 	$items .= '<li><a class="cart-contents" href="'. WC()->cart->get_cart_url() .'" title="View your shopping cart">'. sprintf(_n('%d', '%d', WC()->cart->cart_contents_count, 'woothemes'), WC()->cart->cart_contents_count).'<i>/</i>'. WC()->cart->get_cart_total().'</li></a>'; 
 	
 	$items .="</ul></div>";
 	
 	echo $items;
}