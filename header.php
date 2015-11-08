<?php
/**
 ** HEADER
 **/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<!-- ******************************************************************* -->
<head>
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
  <meta name="keywords" content="" />
  <meta name="description" content="<?php bloginfo('description'); ?>" />
  <title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/newlifea2-favicon.ico" />
  <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
  <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/newlifea2-ios.png"/>
  <link href="https://plus.google.com/115354395388472524414" rel="publisher" />
  <?php wp_head(); ?>
  <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/jquery_1-7-1.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/jquery-ui_1-9-1.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/newlife.js"></script>

  <script type="text/javascript">
    newlifeHelper.setup();
  </script>

</head>
<!-- ******************************************************************* -->
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

<a name="anchor-top"></a>

<div id="main-container">

  <a class="anchor-link anchor-bottom hide" href="#anchor-bottom"></a>

  <div class="container" id="header">
    <a href="<?php bloginfo('url'); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
      <img src="<?php echo get_template_directory_uri(); ?>/images/newlifea2-logo.png" class="logo aligncenter" alt="" />
    </a>
  </div><!-- (id="header") -->
  
  <?php
    wp_nav_menu( array(
      'theme_location' => 'desktop-header-nav', // Setting up the location for the main-menu, Main Navigation.
      'container_class' => 'newlife-widget newlife-menu',
      'container_id' => 'navmenu', //Add CSS ID to the containter that wraps the menu.
      'menu_class' => 'dropdown', //Adding the class for dropdowns
      'fallback_cb' => 'wp_page_menu', //if wp_nav_menu is unavailable, WordPress displays wp_page_menu function, which displays the pages of your blog.
    ) );
  ?>
  <div class="clear"></div>