<?php
// Enable post and comments RSS feed links to head
add_theme_support( 'automatic-feed-links' );


// Create a function for register_nav_menus()
function newlife_register_menus() {
  register_nav_menus(
    array(
      'primary-nav' => __( 'Primary Site Navigation Menu' ),
	  'footer-map' => __( 'Footer Site Map Menu' )
	)
  );
}
// Add the above function to init hook.
add_action( 'init', 'newlife_register_menus' );

// Remove filter on content (HTML Comments Close Tag Issue)
remove_filter('the_content', 'wptexturize');


// Filter Menu Arguments based on theme location
add_filter( 'wp_nav_menu_args', 'newlife_footer_map_menu_args' );
function newlife_footer_map_menu_args( $args ) {

    $menus = wp_get_nav_menus();
    $menu_locations = get_nav_menu_locations();

    $location_id = 'footer-map';
    if( isset($menu_locations[ $location_id ]) ) {
        foreach($menus as $menu) {
            if( $menu->term_id == $menu_locations[ $location_id ] && $args['theme_location'] != 'primary-nav' ) {
                $args = array_merge( $args, array( 'container_id' => 'sitemap', 'container_class' => 'expandable', 'after' => '<span class="expandable"></span>') );
			    return $args;
		    }
	    }
    }
    return $args;

}


// Register Widget Areas
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Sidebar - First Widget Area',
    'id' => 'sidbar-widget-area-1',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2>',
    'after_title' => '</h2>',
  ));
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Sidebar - Second Widget Area',
    'id' => 'sidebar-widget-area-2',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2>',
    'after_title' => '</h2>',
  ));
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Footer - First Widget Area',
    'id' => 'footer-widget-area-1',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2>',
    'after_title' => '</h2>',
  ));
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Footer - Second Widget Area',
    'id' => 'footer-widget-area-2',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2>',
    'after_title' => '</h2>',
  ));
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Footer - Third Widget Area',
    'id' => 'footer-widget-area-3',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2>',
    'after_title' => '</h2>',
  ));


// Search Bar
add_filter( 'get_search_form', 'newlife_search_form' );
function newlife_search_form( $form ) {
  get_search_query();
  $form = '';
  $form .= '<form method="get" class="form-search" action="' . home_url( '/' ) . '" >';
  $form .= '<div>';
  $form .= '<input type="text" value="Search" name="s" id="s" accesskey="4" title="Search"';
  $form .= 'onfocus="this.value=(this.value==\'Search\') ? \'\' : this.value;" onblur="this.value=(this.value==\'\') ? \'Search\' : this.value;" />';
  $form .= '</div>';
  $form .= '</form>';
  return $form;
}


// Recent Posts Widget
add_action('init','newlife_register_widget');
function newlife_widget_recent_posts_by_category( $args ) {
    $saved_options = get_option('newlife_widget_recent_posts');
	$categories = get_the_category();
	$catName = "";
	foreach( $categories as $category ) {
	    if( $category->term_id == $saved_options['cat'] ) {
		    $catName = $category->cat_name;
		}
	}
    extract($args);
    echo $before_widget;
    echo $before_title . $saved_options['title'] . $after_title;
	echo "<ul>";
	query_posts( 'cat=' . $saved_options['cat'] . '&showposts=' . $saved_options['num'] );
	while( have_posts() ) : the_post();
        echo "<li>";
		echo "<a href='" . get_permalink() . "'>";
		echo the_title();
		echo "</a>";
		echo "</li>";
	endwhile;
	echo "</ul>";
    echo $after_widget;
}

function newlife_register_widget() {
    wp_register_sidebar_widget(
        'newlife_widget_recent_posts',
        'Recent Posts by Category',
        'newlife_widget_recent_posts_by_category',
        array(
            'description' => 'Description of what your widget does'
        )
    );
    wp_register_widget_control('newlife_widget_recent_posts', 'Category Posts Display', 'newlife_widget_recent_posts_control');
}

