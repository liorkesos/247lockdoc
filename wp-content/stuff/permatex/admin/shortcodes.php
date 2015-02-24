<?php
/**
 * Permatex
 * (c) Web factory Ltd, 2013
 */

function wf_sc_twitter($atts, $content = '') {
  global $twitter_js;
  extract(shortcode_atts(array('count' => 1, 'avatar_size' => 32, 'icon' => true), $atts));
  $username = trim($content);
  $out = '';
  $twitter_js = true;

  if (!$username) {
    $username = 'WebFactoryLtd';
  }

  $count = (int) $count;
  $avatar_size = (int) $avatar_size;
  $icon = (bool) $icon;

  if (!wf_theme_get_option('twitter_consumer_key') || !wf_theme_get_option('twitter_consumer_secret') || !wf_theme_get_option('twitter_user_token') || !wf_theme_get_option('twitter_user_secret')) {
    $out .= '<div class="twitter_wrap">Please configure the Twitter feed via Theme Customizer.</div>';
  } else {
    $out .= '<div class="twitter_wrap">';
    if ($icon) {
      $out .= '<div class="icon-twitter twitter-image"></div>';
    }
    $out .= '<div data-count="' . $count . '" data-avatar-size="' . $avatar_size . '" data-username="' . $username . '" class="tweet"></div></div>';
  }


  return $out;
}
add_shortcode('twitter', 'wf_sc_twitter');

function wf_sc_gmap($atts, $content = '') {
  extract(shortcode_atts(array('zoom' => 12, 'height' => '400', 'bubble' => 'true', 'width' => '100%'), $atts));
  $bubble = (bool) $bubble;
  $zoom = (int) $zoom;
  $height = (int) $height;
  $out = '';

  $out .= '<iframe data-address="' . $content . '" data-zoom="' . $zoom . '" data-bubble="' . $bubble . '" height="' . $height . '" class="gmap"></iframe>';

  return $out;
}
add_shortcode('gmap', 'wf_sc_gmap');

function wf_sc_contact_form($atts, $content = '') {
  extract(shortcode_atts(array(), $atts));
  $out = '';
  global $contact_js;
  $contact_js = true;

  $out .= '<form method="post" action="' . get_permalink() . '" id="contact_form"><label for="name">Name *</label><input type="text" class="input-field" id="name" name="name" value=""><label for="email">E-mail *</label><input type="text" class="input-field" id="email" name="email" value=""><label for="message">Message *</label><textarea id="message" name="message" cols="50" rows="4"></textarea><p class="captcha-container"><span>How much is <strong id="captcha-img">2 + 2</strong> =</span><input type="text" class="captcha-input-field" id="captcha" name="captcha"></p><input type="submit" class="form-btn" value="Send message"></form>';

  return $out;
}
//add_shortcode('contact-form', 'wf_sc_contact_form');
//add_shortcode('contact_form', 'wf_sc_contact_form');


function wf_sc_quote($atts, $content = '') {
  extract(shortcode_atts(array(
    'smallprint' => '',
    'quotes' => true), $atts));
  $out = '';
  global $quote_js;
  $quote_js = true;

  if ($quotes) {
   $content = '&quot;' . $content . '&quot;';
  }
  $out .= '<blockquote><p>' . $content . '</p>';
  if ($smallprint) {
   $out .= '<cite>' . $smallprint . '</cite>';
  }
  $out .= '</blockquote>';

  return $out;
}
add_shortcode('quote', 'wf_sc_quote');

function wf_sc_quoterotate($atts, $content = '') {
  extract(shortcode_atts(array('icon' => true), $atts));
  $out = '';
  global $quote_js;
  $quote_js = true;

  $icon = (bool) $icon;

  $out .= '<div class="quote_wrap">';
  if ($icon) {
    $out .= '<span class="icon-quote-right twitter-image quote-image"></span>';
  }
  $out .= '<div class="quote-group">';
  $out .= do_shortcode($content);
  $out .= '</div><div class="clear"></div>';
  $out .= '</div>';

  return $out;
}
add_shortcode('quoterotate', 'wf_sc_quoterotate');

