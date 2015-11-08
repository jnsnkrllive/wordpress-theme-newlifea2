<?php
/**
 ** HOME
 **/
?>
<?php get_header(); ?>

  <div id="newlife-widget-area-mobile">
    <?php if( ! dynamic_sidebar( 'newlife-widget-area-mobile' ) ) : endif;?>
  </div>
  <div id="newlife-widget-area-desktop">
    <?php if( ! dynamic_sidebar( 'newlife-widget-area-desktop' ) ) : endif;?>
    <div class="clear"></div>
  </div>
  
<?php get_footer(); ?>