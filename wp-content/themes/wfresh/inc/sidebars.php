<?php 

//Function for widget sidebars
if ( function_exists('register_sidebar') )
    register_sidebars(1,array(
	    'name' => 'Side Menu',
        'before_widget' => '<aside class="widget_nav_menu clearfix %1$s">',
        'after_widget' => '</aside>',
        'before_title'  => '<h5>',
        'after_title'   => '</h5>' 
        )
    );
if ( function_exists('register_sidebar') )
    register_sidebars(1,array(
	    'name' => 'Footer Menu',
        'before_widget' => '<aside class="widget_nav_menu clearfix %1$s">',
        'after_widget' => '</aside>',
        'before_title'  => '<h5>',
        'after_title'   => '</h5>' 
        )
    );	 
	 



?>
