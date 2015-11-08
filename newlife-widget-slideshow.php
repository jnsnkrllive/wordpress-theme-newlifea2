<?php
/** New Life Widget - Slideshow
****************************************************************/
class New_Life_Widget_Slideshow extends WP_Widget {

  // Register widget with WordPress.
  function __construct() {
    $widget_ops = array(
      'classname' => 'newlife_widget_slideshow',
      'description' => __('NL - Slideshow')
    );
    parent::__construct('newlife-widget-slideshow', __('NL - Slideshow'), $widget_ops);
  }

  /**
   ** Front-end display of widget.
   **
   ** @see WP_Widget::widget()
   **
   ** @param array $args     Widget arguments.
   ** @param array $instance Saved values from database.
   **/
  function widget( $args, $instance ) {
    extract($args);
    $thisTitle = $instance['title'];
    $thisPage = $instance['page'];

    $argsPage = array(
      'post_type' => 'attachment',
      'orderby' => 'menu_order',
      'numberposts' => -1,
      'post_status' => null,
      'post_parent' => $thisPage
    );

    ob_start();
?>

  <div class="newlife-widget newlife-slideshow">

<?php
/*
  $attachments = get_posts( $argsPage );
  if ( $attachments ) {
    foreach ( $attachments as $attachment ) {
      $custom_url = get_post_meta( $attachment->ID, '_gallery_link_url', true );
      if( ! empty( $custom_url ) ) {
        echo "<a href='" . $custom_url . "'>";
        echo wp_get_attachment_image( $attachment->ID, 'theSlide' );
        echo "</a>";
      } else {
        echo "<a>";
        echo wp_get_attachment_image( $attachment->ID, 'theSlide' );
        echo "</a>";
      }
    }
  }
*/
  $thisPageContent = get_post($thisPage);
  $thisContent = $thisPageContent -> post_content;
  echo $thisContent;

?>

    <span class="arrow sliderPrev"></span>
    <span class="arrow sliderNext"></span>

    <div class="clear"></div>
  </div>

<?php
    echo ob_get_clean();
  }

  /**
   ** Back-end widget form.
   **
   ** @see WP_Widget::form()
   **
   ** @param array $instance Previously saved values from database.
   **/
  function form($instance) {
    $thisTitle = isset($instance['title']) ? esc_attr($instance['title']) : 'NL - Slideshow';
    $thisPage = isset($instance['page']) ? $instance['page'] : 0;

    $argsPage = array(
      'authors'      => '',
      'child_of'     => 0,
      'depth'        => 0,
      'echo'         => 1,
      'exclude'      => '',
      'exclude_tree' => '',
      'hierarchical' => 1,
      'include'      => '',
      'meta_key'     => '',
      'meta_value'   => '',
      'name'         => $this->get_field_name('page'),
      'post_type'    => 'page',
      'selected'     => $thisPage,
      'sort_column'  => 'post_title',
      'sort_order'   => 'ASC'
    );

    ob_start();
?>

<div style="padding: 5px 0px">
  Display Title: 
  <input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" size="20" value="<?php echo $thisTitle; ?>"/>
</div>
<div style="padding: 5px 0px">
  Page: 
  <?php wp_dropdown_pages( $argsPage ); ?>
</div>

<?php
    echo ob_get_clean();
  }

  /**
   ** Sanitize widget form values as they are saved.
   **
   ** @see WP_Widget::update()
   **
   ** @param array $new_instance Values just sent to be saved.
   ** @param array $old_instance Previously saved values from database.
   **
   ** @return array Updated safe values to be saved.
   **/
  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['page'] = $new_instance['page'];
    
    return $instance;
  }

}

function newlife_register_widget_slideshow() {
  register_widget('New_Life_Widget_slideshow');
}

add_action( 'widgets_init', 'newlife_register_widget_slideshow' );
?>