function wf_sc_button($atts, $content = '') {
  extract(shortcode_atts(array(
    'href' => '#',
    'size' => '',
    'color' => '',
    'class' => '',
    'target' => ''), $atts));
  $out = '';
  $class2 = '';
  $data = '';

  if ($size) {
    $class2 .= ' btn-' . $size;
  }
  if ($color) {
    $class2 .= ' btn-' . $color;
  }
  $class2 .= ' ' . $class;
  $class2 = ' ' . trim($class2);
  if (!strpos($class2, 'box-btn') !== false) {
    $class2 = 'btn' . $class2;
  }

  if ($target) {
   $target = 'target="' . $target . '"';
  }

  $out .= '<a ' . $target . ' href="' . $href . '" class="' . $class2 . '"' . $data . '>' . do_shortcode($content) . '</a>';

  return $out;
}
add_shortcode('button', 'wf_sc_button');

function wf_sc_clear($atts, $content = '') {
  $out = '';

  $out .= '<div class="clear"></div>';

  return $out;
}
add_shortcode('clear', 'wf_sc_clear');

function wf_sc_border($atts, $content = '') {
  $out = '';

  $out .= '<div class="border-break"><span></span></div>';

  return $out;
}
add_shortcode('border', 'wf_sc_border');

function wf_sc_title($atts, $content = '') {
  extract(shortcode_atts(array('size' => 4), $atts));
  $out = '';

  $content = do_shortcode($content);

  switch ($size) {
   case 1:
     $out .= '<h1>' . $content . '</h1>';
   break;
   case 2:
     $out .= '<h2>' . $content . '</h2>';
   break;
   case 3:
     $out .= '<h3>' . $content . '</h3>';
   break;
   case 4:
     $out .= '<h4>' . $content . '</h4>';
   break;
   case 5:
     $out .= '<h5>' . $content . '</h5>';
   break;
   case 6:
     $out .= '<h6>' . $content . '</h6>';
   break;
   default:
     $out .= '<h3>' . $content . '</h3>';
  }

  return $out;
}
add_shortcode('title', 'wf_sc_title');

function wf_sc_icon($atts, $content = '') {
  extract(shortcode_atts(array(
    'size' => 'large', 'class' => ''), $atts));
  $out = '';

  $content = str_replace(' ', '-', trim($content));
  if (substr($content, 0, 5) != 'icon-') {
   $content = ' icon-' . $content;
  }

  $size = 'icon-' . $size;

  $out .= '<span class="' . $class . $size . $content . '"></span>';

  return $out;
}
//add_shortcode('icon', 'wf_sc_icon');

function wf_sc_social_icon($atts, $content = '') {
  extract(shortcode_atts(array('target' => '', 'href' => '#', 'class' => '', 'color' => '', 'tooltip' => 'We love social networks'), $atts));
  $out = '';

  $content = str_replace(' ', '-', trim($content));
  if (substr($content, 0, 5) != 'icon-') {
   $content = ' icon-' . $content;
  }

  if ($color) {
    $color = ' style="color: ' . $color . '; ';
  }

  if ($target) {
   $target = ' target="' . $target . '" ';
  }

  $out .= '<a' . $target . ' target="_blank" class="social-icon" href="' . $href .'"><span title="' . $tooltip . '"' . $color . ' class="icon-4x ' . $class . $content . '"></span></a>';

  return $out;
}
add_shortcode('social-icon', 'wf_sc_social_icon');
add_shortcode('social_icon', 'wf_sc_social_icon');

function wf_sc_half($atts, $content = '') {
  $out = '';

  $out .= '<div class="half">' . do_shortcode($content) . '</div>';

  return $out;
}
add_shortcode('half', 'wf_sc_half');

function wf_sc_half_last($atts, $content = '') {
  $out = '';

  $out .= '<div class="half-last">' . do_shortcode($content) . '</div>';

  return $out;
}
add_shortcode('half_last', 'wf_sc_half_last');
add_shortcode('half-last', 'wf_sc_half_last');

