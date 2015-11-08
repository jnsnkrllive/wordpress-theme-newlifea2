<?php
/** New Life Widget - Link to Page
****************************************************************/
class New_Life_Widget_Link_Page extends WP_Widget {

  // Register widget with WordPress.
  function __construct() {
    $widget_ops = array(
      'classname' => 'newlife_widget_link_page',
      'description' => __('NL - Link to Page')
    );
    parent::__construct('newlife-widget-link-page', __('NL - Link to Page'), $widget_ops);
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

    ob_start();
?>

  <a href="<?php echo get_page_link($thisPage); ?>">
    <?php echo $before_widget . "\n"; ?>
      <span class="block section-title-bar"><?php echo $thisTitle;?>
        <span class="link-page-icon"></span>
        <div class="clear"></div>
      </span>
    <?php echo $after_widget . "\n"; ?>
  </a>

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
    $thisTitle = isset($instance['title']) ? esc_attr($instance['title']) : 'NL - Link to Page';
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

function newlife_register_widget_link_page() {
  register_widget('New_Life_Widget_Link_Page');
}

add_action( 'widgets_init', 'newlife_register_widget_link_page' );
?>