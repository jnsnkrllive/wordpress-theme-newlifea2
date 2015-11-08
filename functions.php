<?php
// Enable post and comments RSS feed links to head
add_theme_support( 'automatic-feed-links' );


// Disable Admin Bar
add_filter( 'show_admin_bar' , 'newlife_admin_bar');
function newlife_admin_bar() {
  return false;
}


// Attachment Attributes
add_filter( 'wp_get_attachment_image_attributes', 'newlife_attachment_attributes' );
function newlife_attachment_attributes( $attr ) {
  $attr['class'] = 'theSlide';
  return $attr;
}


// Remove Image Dimensions
add_filter('post_thumbnail_html', 'newlife_remove_img_dimensions');
add_filter('get_avatar','newlife_remove_img_dimensions');
add_filter('the_content', 'newlife_remove_img_dimensions');
function newlife_remove_img_dimensions($html) {
  $html = preg_replace('/(width|height)=["\']\d*["\']\s?/', "", $html);
  return $html;
}


// Create a function for register_nav_menus()
function newlife_register_menus() {
  register_nav_menus(
    array(
      'desktop-header-nav' => __( 'Desktop Header Navigation Menu' )
    )
  );
}
// Add the above function to init hook.
add_action( 'init', 'newlife_register_menus' );

//TODO: include Shawn's function for nav menu with search field...


// Remove filter on content (HTML Comments Close Tag Issue)
remove_filter('the_content', 'wptexturize');


// Register Widget Areas
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Widget Area - Mobile',
    'id' => 'newlife-widget-area-mobile',
    'description' => 'Widget Area to define order on smaller width screens (mobile devices)',
    'before_widget' => '<div class="container newlife-widget %1$s" id="newlife-widget-%2$s">',
    'after_widget' => '</div>',
    'before_title' => '<span class="block section-title-bar">',
    'after_title' => '</span>'
  ));
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Widget Area - Desktop',
    'id' => 'newlife-widget-area-desktop',
    'description' => 'Widget Area to define order on larger width screens (desktop devices)',
    'before_widget' => '<div class="container newlife-widget %1$s" id="newlife-widget-%2$s">',
    'after_widget' => '</div>',
    'before_title' => '<span class="block section-title-bar">',
    'after_title' => '</span>'
  ));
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Widget Area - Footer',
    'id' => 'newlife-widget-area-footer',
    'description' => 'Widget Area for the footer displayed on each page',
    'before_widget' => '<div class="new-life-widget %1$s" id="newlife-widget-%2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2>',
    'after_title' => '</h2>',
  ));


// Post Metadata
function newlife_post_data( ) {
  $postDate = the_date('', '', '', FALSE);
  $postAuthor = get_the_author();
  $postCategory = get_the_category_list(', ');
  echo "<div class='post-data'>";
  echo "Posted on " . $postDate . " by " . $postAuthor;
  if($postCategory != "") {
    echo " in " . $postCategory . ".";
  }
  edit_post_link('EDIT', '<br /><span class="edit-post">', '</span>');
  echo "</div>";
}


// Load Widgets for New Life Theme
require_once("newlife-widget-expandable-posts.php");
require_once("newlife-widget-link-list.php");
require_once("newlife-widget-link-page.php");
require_once("newlife-widget-link-social.php");
require_once("newlife-widget-search.php");
require_once("newlife-widget-slideshow.php");
require_once("newlife-widget-snippet-posts.php");


?>