<?php
/** New Life Widget - Link List
****************************************************************/
class New_Life_Widget_Link_List extends WP_Widget {

  // Register widget with WordPress.
  function __construct() {
    $widget_ops = array(
      'classname' => 'newlife_widget_link_list',
      'description' => __('Uses a custom menu to display a set of links.')
    );
    parent::__construct('newlife-widget-link-list', __('NL - Link List'), $widget_ops);
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
    $thisMenu = !empty( $instance['menu'] ) ? wp_get_nav_menu_object( $instance['menu'] ) : false;

    if( !$thisMenu ) { return; }

    ob_start();
?>

  <div class="newlife-widget newlife-link-list">
    <?php wp_nav_menu( array( 'menu' => $thisMenu) ); ?>
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
    $thisTitle = isset($instance['title']) ? esc_attr($instance['title']) : 'NL - Link List';
    $thisMenu = isset($instance['menu']) ? isset($instance['menu']) : '';
    
    // Get Menus
    $argsMenu = array(
      'hide_empty' => false
    );
      
    $menus = get_terms ('nav_menu', $argsMenu );
    if ( !$menus ) {
      echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.'), admin_url('nav-menus.php') ) .'</p>';
      return;
    }

    ob_start();
?>

<div style="padding: 5px 0px">
  Display Title: 
  <input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" size="20" value="<?php echo $thisTitle; ?>"/>
</div>
<div style="padding: 5px 0px">
  Select Menu: 
  <select id="<?php echo $this->get_field_id('menu'); ?>" name="<?php echo $this->get_field_name('menu'); ?>">
    <?php
      foreach ( $menus as $menu ) {
          $selected = $nav_menu == $menu->term_id ? ' selected="selected"' : '';
          echo '<option'. $selected .' value="'. $menu->term_id .'">'. $menu->name .'</option>';
      }
    ?>
  </select>
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
    $instance['menu'] = (int) $new_instance['menu'];

    return $instance;
  }

}

function newlife_register_widget_link_list() {
  register_widget('New_Life_Widget_Link_List');
}

add_action( 'widgets_init', 'newlife_register_widget_link_list' );
?>