function wf_sc_quarter($atts, $content = '') {
  $out = '';

  $out .= '<div class="quarter">' . do_shortcode($content) . '</div>';

  return $out;
}
add_shortcode('quarter', 'wf_sc_quarter');

function wf_sc_quarter_last($atts, $content = '') {
  $out = '';

  $out .= '<div class="quarter-last">' . do_shortcode($content) . '</div>';

  return $out;
}
add_shortcode('quarter-last', 'wf_sc_quarter_last');
add_shortcode('quarter_last', 'wf_sc_quarter_last');

function wf_sc_third($atts, $content = '') {
  $out = '';

  $out .= '<div class="third">' . do_shortcode($content) . '</div>';

  return $out;
}
add_shortcode('third', 'wf_sc_third');

function wf_sc_third_last($atts, $content = '') {
  $out = '';

  $out .= '<div class="third-last">' . do_shortcode($content) . '</div>';

  return $out;
}
add_shortcode('third-last', 'wf_sc_third_last');
add_shortcode('third_last', 'wf_sc_third_last');

function wf_sc_sc($atts, $content = '') {
  $out = '';

  $out .= '<pre><span class="shortcode-raw">' . $content . '</span></pre>';

  return $out;
}
add_shortcode('sc', 'wf_sc_sc');

function wf_sc_newsletter($atts, $content = '') {
  extract(shortcode_atts(array('default_name' => 'Enter your name ...', 'default_email' => 'Enter your email ...', 'button' => 'Subscribe Now'), $atts));
  $out = '';
  global $contact_js;
  $contact_js = true;

  if (!$content) {
    $content = '[title size="3"]Join our newsletter.[/title]<p>Stay up to date with the latest news.</p>';
  }
  $content = do_shortcode($content);

  $out .= '<form method="post" action="' . admin_url('admin-ajax.php') . '" id="newsletterform"><div><input type="text" class="input-field" id="newsletter-name" name="newsletter-name" placeholder="' . $default_name . '"></div><div><input type="text" class="input-field" id="newsletter-email" name="newsletter-email" placeholder="' . $default_email . '"></div><a id="newslettersubmit" href="#" class="newsletter-btn" title="' . $button . '">' . $button . '</a></form>';

  return $out;
}
add_shortcode('newsletter', 'wf_sc_newsletter');

function wf_sc_tabgroup($atts, $content = '') {
  global $tabs;
  $out = '';
  if (!is_array($tabs)) {
    $tabs = array();
  }
  $first_tab = sizeof($tabs);

  do_shortcode($content);

  if($tabs) {
    $out .= '<div class="tabbable"><ul class="nav nav-tabs">';
    for ($id = $first_tab; $id < sizeof($tabs); $id++) {
      $tab = $tabs[$id];

      if ($id == $first_tab) {
        $out .= '<li class="active"><a data-toggle="tab" href="#tab-' . $id .'" title="' . $tab['title'] .'">' . $tab['title'] . '</a></li>';
      } else {
        $out .= '<li><a data-toggle="tab" href="#tab-' . $id .'" title="' . $tab['title'] .'">' . $tab['title'] . '</a></li>';
      }
    } // foreach header
    $out .= '</ul>';

    $out .= '<div class="tab-content">';
    for ($id = $first_tab; $id < sizeof($tabs); $id++) {
      $tab = $tabs[$id];

      if ($id == $first_tab) {
        $out .= '<div class="tab-pane active" id="tab-' . $id . '">' . $tab['content'] . '</div>';
      } else {
        $out .= '<div class="tab-pane" id="tab-' . $id . '">' . $tab['content'] . '</div>';
      }
    } // foreach content

    $out .= '</div></div>';
  } // if tabs

  return $out;
}
add_shortcode('tabgroup', 'wf_sc_tabgroup');

function wf_sc_tab($atts, $content = ''){
  global $tabs;
  extract(shortcode_atts(array('title' => 'Default tab title'), $atts));

  $tabs[] = array('title' => $title, 'content' => do_shortcode($content));

  return null;
}
add_shortcode('tab', 'wf_sc_tab');

