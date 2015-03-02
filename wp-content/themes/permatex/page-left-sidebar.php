<?php
/**
 * Template Name: Left Sidebar Page
 *
 * Permatex
 * (c) Web factory Ltd, 2013
 */

  get_header();
  while (have_posts()) {
    the_post();
?>
<div id="teaser-page">
        <div class="container">
        <div class="row">
          <div class="span12">
            <div class="inner">
                  <h1 class="page-title"><?php the_title(); ?></h1>
                </div>
          </div>
        </div>
      </div>
    </div>
    
<div id="main-content">
  <div class="container">
    <div class="row">
     <div id="sidebar" class="span4 hidden-phone">
        <?php get_sidebar(); ?>
      </div>
      <div class="span8" id="content">
        <div class="inner">
<?php
  the_content();
  edit_post_link(null, '<div class="clear"></div><br />', '<br /><br />', null);
?>
      </div>
      </div>
    </div>
 </div>
</div>
<?php
  } // while have posts

  get_footer();
?>