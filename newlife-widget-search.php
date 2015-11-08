<?php
/** New Life Widget - Search
****************************************************************/
class New_Life_Widget_Search extends WP_Widget {

  // Register widget with WordPress.
  function __construct() {
    $widget_ops = array(
      'classname' => 'newlife_widget_search',
      'description' => __('NL - Search')
    );
    parent::__construct('newlife-widget-search', __('NL - Search'), $widget_ops);
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

/*
  <div class="container newlife-widget newlife-search">
    <span class="block section-title-bar"><?php echo $thisTitle;?></span>
    <form method="get" class="form-search" action="<?php echo home_url( '/' ) ?>" >
      <input type="text" value="Search" title="Search" name="s" id="s" class="form-search" accesskey="4" onfocus="this.value=(this.value=='Search') ? '' : this.value;" onblur="this.value=(this.value=='') ? 'Search' : this.value;" />
    </form>
  </div>
*/

    ob_start();
?>

  <div class="container newlife-widget newlife-search">
    <span class="block section-title-bar"><?php echo $thisTitle;?>
      <form method="get" class="form-search" action="<?php echo home_url( '/' ) ?>" >
        <input type="text" value="Search" title="Search" name="s" id="s" class="form-search" accesskey="4" onfocus="this.value=(this.value=='Search') ? '' : this.value;" onblur="this.value=(this.value=='') ? 'Search' : this.value;" />
      </form>
      <div class="clear"></div>
    </span>
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
    $thisTitle = isset($instance['title']) ? esc_attr($instance['title']) : 'NL - Search';

    ob_start();
?>

<div style="padding: 5px 0px">
  Display Title: 
  <input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" size="20" value="<?php echo $thisTitle; ?>"/>
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

    return $instance;
  }

}

function newlife_register_widget_search() {
  register_widget('New_Life_Widget_Search');
}

add_action( 'widgets_init', 'newlife_register_widget_search' );
?>