function wf_sc_spacer($atts, $content = '') {
  $out = '';

  $out .= '<div class="vertical-spacer"></div>';

  return $out;
}
add_shortcode('spacer', 'wf_sc_spacer');

function wf_theme_gallery_shortcode($attr, $content = '') {
  global $post, $prettyphoto_js, $gallery_instance;
  $gallery_instance++;
  $prettyphoto_js = true;

  if ( isset( $attr['orderby'] ) ) {
    $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
    if ( !$attr['orderby'] )
      unset( $attr['orderby'] );
  }

  extract(shortcode_atts(array(
    'order'      => 'ASC',
    'orderby'    => 'menu_order',
    'id'         => $post->ID,
    'itemtag'    => 'li',
    'icontag'    => 'div',
    'captiontag' => 'div',
    'columns'    => 4,
    'size'       => 'ens-gallery-thumb',
    'link'       => 'file',
    'include'    => '',
    'exclude'    => '',
    'lead_image' => false
  ), $attr));

  $id = intval($id);

  if ( 'RAND' == $order )
    $orderby = 'none';

  if ( !empty($include) ) {
    $include = preg_replace( '/[^0-9,]+/', '', $include );
    $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

    $attachments = array();
    foreach ( $_attachments as $key => $val ) {
      $attachments[$val->ID] = $_attachments[$key];
    }
  } elseif ( !empty($exclude) ) {
    $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
    $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
  } else {
    $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
  }

  if ( empty($attachments) )
    return '';

  if ( is_feed() ) {
    $output = "\n";
    foreach ( $attachments as $att_id => $attachment )
      $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
    return $output;
  }

  $itemtag = tag_escape($itemtag);
  $captiontag = tag_escape($captiontag);
  $columns = intval($columns);
  $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
  $float = is_rtl() ? 'right' : 'left';

  $selector = "gallery-{$gallery_instance}";

  $gallery_style = $gallery_div = '';

  $size_class = sanitize_html_class( $size );

  $output = '<div class="gallery">';
  $output .= '<ul class="thumbnails">';


  $i = 1;
  foreach ( $attachments as $id => $attachment ) {
    if ($i == 1 && $lead_image) {
      $span_size = 'span4';
      $size_tmp = $size . '-large';
    } else {
      if ($i % 4 == 0) {
        $span_size = 'span2';
      } else {
        $span_size = 'span2';
      }

      $size_tmp = $size;
    }
    $i++;
    $link = wp_get_attachment_link($id, $size_tmp, false, false);
    $link = str_replace('<a ', '<a data-gal="prettyPhoto[gallery1]" ', $link);

    $output .= "<{$itemtag} class='{$span_size}'>";
    $output .= "<{$icontag} class='thumbnail'>$link</{$icontag}>";
    if (0 && $captiontag && trim($attachment->post_excerpt)) {
      $output .= "<{$captiontag} class='wp-caption-text gallery-caption'>" . wptexturize($attachment->post_excerpt) . "</{$captiontag}>";
    }
    $output .= "</{$itemtag}>";
  }

  $output .= "</ul></div>\n";

  return $output;
} // wf_theme_gallery_shortcode
remove_shortcode('gallery');
add_shortcode('gallery', 'wf_theme_gallery_shortcode');