function newlife_widget_recent_posts_control() {

    //if new options were just submitted, save them
    if( isset($_POST['newlife_widget_recent_post_title']) || isset($_POST['newlife_widget_recent_post_num']) || isset($_POST['newlife_widget_category']) ) {
        $sent_options = array(
            'title' => $_POST['newlife_widget_recent_post_title'],
            'num' => $_POST['newlife_widget_recent_post_num'],
            'cat' => $_POST['newlife_widget_category']
        ); 
        update_option('newlife_widget_recent_posts', $sent_options);
    }

    //get saved options, if they exist
    $saved_options = get_option('newlife_widget_recent_posts');
	
    $args = array(
        'show_option_all'    => '',
        'show_option_none'   => '',
        'orderby'            => 'ID', 
        'order'              => 'ASC',
        'show_count'         => 0,
        'hide_empty'         => 1, 
        'child_of'           => 0,
        'exclude'            => '',
        'echo'               => 1,
        'selected'           => $saved_options['cat'],
        'hierarchical'       => 0, 
        'name'               => 'newlife_widget_category',
        'id'                 => '',
        'class'              => 'postform',
        'depth'              => 0,
        'tab_index'          => 0,
        'taxonomy'           => 'category',
        'hide_if_empty'      => false
    );
	
	echo "Display Title: ";
    echo "<input type='text' name='newlife_widget_recent_post_title' size='20' value='".$saved_options['title']."'/>";
	echo "<br />";

    echo "Number of Posts to Show: ";
    echo "<input type='number' name='newlife_widget_recent_post_num' min='0' max='99' size='2' value='".$saved_options['num']."'/>";
	echo "<br />";
	
	echo "Category: ";
	wp_dropdown_categories( $args );
	echo "<br />";

}


// Post Metadata
function newlife_post_data( ) {
  $postDate = the_date('', '', '', FALSE);
  $postAuthor = get_the_author();
  $postCategory = get_the_category_list(', ');
  echo "<div class='post-data'>";
  echo "Posted on " . $postDate . " by " . $postAuthor . " in " . $postCategory . ".";
  edit_post_link('Edit.', '<span class="edit-post">', '</span>');
  echo "</div>";
	/*
	<span class="post-metadata-author">Author: <?php the_author() ?><br /></span>
	<span class="post-metadata-date">Date: <?php the_date(); ?><br /></span>
	<span class="post-metadata-category">Categories: <?php the_category(', ') ?><br /></span>
	<span class="post-metadata-tags"><?php the_tags('Tags: ', ', ', '<br />'); ?></span>
	<span class="post-metadata-comments"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?><br /></span>
	*/
}

// Social Media Sharing Buttons
function newlife_social_media_buttons($postLink) {
  $options = get_option('newlife_settings_social');
  $displayButtons = ( $options['facebook'] || $options['google'] || $options['twitter'] );
  if( $displayButtons ) {
    echo "<div class='social-media-buttons'>";
	if( $options['facebook'] ) {
	  echo "<div class='facebook'><div class='fb-like' data-href=" . $postLink . " data-send='false' data-layout='button_count' data-width='120' data-show-faces='false' data-font='segoe ui'></div></div>";
	}
	if( $options['google'] ) {
	  echo "<div class='google'><div class='g-plusone' data-align='left' data-size='medium' data-annotation='bubble' data-width='60' data-href=" . $postLink . " ></div></div>";
	}
	if( $options['twitter'] ) {
	  echo "<div class='twitter'><a href='https://twitter.com/share' class='twitter-share-button' data-url=" . $postLink . " data-count='horizontal'>Tweet</a><script type='text/javascript' src='//platform.twitter.com/widgets.js'></script></div>";
	}
    echo "</div><!-- (class='social-media-buttons') -->";
  }  
}


// Disable Admin Bar
add_filter( 'show_admin_bar' , 'newlife_admin_bar');
function newlife_admin_bar() {
  return false;
}


