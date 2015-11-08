<?php
/** SIDEBAR
 ** Displays the sidebar
 **/
?>

      <div id="sidebar-container">

        <div class="widget-area" id="sidbar-widget-area-1">

            <?php if( ! dynamic_sidebar( 'sidbar-widget-area-1' ) ) : ?>

            <ul class="none">

              <li id="search" class="widget-container widget_search">
                <?php get_search_form(); ?>
              </li>
              <li id="archives" class="widget-container">
                <h3 class="widget-title"><?php _e( 'Archives' ); ?></h3>
                <ul>
                  <?php wp_get_archives( 'type=monthly' ); ?>
                </ul>
              </li>
              <li id="meta" class="widget-container">
                <h3 class="widget-title"><?php _e( 'Meta' ); ?></h3>
                <ul>
                  <?php wp_register(); ?>
                  <li><?php wp_loginout(); ?></li>
                  <?php wp_meta(); ?>
                </ul>
              </li>
			  
            </ul>

            <?php endif; // end primary widget area ?>



        </div><!-- (class="widget-area" id="primary") -->

        <?php if( is_active_sidebar( 'sidebar-widget-area-2' ) ) : ?>
          <div class="widget-area" id="sidebar-widget-area-2">
              <?php dynamic_sidebar( 'sidebar-widget-area-2' ); ?>
          </div><!-- (class="widget-area" id="secondary") -->
        <?php endif; ?>

      </div><!-- (id="sidebar-container") -->