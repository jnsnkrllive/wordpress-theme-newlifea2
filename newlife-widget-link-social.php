<?php
/** New Life Widget - Link to Social Media
****************************************************************/
class New_Life_Widget_Link_Social extends WP_Widget {

  // Register widget with WordPress.
  function __construct() {
    $widget_ops = array(
      'classname' => 'newlife_widget_link_social',
      'description' => __('NL - Links to Social Media')
    );
    parent::__construct('newlife-widget-link-social', __('NL - Links to Social Media'), $widget_ops);
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
    $thisIsFacebook = isset($instance['isFacebook']) && $instance['isFacebook'] == 'on' ? 1 : 0;
    $thisUrlFacebook = $instance['urlFacebook'];
    $thisIsGooglePlus = isset($instance['isGooglePlus']) && $instance['isGooglePlus'] == 'on' ? 1 : 0;
    $thisUrlGooglePlus = $instance['urlGooglePlus'];
    $thisIsTwitter = isset($instance['isTwitter']) && $instance['isTwitter'] == 'on' ? 1 : 0;
    $thisUrlTwitter = $instance['urlTwitter'];
    $thisIsYouTube = isset($instance['isYouTube']) && $instance['isYouTube'] == 'on' ? 1 : 0;
    $thisUrlYouTube = $instance['urlYouTube'];
    $thisIsVimeo = isset($instance['isVimeo']) && $instance['isVimeo'] == 'on' ? 1 : 0;
    $thisUrlVimeo = $instance['urlVimeo'];

//  <div class="container newlife-widget newlife-link-social">
//    <?php $before_title; ??<?php echo $thisTitle;??<?php $after_title; ??

    ob_start();
?>

  <div class="newlife-widget newlife-link-social">
    <ul>
<?php if($thisIsFacebook == 1) : ?>
      <li><a href="<?php echo $thisUrlFacebook; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png" alt="facebook" /></a></li>
<?php endif; ?>
<?php if($thisIsGooglePlus == 1) : ?>
      <li><a href="<?php echo $thisUrlGooglePlus ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/googleplus.png" alt="googleplus" /></a></li>
<?php endif; ?>
<?php if($thisIsTwitter == 1) : ?>
      <li><a href="<?php echo $thisUrlTwitter ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png" alt="twitter" /></a></li>
<?php endif; ?>
<?php if($thisIsYouTube == 1) : ?>
      <li><a href="<?php echo $thisUrlYouTube ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/youtube.png" alt="youtube" /></a></li>
<?php endif; ?>
<?php if($thisIsVimeo == 1) : ?>
      <li><a href="<?php echo $thisUrlVimeo ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/vimeo.png" alt="vimeo" /></a></li>
<?php endif; ?>
    <div class="clear"></div>
    </ul>
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
    $thisTitle = isset($instance['title']) ? esc_attr($instance['title']) : 'NL - Link to Social';
    $thisIsFacebook = isset($instance['isFacebook']) && $instance['isFacebook'] == 'on' ? 1 : 0;
    $thisUrlFacebook = isset($instance['urlFacebook']) ? $instance['urlFacebook'] : 'https://www.facebook.com/';
    $thisIsGooglePlus = isset($instance['isGooglePlus']) && $instance['isGooglePlus'] == 'on' ? 1 : 0;
    $thisUrlGooglePlus = isset($instance['urlGooglePlus']) ? $instance['urlGooglePlus'] : 'https://plus.google.com/';
    $thisIsTwitter = isset($instance['isTwitter']) && $instance['isTwitter'] == 'on' ? 1 : 0;
    $thisUrlTwitter = isset($instance['urlTwitter']) ? $instance['urlTwitter'] : 'https://www.twitter.com/';
    $thisIsYouTube = isset($instance['isYouTube']) && $instance['isYouTube'] == 'on' ? 1 : 0;
    $thisUrlYouTube = isset($instance['urlYouTube']) ? $instance['urlYouTube'] : 'https://www.youtube.com/';
    $thisIsVimeo = isset($instance['isVimeo']) && $instance['isVimeo'] == 'on' ? 1 : 0;
    $thisUrlVimeo = isset($instance['urlVimeo']) ? $instance['urlVimeo'] : 'https://www.vimeo.com/';

//Display Title:
//<input type="text" id="<?php echo $this->get_field_id('title'); ??" name="<?php echo $this->get_field_name('title'); ??" size="20" value="<?php echo $thisTitle; ??"/>
//<br />
//<p />

    ob_start();
?>

<div style="padding: 5px 0px">
  Facebook: 
  <input type="checkbox" id="<?php echo $this->get_field_id('isFacebook'); ?>" name="<?php echo $this->get_field_name('isFacebook'); ?>" <?php echo checked($thisIsFacebook, 1, false); ?>/>
  <br />
  <input type="text" id="<?php echo $this->get_field_id('urlFacebook'); ?>" name="<?php echo $this->get_field_name('urlFacebook'); ?>" size="36" value="<?php echo $thisUrlFacebook; ?>"/>
</div>
<div style="padding: 5px 0px">
  Google Plus: 
  <input type="checkbox" id="<?php echo $this->get_field_id('isGooglePlus'); ?>" name="<?php echo $this->get_field_name('isGooglePlus'); ?>" <?php echo checked($thisIsGooglePlus, 1, false); ?>/>
  <br />
  <input type="text" id="<?php echo $this->get_field_id('urlGooglePlus'); ?>" name="<?php echo $this->get_field_name('urlGooglePlus'); ?>" size="36" value="<?php echo $thisUrlGooglePlus; ?>"/>
</div>
<div style="padding: 5px 0px">
  Twitter: 
  <input type="checkbox" id="<?php echo $this->get_field_id('isTwitter'); ?>" name="<?php echo $this->get_field_name('isTwitter'); ?>" <?php echo checked($thisIsTwitter, 1, false); ?>/>
  <br />
  <input type="text" id="<?php echo $this->get_field_id('urlTwitter'); ?>" name="<?php echo $this->get_field_name('urlTwitter'); ?>" size="36" value="<?php echo $thisUrlTwitter; ?>"/>
</div>
<div style="padding: 5px 0px">
  YouTube: 
  <input type="checkbox" id="<?php echo $this->get_field_id('isYouTube'); ?>" name="<?php echo $this->get_field_name('isYouTube'); ?>" <?php echo checked($thisIsYouTube, 1, false); ?>/>
  <br />
  <input type="text" id="<?php echo $this->get_field_id('urlYouTube'); ?>" name="<?php echo $this->get_field_name('urlYouTube'); ?>" size="36" value="<?php echo $thisUrlYouTube; ?>"/>
</div>
<div style="padding: 5px 0px">
  Vimeo: 
  <input type="checkbox" id="<?php echo $this->get_field_id('isVimeo'); ?>" name="<?php echo $this->get_field_name('isVimeo'); ?>" <?php echo checked($thisIsVimeo, 1, false); ?>/>
  <br />
  <input type="text" id="<?php echo $this->get_field_id('urlVimeo'); ?>" name="<?php echo $this->get_field_name('urlVimeo'); ?>" size="36" value="<?php echo $thisUrlVimeo; ?>"/>
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
    $instance['isFacebook'] = $new_instance['isFacebook'];
    $instance['urlFacebook'] = $new_instance['urlFacebook'];
    $instance['isGooglePlus'] = $new_instance['isGooglePlus'];
    $instance['urlGooglePlus'] = $new_instance['urlGooglePlus'];
    $instance['isTwitter'] = $new_instance['isTwitter'];
    $instance['urlTwitter'] = $new_instance['urlTwitter'];
    $instance['isYouTube'] = $new_instance['isYouTube'];
    $instance['urlYouTube'] = $new_instance['urlYouTube'];
    $instance['isVimeo'] = $new_instance['isVimeo'];
    $instance['urlVimeo'] = $new_instance['urlVimeo'];

    return $instance;
  }

}

function newlife_register_widget_link_social() {
  register_widget('New_Life_Widget_Link_Social');
}

add_action( 'widgets_init', 'newlife_register_widget_link_social' );
?>