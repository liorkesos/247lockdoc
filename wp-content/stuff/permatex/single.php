<?php
/**
 * Default Post Template With Sidebar on Right
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
        <h1 class="page-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
</div></div></div></div></div>

<div id="main-content">
  <div class="container">
    <div class="row">
      <div class="span8" id="content">
        <div class="inner">
    <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
  <div class="archive-meta"><span><?php the_time(get_option('date_format') . ' @ ' . get_option('time_format')); ?></span><span class="archive-meta-separator"> | </span> <?php _e('Category:', WF_THEME_TEXTDOMAIN); ?>
<?php if (get_the_category_list(', ')) echo get_the_category_list(', '); else echo 'No categories'; ?> <span class="archive-meta-separator"> | </span> <?php _e('Tags:', WF_THEME_TEXTDOMAIN); ?> <?php if(get_the_tags()) the_tags('',', '); else echo 'No tags'; ?></div>
<div class="clear"></div>
<div class="archive-item-separator"></div>
<div class="post-content">
<?php
  the_content();
  wp_link_pages();
  edit_post_link(null, '<div class="clear"></div><br />', null, null);
  echo '</div>';
  if (get_the_author_meta('description')) {
?>
    <div class="author-box">
            <?php echo get_avatar(get_the_author_meta('user_email'), 140); ?>
            <h4>About the author - <?php the_author_meta('display_name'); ?></h4>
              <?php echo wpautop(do_shortcode(get_the_author_meta('description'))); ?>
            <div class="clear"></div>
          </div>
<?php
  } // if author description
    if (wf_theme_get_option('post_social')) {
?>
          <div class="social-share">
            <h4>Share this article</h4>
            <ul>
              <li>
                <a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
              </li>
              <li>
                <script>(function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=152938731463199";
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
                <div id="fb-root"></div><div class="fb-like" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false"></div>
              </li>
              <li>
                <!-- Place this tag where you want the +1 button to render. -->
                <div class="g-plusone" data-size="tall" data-annotation="inline" data-width="250"></div>
                <!-- Place this tag after the last +1 button tag. -->
                <script type="text/javascript">
                  (function() {
                    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                    po.src = 'https://apis.google.com/js/plusone.js';
                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                  })();
                </script>
              </li>
            </ul>
            <div class="clear"></div>
          </div>
<?php } // if social ?>
          <div class="clear"></div>
        <div id="comment-area">
          <?php comments_template(); ?>
        </div>
      </div>
      </div>
      </div>
      <div id="sidebar" class="span4 hidden-phone hidden-tablet">
        <?php get_sidebar(); ?>
      </div>
    </div>
   </div>
</div>
<?php
  } // while have posts

  get_footer();
?>