function wf_sc_portfolio($atts, $content = '') {
  global $prettyphoto_js, $filterable_js;
  $prettyphoto_js = $filterable_js = true;

  extract(shortcode_atts(array(), $atts));
  $out = '';

  global $post;
  $tmp_post = $post;

  if (is_front_page()) {
    $out .= '<div class="span12">';
  }
  $out .= '<ul id="filters" class="hidden-phone">';
  $out .= '<li><a class="current" href="#all">All</a></li>';
  $types = (array) get_terms('type', array('orderby' => 'name', 'hide_empty' => 0));
  foreach ($types as $type) {
    $out .= '<li><a href="#' . $type->slug . '">' . $type->name . '</a></li>';
  }
  $out .= '</ul>';
  if (is_front_page()) {
    $out .= '</div>';
  }

  $out .= '<div id="portfolio-gallery">';
  $portfolio = get_posts(array('numberposts' => -1, 'post_type'=> 'portfolio'));
  $i = 0;
  foreach ($portfolio as $post) {
    setup_postdata($post);

    if (!has_post_thumbnail($post->ID)) {
      continue;
    }

    $types = (array) wp_get_object_terms($post->ID, 'type');
    $tmp = $tmp2 = '';
    foreach ($types as $type) {
      $tmp .= ' ' . $type->slug;
      $tmp2 .= $type->name . ', ';
    } // foreach skill
    $tmp2 = trim($tmp2, ', ');

    $i++;
    if ($i % 4) {
      $quarter = 'span4 ';
    } else {
      $quarter = 'span4 ';
    }
    if (get_post_meta($post->ID, '_wf_theme_portfolio_link', true) && get_post_meta($post->ID, '_wf_theme_portfolio_link', true) != '#') {
      $iphone_link = '<a class="link-icon-iphone" href="' . get_post_meta($post->ID, '_wf_theme_portfolio_link', true) . '" target="_blank"><img src="' . get_template_directory_uri()  . '/images/icons/external-link.png" alt="Visit link"></a>';
    } elseif (get_post_meta($post->ID, '_wf_theme_portfolio_video', true)) {
      $iphone_link = '<a class="link-icon-iphone" href="' . get_post_meta($post->ID, '_wf_theme_portfolio_video', true) . '" target="_blank"><img src="' . get_template_directory_uri()  . '/images/icons/external-link.png" alt="Visit link"></a>';
    } else {
      $iphone_link = '';
    }

    $out .= '<div class="portfolio-item ' . $quarter . $tmp . '">';
    $out .= '<div class="post-box"><span class="over">';
    if (get_post_meta($post->ID, '_wf_theme_portfolio_link', true)) {
      $out .= '<a target="_blank" href="' . get_post_meta($post->ID, '_wf_theme_portfolio_link', true) . '" class="post-box-link">';
      $out .= '<img class="link-icon" src="' . get_template_directory_uri()  . '/images/icons/link-icon.png" alt="Visit link"></a>';
    }
    $big_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
    if (get_post_meta($post->ID, '_wf_theme_portfolio_video', true)) {
      $out .= '<a title="' . get_the_excerpt() . '" href="' . get_post_meta($post->ID, '_wf_theme_portfolio_video', true) . '" data-gal="prettyPhoto[portfolio]" class="post-box-link">';
    } else {
      $out .= '<a title="' . get_the_excerpt() . '" href="' . $big_img[0] . '" data-gal="prettyPhoto[portfolio]" class="post-box-link">';
    }
    $out .= '<img class="zoom-icon" src="' . get_template_directory_uri() . '/images/icons/zoom-icon.png" title="' . get_the_title()  . '" alt="' . get_the_title() . '"></a></span>';
    $thumb_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'ens-portfolio-thumb');
    $out .= '<img src="' . $thumb_img[0] . '" title="' . get_the_title() . '" alt="' . get_the_title() . '" />';
    $out .= '<div class="portfolio-details">';
    $out .= ' <div class="portfolio-title"><h3>' . get_the_title() . $iphone_link . '</h3></div>';
    $out .= ' <div class="portfolio-category"><p>' . $tmp2 . '</p></div>';
    $out .= '</div>';
    $out .= '</div></div>';
  } // foreach portfolio
  $out .= '</div>';

  $post = $tmp_post;
  return $out;
}
//add_shortcode('portfolio', 'wf_sc_portfolio');

