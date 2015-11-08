<?php
/** FOOTER
 ** Displays all of the content after the <div id="sidebar-container"> closing tag
 **/
?>

      <div class="clear"></div>

      <div id="footer-container">
		
        <?php if( is_active_sidebar( 'footer-widget-area-1' ) ) : ?>
          <div class="widget-area" id="footer-widget-area-1">
              <?php dynamic_sidebar( 'footer-widget-area-1' ); ?>
          </div><!-- (class="widget-area" id="footer-widget-area-1") -->
        <?php endif; ?>
		
        <?php if( is_active_sidebar( 'footer-widget-area-2' ) ) : ?>
          <div class="widget-area" id="footer-widget-area-2">
              <?php dynamic_sidebar( 'footer-widget-area-2' ); ?>
          </div><!-- (class="widget-area" id="footer-widget-area-2") -->
        <?php endif; ?>
		
        <?php if( is_active_sidebar( 'footer-widget-area-3' ) ) : ?>
          <div class="widget-area" id="footer-widget-area-3">
              <?php dynamic_sidebar( 'footer-widget-area-3' ); ?>
          </div><!-- (class="widget-area" id="footer-widget-area-3") -->
        <?php endif; ?>
		
		<div class="clear"></div>

      </div><!-- (id="footer-container") -->
  
	</div><!-- (id="content"> -->
  </div><!-- (id="scrollable"> -->
</div><!-- (id="main-container"> -->


<div id="lightbox" class="lb-foreground"></div>
<div id="darkbox" class="lb-background" onClick="doLightboxUnload();"></div>


</body>
<!-- ******************************************************************* -->
</html>