// Custom Header Logo
$newlife_customheader_args = array(
	'default-image'          => get_template_directory_uri() . '/images/newlifea2-logo1a.png',
	'random-default'         => false,
	'width'                  => 400,
	'height'                 => 180,
	'flex-height'            => false,
	'flex-width'             => false,
	'default-text-color'     => '',
	'header-text'            => false,
	'uploads'                => true,
	'wp-head-callback'       => '',
	'admin-head-callback'    => 'newlife_admin_customheader_style',
	'admin-preview-callback' => '',
);
add_theme_support( 'custom-header', $newlife_customheader_args );

function newlife_admin_customheader_style() {
  ?>
	<style type="text/css">
	#headimg {
	    background-position:center; 
		background-repeat: no-repeat;
	}
	</style>
  <?php
}


// Custom Admin Options
function newlife_admin_settings_page() {
  ?>
    <div class="wrap">
      <?php screen_icon(); ?>
      <h2>New Life Settings</h2>
      <form method="post" action="options.php"> 
        <?php settings_fields( 'newlife_settings_social' ); ?>
        <?php do_settings_fields( 'newlife_admin_settings', 'newlife_main' ); ?>
        <?php submit_button(); ?>
      </form>
    </div>
  <?php
}

add_action('admin_menu', 'newlife_admin_add_page');
function newlife_admin_add_page() {
  add_options_page('New Life Settings', 'New Life Settings', 'manage_options', 'newlife_admin_settings', 'newlife_admin_settings_page');
}

add_action('admin_init', 'newlife_admin_init');
function newlife_admin_init(){  
  register_setting( 'newlife_settings_social', 'newlife_settings_social', 'newlife_settings_social_validate' );
  add_settings_section('newlife_settings_social', 'Social Media Sharing Buttons', 'newlife_section_text_social', 'newlife_admin_settings');
  add_settings_field('newlife_setting_social_facebook', 'Facebook Like Button', 'newlife_setting_checkbox_social_facebook', 'newlife_admin_settings', 'newlife_main');
  add_settings_field('newlife_setting_social_google', 'Google +1 Button', 'newlife_setting_checkbox_social_google', 'newlife_admin_settings', 'newlife_main');
  add_settings_field('newlife_setting_social_twitter', 'Twitter Button', 'newlife_setting_checkbox_social_twitter', 'newlife_admin_settings', 'newlife_main');
}

function newlife_section_text_social() {
  echo '<p>Which social media sharing buttons should be displayed for each post?</p>';
}

function newlife_setting_checkbox_social_facebook() {
  $options = get_option('newlife_settings_social');
  echo "<br /><input id='newlife_options_social_facebook' name='newlife_settings_social[facebook]' type='checkbox' value='social_facebook' " . checked( $options['facebook'], true, false ) . " /><br /><br />";
}

function newlife_setting_checkbox_social_google() {
  $options = get_option('newlife_settings_social');
  echo "<br /><input id='newlife_options_social_google' name='newlife_settings_social[google]' type='checkbox' value='social_google' " . checked( $options['google'], true, false ) . " /><br /><br />";
}

function newlife_setting_checkbox_social_twitter() {
  $options = get_option('newlife_settings_social');
  echo "<br /><input id='newlife_options_social_twitter' name='newlife_settings_social[twitter]' type='checkbox' value='social_twitter' " . checked( $options['twitter'], true, false ) . " /><br /><br />";
}

function newlife_settings_social_validate($input) {
  $options = get_option('newlife_settings_social');
  $options['facebook'] = trim($input['facebook']);
  $options['google'] = trim($input['google']);
  $options['twitter'] = trim($input['twitter']);

  if( isset($options['facebook']) && $options['facebook'] == true ) {
    $options['facebook'] = true;
  } else {
	$options['facebook'] = false;
  }
  
  if( isset($options['google']) && $options['google'] == true ) {
    $options['google'] = true;
  } else {
	$options['google'] = false;
  }
  
  if( isset($options['twitter']) && $options['twitter'] == true ) {
    $options['twitter'] = true;
  } else {
	$options['twitter'] = false;
  }
  
  return $options;
}

?>