function wf_sc_font_icon($atts, $content = '') {
  extract(shortcode_atts(array(
    'size' => '2x', 'class' => ''), $atts));
  $out = '';

  $content = str_replace(' ', '-', trim($content));
  if (substr($content, 0, 5) != 'icon-') {
   $content = 'icon-' . $content . ' ';
  }

  $size = strtolower($size);
  if ($size != 'large' && $size != '2x' && $size != '3x' && $size != '4x') {
    $size = 'large';
  }
  $size = 'icon-' . $size;

  $class = trim($class);
  $class = ' ' . $class . ' ';

  $out .= '<span class="' . $content . $class . $size . '"></span>';

  return $out;
}
add_shortcode('font_icon', 'wf_sc_font_icon');
add_shortcode('font-icon', 'wf_sc_font_icon');

function wf_sc_fp_widgets($atts, $content = '') {
  extract(shortcode_atts(array(), $atts));
  $out = '';

  if (is_active_sidebar('wf-front-page')) {
    ob_start();
    dynamic_sidebar('wf-front-page');
    $out = ob_get_clean();
  }

  return $out;
}
add_shortcode('fp_widgets', 'wf_sc_fp_widgets');
add_shortcode('fp-widgets', 'wf_sc_fp_widgets');

function wf_sc_screenshots($atts, $content = '') {
  global $post, $prettyphoto_js, $gallery_instance, $flexslider_js;
  @$gallery_instance++;
  $out = '';
  $prettyphoto_js = $flexslider_js = true;
  extract(shortcode_atts(array('post_id' => $post->ID), $atts));

  $images = get_children(array('post_parent' => $post_id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order'));
  if (!$images) {
    return '';
  }

  $out .= '<div class="flexslider-carousel"><ul class="slides">';
  foreach ($images as $image_id => $image) {
    $link = wp_get_attachment_link($image_id, 'per_screenshots', false, false);
    $link = str_replace('<a ', '<a data-gal="prettyPhoto[screenshots' . $gallery_instance . ']" ', $link);
    $out .= '<li>' . $link . '</li>';
  }
  $out .= '</ul></div>';

  return $out;
}
add_shortcode('screenshots', 'wf_sc_screenshots');

function wf_sc_faq($atts, $content = '') {
  extract(shortcode_atts(array('q' => 'Question'), $atts));
  $out = '';

  $out .= '<div class="faq">';
  $out .= '<div class="question"><span class="colored">Q</span>';
  $out .= '<p>' . $q . '</p></div>';
  $out .= '<p class="answer">' . do_shortcode($content) . '</p>';
  $out .= '</div>';

  return $out;
}
add_shortcode('faq', 'wf_sc_faq');

function wf_sc_superlist($atts, $content = '') {
  extract(shortcode_atts(array('title' => '', 'icon' => 'check'), $atts));
  $out = '';

  $out .= '<div class="superlist2">';
  $out .= '<span class="icon-' . $icon . ' icon-4x fonticon"></span>';
  $out .= '<div class="superlist-text">';
  $out .= '<span class="title">' . $title .'</span>';
  $out .= '<span class="subtitle">' . $content . '</span>';
  $out .= '</div>';
  $out .= '</div>';
  $out .= '<div class="clear"></div>';

  return $out;
}
add_shortcode('superlist', 'wf_sc_superlist');

function wf_sc_center($atts, $content = '') {
  extract(shortcode_atts(array(), $atts));
  $out = '';

  $out .= '<div class="center">' . do_shortcode($content) . '</div>';

  return $out;
}
add_shortcode('center', 'wf_sc_center');

function wf_sc_button_download($atts, $content = '') {
  extract(shortcode_atts(array(
    'href' => '#',
    'class' => '',
    'title' => 'Download now',
    'type' => 'apple',
    'target' => ''), $atts));
  $out = '';

  if ($target) {
   $target = 'target="' . $target . '"';
  }

  $type = strtolower($type);
  if ($type == 'android') {
    $type = 'appstore.png';
  } else {
    $type = 'googleplay.png';
  }

  $out .= '<span class="store-buttons"><a ' . $target . ' href="' . $href . '" title="' . $title . '"><img src="' . get_template_directory_uri() . '/images/' . $type . '" alt="' . $title . '"></a></span>';

  return $out;
}
add_shortcode('download-button', 'wf_sc_button_download');
add_shortcode('download_button', 'wf_sc_button_download');