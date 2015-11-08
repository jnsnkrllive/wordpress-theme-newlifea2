<?php
/** HEADER
 ** Displays all of the <head> section and everything in the <body> up to <div id="content">\

<!DOCTYPE html>

 **/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<!-- ******************************************************************* -->
<head>
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <meta name="keywords" content="" />
  <meta name="description" content="<?php bloginfo('description'); ?>" />
  <title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/newlifea2-favicon1.ico" />
  <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
  <link href="https://plus.google.com/115354395388472524414" rel="publisher" />
  <?php wp_head(); ?>
  <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/jquery_1-7-1.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/jquery-ui_1-9-1.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/newlife.js"></script>
  <script>
  function setup() {
	this.addEventListener("DOMContentLoaded", sizeLightbox, true);
	this.addEventListener("DOMContentLoaded", sizeFooterWidgetArea, true);
	this.addEventListener("DOMContentLoaded", footerMapExpandableList, true);
	this.addEventListener("DOMContentLoaded", addLightboxEvent, true);
	this.addEventListener("resize", sizeLightbox, true);
	this.addEventListener("resize", sizeFooterWidgetArea, true);
	this.addEventListener("resize", doLightboxUnload, true);
	//this.addEventListener("mousemove", addLightboxEvent, true);
  }
  setup();
  </script>
</head>
<!-- ******************************************************************* -->
<!-- <body onload="sizeFooterWidgetArea(); footerMapExpandableList(); addLightbox();" onresize="sizeFooterWidgetArea();"> -->
<body>

<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

<div id="main-container">

  <div id="header-container">

    <div id="header-area-1">
      <div id="header-logo">
        <a href="<?php bloginfo('url'); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
        <img src="<?php header_image(); ?>" class="aligncenter" />
	    </a>
      </div><!-- (id="header-logo") -->
    </div><!-- (id="header-area-1") -->

    <div id="header-area-2">
      <div id="header-titlebar">
        <span id="blogname"><?php bloginfo('name'); ?></span><br />
	    <span id="blogdesc"><?php bloginfo('description'); ?></span>
      </div><!-- (id="header-titlebar") -->
      <div id="header-searchbar">
        <?php get_search_form(); ?>
      </div><!-- (id="header-searchbar") -->
      <div class="clear"></div>
      <div id="header-navbar">
        <?php
          wp_nav_menu( array(
            'theme_location' => 'primary-nav', // Setting up the location for the main-menu, Main Navigation.
            'container_id' => 'navmenu', //Add CSS ID to the containter that wraps the menu.
            'menu_class' => 'dropdown', //Adding the class for dropdowns
            'fallback_cb' => 'wp_page_menu', //if wp_nav_menu is unavailable, WordPress displays wp_page_menu function, which displays the pages of your blog.
          ) );
        ?>
      </div><!-- (id="header-navbar") -->
    </div><!-- (id="header-area-2") -->
  
  </div><!-- (id="header-container") -->
  
  <div id="scrollable">
	<div id="scrollbar"></div>
	<div id="content">