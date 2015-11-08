<?php
/** New Life Widget - Snippet Posts
****************************************************************/
class New_Life_Widget_Snippet_Posts extends WP_Widget {

  // Register widget with WordPress.
  function __construct() {
    $widget_ops = array(
      'classname' => 'newlife_widget_snippet_posts',
      'description' => __('NL - Snippet Posts')
    );
    parent::__construct('newlife-widget-snippet-posts', __('NL - Snippet Posts'), $widget_ops);
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
    $thisNumber = $instance['num'];
    $thisCategory = $instance['cat'];
    $category_link = get_category_link( $thisCategory );
    $titleBarSpan = '<span class="block section-title-bar">' . $thisTitle . '</span>';
    $titleBarLink = '<a href="' . esc_url($category_link) . '">' . $titleBarSpan . '</a>';
    $argsQueryPosts = array(
      'cat' => $thisCategory,
      'showposts' => $thisNumber
    );
    $thisQuery = new WP_Query( $argsQueryPosts );
    echo  "\n";
    echo '  <div class="container newlife-widget newlife-snippet-posts">' . "\n";
    if ($thisCategory != 0) {
      echo '    ' . $titleBarLink . "\n";
    } else {
      echo '    ' . $titleBarSpan . "\n";
    }
    echo '    <div class="snippet-posts">' . "\n";
    while( $thisQuery->have_posts() ) : $thisQuery->the_post();
      ob_start();
?>

      <div class="post">
        <div class="post-title">
          <h2><a href="<?php echo get_permalink(); ?>" rel="bookmark"><?php echo the_title(); ?></a></h2>
        </div>
        <div class="post-entry">
          <?php the_excerpt(); echo "\n"; ?>
        </div>
        <div class="post-meta">
          <?php newlife_post_data(); echo "\n"; ?>
        </div>
        <div class="clear"></div>
      </div>

<?php
      echo ob_get_clean();
    endwhile;
    echo '      <div class="navigation-posts">' . "\n";
    echo '      </div>' . "\n";
    echo '      <div class="clear"></div>' . "\n";
    echo '    </div>' . "\n";
    echo "  </div>\n";
    wp_reset_postdata();
  }

  /**
   ** Back-end widget form.
   **
   ** @see WP_Widget::form()
   **
   ** @param array $instance Previously saved values from database.
   **/
  function form($instance) {
    $thisTitle = isset($instance['title']) ? esc_attr($instance['title']) : 'NL - Snippet Posts';
    $thisNumber = isset($instance['num']) ? absint($instance['num']) : 5;
    $thisCategory = isset($instance['cat']) ? $instance['cat'] : 0;
    $thisTag = isset($instance['tag']) ? $instance['tag'] : 0;

    $argsCategory = array(
      'class'            => 'postform',
      'depth'            => 0,
      'child_of'         => 0,
      'exclude'          => '',
      'echo'             => 1,
      'hide_empty'       => 0, 
      'hide_if_empty'    => false,
      'hierarchical'     => 0, 
      'id'               => $this->get_field_id('cat'),
      'name'             => $this->get_field_name('cat'),
      'order'            => 'ASC',
      'orderby'          => 'ID', 
      'selected'         => $thisCategory,
      'show_count'       => 0,
      'show_option_all'  => '-- ALL --',
      'show_option_none' => '',
      'tab_index'        => 0,
      'taxonomy'         => 'category'
    );

    ob_start();
?>

<div style="padding: 5px 0px">
  Display Title: 
  <input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" size="20" value="<?php echo $thisTitle; ?>"/>
</div>
<div style="padding: 5px 0px">
  Number of Posts to Show: 
  <input type="number" id="<?php echo $this->get_field_id('num'); ?>" name="<?php echo $this->get_field_name('num'); ?>" min="0" max="99" size="2" value="<?php echo $thisNumber ?>"/>
</div>
<div style="padding: 5px 0px">
  Category: 
  <?php wp_dropdown_categories( $argsCategory ); ?>
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
    $instance['num'] = absint($new_instance['num']);
    $instance['cat'] = $new_instance['cat'];

    return $instance;
  }

}

function newlife_register_widget_snippet_posts() {
  register_widget('New_Life_Widget_Snippet_Posts');
}

add_action( 'widgets_init', 'newlife_register_widget_snippet_posts' );
?>