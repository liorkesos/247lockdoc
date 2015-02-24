<?php
/**
 * Permatex
 * (c) Web factory Ltd, 2013
 */

  get_header();

  $page_404_id = wf_theme_get_option('page_404_id');

  if ($page_404_id && get_post_field('post_content', $page_404_id)) {
    $content = apply_filters('the_content', get_post_field('post_content', $page_404_id));
    $title = get_the_title($page_404_id);
  } else {
    $content = __('<p>Looks like the page you\'re looking for isn\'t here any more. Sorry.</p>', WF_THEME_TEXTDOMAIN);
    $title = 'Page not found';
  }
?>
<div id="teaser-page">
        <div class="container">
        <div class="row">
          <div class="span12">
            <div class="inner">
                  <h1 class="page-title"><?php echo esc_html($title); ?></h1>
                </div>
          </div>
        </div>
      </div>
    </div>
    
<div id="main-content">
  <div class="container">
    <div class="row">
      <div class="span8" id="content">
        <div class="inner">
<?php
  echo $content;
?>
      </div>
      </div>
      <div id="sidebar" class="span4 hidden-phone">
        <?php get_sidebar(); ?>
      </div>
    </div>
 </div>
</div>
<?php
  get_footer();
?>