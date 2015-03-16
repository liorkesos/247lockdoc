<?php
/**
 * Permatex
 * (c) Web factory Ltd, 2013
 */

  the_post();
?>
<div class="archive-item">
    <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
    <div class="archive-title"><h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2></div>
    
  <div class="archive-meta"><span><?php the_time(get_option('date_format') . ' @ ' . get_option('time_format')); ?></span><span class="archive-meta-separator"> | </span> <?php _e('Category:', WF_THEME_TEXTDOMAIN); ?>
<?php if (get_the_category_list(', ')) echo get_the_category_list(', '); else echo 'No categories'; ?> <span class="archive-meta-separator"> | </span> <?php _e('Tags:', WF_THEME_TEXTDOMAIN); ?> <?php if(get_the_tags()) the_tags('',', '); else echo 'No tags'; ?></div>
<div class="clear"></div>
 
<?php
  if ($tmp = get_the_post_thumbnail($post->ID, 'per-loop', array('class' => 'post-img'))) {
    echo '<div class="archive-thumbnail"><a href="' . get_permalink() . '" title="' . get_the_title() .'">' . $tmp . '</a></div>';
  }
?>
        <?php the_excerpt(); ?>
      <a class="read-more" href="<?php the_permalink(); ?>"><?php _e('(Read more ...)', WF_THEME_TEXTDOMAIN); ?></a>
  </div>
  
    <div class="clear"></div>
  </div>
  <div class="archive-item-separator"></div>