<?php
/**
 ** PAGE
 **/
?>


<?php get_header(); ?>

    <div class="container" id="single-page">

      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="post">
          <div class="post-title">
            <span class="block post-title-bar"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></span>
          </div>
          <div class="post-entry">
            <?php the_content('Read the rest of this entry &raquo;'); ?>
          </div>
          <div class="post-meta">
            <?php newlife_post_data(); ?>
          </div>
          <div class="clear"></div>
        </div>
      <?php endwhile; endif; ?>

    </div><!-- (id="single-page") -->

<?php get_footer(); ?>