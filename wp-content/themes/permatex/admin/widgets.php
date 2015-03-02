<?php
function wf_theme_widgets_register() {
  register_widget('textIconWidget');
}
add_action('widgets_init', 'wf_theme_widgets_register');


class textIconWidget extends WP_Widget {
  function textIconWidget() {
    $widget_ops = array('classname' => 'tiw', 'description' => 'Arbitrary text or HTML with an icon.');
    $control_ops = array('width' => 400, 'height' => 350);
    $this->WP_Widget('tiw', __('Text With Icon', WF_THEME_TEXTDOMAIN), $widget_ops, $control_ops);
  }

  function widget($args, $instance) {
    extract($args);
    $text = apply_filters('widget_text', $instance['text'], $instance);

    echo $before_widget;
    if ($instance['icon']) {
      echo '<div class="box-icon ' . $instance['icon'] . '"></div>';
    }
    if (!empty($instance['title'])) {
      echo $before_title . $instance['title'] . $after_title;
    }
    echo wpautop($text);    
    echo $after_widget;
  }

  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['icon'] = $new_instance['icon'];
    if (current_user_can('unfiltered_html')) {
      $instance['text'] =  $new_instance['text'];
    } else {
      $instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) );
    }

    return $instance;
  }

  function form($instance) {
    $instance = wp_parse_args((array) $instance, array('title' => '', 'text' => '', 'button' => '', 'button_href' => ''));
    $title = $instance['title'];
    $icon = $instance['icon'];
    $text = esc_textarea($instance['text']);
?>
    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', WF_THEME_TEXTDOMAIN); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

    <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
<?php
$icons_raw = 'icon-adjust,icon-adn,icon-align-center,icon-align-justify,icon-align-left,icon-align-right,icon-ambulance,icon-anchor,icon-android,icon-angle-down,icon-angle-left,icon-angle-right,icon-angle-up,icon-apple,icon-archive,icon-arrow-down,icon-arrow-left,icon-arrow-right,icon-arrow-up,icon-asterisk,icon-backward,icon-ban-circle,icon-bar-chart,icon-barcode,icon-beaker,icon-beer,icon-bell,icon-bell-alt,icon-bitbucket,icon-bitbucket-sign,icon-bold,icon-bolt,icon-book,icon-bookmark,icon-bookmark-empty,icon-briefcase,icon-btc,icon-bug,icon-building,icon-bullhorn,icon-bullseye,icon-calendar,icon-calendar-empty,icon-camera,icon-camera-retro,icon-caret-down,icon-caret-left,icon-caret-right,icon-caret-up,icon-certificate,icon-check,icon-check-empty,icon-check-minus,icon-check-sign,icon-chevron-down,icon-chevron-left,icon-chevron-right,icon-chevron-sign-down,icon-chevron-sign-left,icon-chevron-sign-right,icon-chevron-sign-up,icon-chevron-up,icon-circle,icon-circle-arrow-down,icon-circle-arrow-left,icon-circle-arrow-right,icon-circle-arrow-up,icon-circle-blank,icon-cloud,icon-cloud-download,icon-cloud-upload,icon-cny,icon-code,icon-code-fork,icon-coffee,icon-cog,icon-cogs,icon-collapse,icon-collapse-alt,icon-collapse-top,icon-columns,icon-comment,icon-comment-alt,icon-comments,icon-comments-alt,icon-compass,icon-copy,icon-credit-card,icon-crop,icon-css3,icon-cut,icon-dashboard,icon-desktop,icon-double-angle-down,icon-double-angle-left,icon-double-angle-right,icon-double-angle-up,icon-download,icon-download-alt,icon-dribbble,icon-dropbox,icon-edit,icon-edit-sign,icon-eject,icon-ellipsis-horizontal,icon-ellipsis-vertical,icon-envelope,icon-envelope-alt,icon-eraser,icon-eur,icon-exchange,icon-exclamation,icon-exclamation-sign,icon-expand,icon-expand-alt,icon-external-link,icon-external-link-sign,icon-eye-close,icon-eye-open,icon-facebook,icon-facebook-sign,icon-facetime-video,icon-fast-backward,icon-fast-forward,icon-female,icon-fighter-jet,icon-file,icon-file-alt,icon-file-text,icon-file-text-alt,icon-film,icon-filter,icon-fire,icon-fire-extinguisher,icon-flag,icon-flag-alt,icon-flag-checkered,icon-flickr,icon-folder-close,icon-folder-close-alt,icon-folder-open,icon-folder-open-alt,icon-font,icon-food,icon-forward,icon-foursquare,icon-frown,icon-fullscreen,icon-gamepad,icon-gbp,icon-gift,icon-github,icon-github-alt,icon-github-sign,icon-gittip,icon-glass,icon-globe,icon-google-plus,icon-google-plus-sign,icon-group,icon-hand-down,icon-hand-left,icon-hand-right,icon-hand-up,icon-hdd,icon-headphones,icon-heart,icon-heart-empty,icon-home,icon-hospital,icon-h-sign,icon-html5,icon-inbox,icon-indent-left,icon-indent-right,icon-info,icon-info-sign,icon-inr,icon-instagram,icon-italic,icon-jpy,icon-key,icon-keyboard,icon-krw,icon-laptop,icon-leaf,icon-legal,icon-lemon,icon-level-down,icon-level-up,icon-lightbulb,icon-link,icon-linkedin,icon-linkedin-sign,icon-linux,icon-list,icon-list-alt,icon-list-ol,icon-list-ul,icon-location-arrow,icon-lock,icon-long-arrow-down,icon-long-arrow-left,icon-long-arrow-right,icon-long-arrow-up,icon-magic,icon-magnet,icon-mail-reply-all,icon-male,icon-map-marker,icon-maxcdn,icon-medkit,icon-meh,icon-microphone,icon-microphone-off,icon-minus,icon-minus-sign,icon-minus-sign-alt,icon-mobile-phone,icon-money,icon-moon,icon-move,icon-music,icon-off,icon-ok,icon-ok-circle,icon-ok-sign,icon-paper-clip,icon-paste,icon-pause,icon-pencil,icon-phone,icon-phone-sign,icon-picture,icon-pinterest,icon-pinterest-sign,icon-plane,icon-play,icon-play-circle,icon-play-sign,icon-plus,icon-plus-sign,icon-plus-sign-alt,icon-print,icon-pushpin,icon-puzzle-piece,icon-qrcode,icon-question,icon-question-sign,icon-quote-left,icon-quote-right,icon-random,icon-refresh,icon-remove,icon-remove-circle,icon-remove-sign,icon-reorder,icon-repeat,icon-reply,icon-reply-all,icon-resize-full,icon-resize-horizontal,icon-resize-small,icon-resize-vertical,icon-retweet,icon-road,icon-rocket,icon-rss,icon-rss-sign,icon-save,icon-screenshot,icon-search,icon-share,icon-share-alt,icon-share-sign,icon-shield,icon-shopping-cart,icon-signal,icon-sign-blank,icon-signin,icon-signout,icon-sitemap,icon-skype,icon-smile,icon-sort,icon-sort-by-alphabet,icon-sort-by-alphabet-alt,icon-sort-by-attributes,icon-sort-by-attributes-alt,icon-sort-by-order,icon-sort-by-order-alt,icon-sort-down,icon-sort-up,icon-spinner,icon-stackexchange,icon-star,icon-star-empty,icon-star-half,icon-star-half-empty,icon-step-backward,icon-step-forward,icon-stethoscope,icon-stop,icon-strikethrough,icon-subscript,icon-suitcase,icon-sun,icon-superscript,icon-table,icon-tablet,icon-tag,icon-tags,icon-tasks,icon-terminal,icon-text-height,icon-text-width,icon-th,icon-th-large,icon-th-list,icon-thumbs-down,icon-thumbs-down-alt,icon-thumbs-up,icon-thumbs-up-alt,icon-ticket,icon-time,icon-tint,icon-trash,icon-trello,icon-trophy,icon-truck,icon-tumblr,icon-tumblr-sign,icon-twitter,icon-twitter-sign,icon-umbrella,icon-underline,icon-undo,icon-unlink,icon-unlock,icon-unlock-alt,icon-upload,icon-upload-alt,icon-usd,icon-user,icon-user-md,icon-vk,icon-volume-down,icon-volume-off,icon-volume-up,icon-warning-sign,icon-weibo,icon-windows,icon-wrench,icon-xing,icon-xing-sign,icon-youtube,icon-youtube-play,icon-youtube-sign,icon-zoom-in,icon-zoom-out';
$icons_raw = explode(',', $icons_raw);
$icons[] = array('val' => '', 'label' => 'no icon');
foreach ($icons_raw as $icon) {
  $tmp = str_replace('icon-', '', $icon);
  $tmp = str_replace('-', ' ', $tmp);
  $icons[] = array('val' => $icon, 'label' => $tmp);
}

    echo '<p><label for="' . $this->get_field_id('icon') . '">Icon:</label> <select style="vertical-align: baseline; margin: 20px 20px 0 0;" id="' . $this->get_field_id('icon') . '" name="' . $this->get_field_name('icon') . '">';
    self::create_select_options($icons, $instance['icon']);
    echo '</select>';
    if ($instance['icon']) {
      echo '<span style="line-height: 8px;" class="' . $instance['icon'] . ' icon-4x"></span>';
    }
    echo '<br /><i>Click "Save" to preview icon, or just look at the site preview if you are using the theme customizer.</i>';
    echo '</p>';
  } // form

  function create_select_options($options, $selected = null, $output = true) {
    $out = "\n";

    foreach ($options as $tmp) {
      if ($selected == $tmp['val']) {
        $out .= "<option selected=\"selected\" value=\"{$tmp['val']}\">{$tmp['label']}&nbsp;</option>\n";
      } else {
        $out .= "<option value=\"{$tmp['val']}\">{$tmp['label']}&nbsp;</option>\n";
      }
    }

    if($output) {
      echo $out;
    } else {
      return $out;
    }
  } // create_select_options
} // textIconWidget
?>