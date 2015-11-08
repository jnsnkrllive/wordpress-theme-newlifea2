<?php
/** SINGLE
 ** Displays a single post
 **/
?>

<?php get_header(); ?>

      <div id="post-container">

        <?php if (have_posts()) : ?>
		  <?php while (have_posts()) : the_post(); ?>

            <div class="post">
              <div class="post-title">
                <h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
              </div>
			  <div class="post-entry">
                <?php the_content('Read the rest of this entry &raquo;'); ?>
              </div>
              <div class="post-meta">
			    <?php newlife_social_media_buttons( get_permalink() ); ?>
                <?php newlife_post_data(); ?>
              </div>
              <div class="clear"></div>
            </div><!-- (class="post") -->

          <?php endwhile; ?>

          <div class="navigation">
            <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
            <div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
            <div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
            <?php } ?>
          </div><!-- (class="navigation") -->

        <?php else : ?>
          <h2>Error 404 - Not Found</h2>
          <p>Sorry, but you are looking for something that isn't here.</p>
        <?php endif; ?>

      </div><!-- (id="post-container") -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>