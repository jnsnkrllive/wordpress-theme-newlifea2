<?php
/**
 ** ARCHIVE
 **/
?>


<?php get_header(); ?>

    <div class="container" id="archive-results">

      <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
      <?php if (is_category()) { ?>
      <span class="block post-title-bar">&#39;<?php single_cat_title(); ?>&#39; Category</span>
      <?php } elseif( is_tag() ) { ?>
      <span class="block post-title-bar">&#39;<?php single_tag_title(); ?>&#39; Tag</span>
      <?php } elseif (is_day()) { ?>
      <span class="block post-title-bar">Archive for <?php the_time('F jS, Y'); ?></span>
      <?php } elseif (is_month()) { ?>
      <span class="block post-title-bar">Archive for <?php the_time('F Y'); ?></span>
      <?php } elseif (is_year()) { ?>
      <span class="block post-title-bar">Archive for <?php the_time('Y'); ?></span>
      <?php } elseif (is_author()) { ?>
      <span class="block post-title-bar">Author Archive</span>
      <?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
      <span class="block post-title-bar">Blog Archive</span>
      <?php } ?>

      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <div class="post">
          <div class="post-title">
            <h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
          </div>
          <div class="post-entry">
            <?php the_content('Read the rest of this entry &raquo;'); ?>
          </div>
          <div class="post-meta">
            <?php newlife_post_data(); ?>
          </div>
          <div class="clear"></div>
        </div>
      <?php endwhile; ?>
        <div class="navigation-posts">
          <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
          <div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
          <div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
          <?php } ?>
        </div>
        <div class="clear"></div>
      <?php else : ?>
        <h2>!Error 404 - Not Found</h2>
        <p>Sorry, but you are looking for something that isn't here.</p>
      <?php endif; ?>

    </div><!-- (id="archive-results") -->

<?php get_footer(); ?>