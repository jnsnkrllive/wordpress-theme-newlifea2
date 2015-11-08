<?php
/** PAGE
 ** Displays all of the content on a page
 **/
?>

<?php get_header(); ?>

    <div id="page-container">

      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="post">
          <div class="post-title">
            <h2><?php the_title(); ?></h2>
          </div>
          <div class="post-entry-page">
            <?php the_content(); ?>
            <?php edit_post_link('Edit.', '<span class="edit-page">', '</span>'); ?>
          </div>
          <div class="clear"></div>
        </div><!-- (class="post") -->
      <?php endwhile; endif; ?>

    </div><!-- (id="page-container") -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>