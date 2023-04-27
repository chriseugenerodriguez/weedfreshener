<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head <?php do_action( 'add_head_attributes' ); ?>>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="HandheldFriendly" content="true" />
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<meta name="dcterms.dateCopyrighted" content="2015"/>
<meta name="dcterms.rightsHolder" content="weedfreshener llc."/>
<META name="Robots" content="INDEX,FOLLOW"/>

<!-- FAVICON -->
<link rel="shortcut icon" type="image/x-ico" href="<?php bloginfo( 'template_directory' ); ?>/dist/images/favicon/favicon.ico" />
<link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo( 'template_directory' ); ?>/dist/images/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" href="<?php bloginfo( 'template_directory' ); ?>/dist/images/favicon/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="<?php bloginfo( 'template_directory' ); ?>/dist/images/favicon/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="<?php bloginfo( 'template_directory' ); ?>/dist/images/favicon/manifest.json">
<link rel="mask-icon" href="<?php bloginfo( 'template_directory' ); ?>/dist/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
<meta name="theme-color" content="#ffffff">


<!--[if IE 7]>
  <link rel="stylesheet" href="<?php bloginfo( 'template_directory' ); ?>/assets/fonts/css/font-awesome-ie7.css" />
<![endif]-->

<link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet"> 
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_head(); ?>
<title>
<?php wp_title(''); ?>
</title>
<?php wp_enqueue_script("jquery"); ?>

</head>

<body <?php body_class('responsive'); ?> data-responsive="1" >

<!--Header-->
<nav id="mobile-menu" class='hidden-sidebar' role="navigation">
  <div class='hidden-sidebar-inner'>
    <?php dynamic_sidebar( 'Side Menu' ); ?>
  </div>
</nav>
<div id="theme-wrapper">
<header class="main">
  <div class="container clearfix">
    <div class="col_12">
      <div class="logo"> <a id="logo" href="<?php bloginfo('url')?>/">
        <img src="<?php echo get_template_directory_uri();?>/dist/images/logo.png"/>
        </a> </div>
        <div class="header-group">
      <div class="verticalize">
      <?php  wp_nav_menu( array( 'items_wrap' => '<ul id="menu-header">%3$s</ul>', 'container_class' => 'menu', 'theme_location' => 'header') ); ?>
      <?php echo cart(); ?>
      </div>
    </div>
    </div>
  </div>
</header>
