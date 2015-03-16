<?php
/**
 * Web factory Themes - Common functions
 * (c) Web factory Ltd, 2013
 */

if (!isset($content_width)) {
   $content_width = 1100;
}

function enable_threaded_comments() {
  if (!is_admin() && is_singular() && comments_open() && (get_option('thread_comments') == 1)) {
    wp_enqueue_script('comment-reply');
  }
} // enable threaded comments
add_action('get_header', 'enable_threaded_comments');

function wf_theme_get_option($name = false, $echo = false) {
  $options = get_option(WF_THEME_OPTIONS);
  if ($name) {
    if (!isset($options[$name])) {
      global $wf_theme_customize_options;
      $out = $wf_theme_customize_options[$name]['default'];
    } else {
      $out = $options[$name];
    }
  } else {
    $out = $options;
    if (!is_array($options)) {
      $options = array();
    }
  }

  if ($echo) {
    echo $out;
    return null;
  } else {
    return $out;
  }
} // wf_theme_get_option

function wf_theme_option($name = false) {
  return wf_theme_get_option($name, true);
} // wf_theme_option

function wf_theme_title() {
  global $post;

  if (is_singular() && get_post_meta($post->ID, '_wf_theme_title', true)) {
    $tmp = get_post_meta($post->ID, '_wf_theme_title', true);
    $tmp = str_replace(array('{site-title}', '{site-tagline}', '{site-description}', '{site-keywords}', '{page-title}'),
                       array(get_bloginfo('name'), get_bloginfo('description'), wf_theme_get_option('meta_description'), wf_theme_get_option('meta_keywords'), get_the_title($post->ID)),
                       $tmp);
    echo $tmp;
  } else {
      $org_title = wp_title('-', false, 'right');
      if (is_home() || is_front_page()) {
          $title = $title = get_bloginfo('title') . ' - ' . get_bloginfo('description', 'display');
      } else {
          $title = $org_title . get_bloginfo('title');
      }
      echo $title;
  }
} // wf_theme_title

function wf_theme_description() {
    global $post;

    if (is_singular() && get_post_meta($post->ID, '_wf_theme_description', true)) {
        $tmp = get_post_meta($post->ID, '_wf_theme_description', true);
        $tmp = str_replace(array('{site-title}', '{site-tagline}', '{site-description}', '{site-keywords}', '{page-title}'),
                           array(get_bloginfo('name'), get_bloginfo('description'), wf_theme_get_option('meta_description'), wf_theme_get_option('meta_keywords'), get_the_title($post->ID)),
                           $tmp);
        echo $tmp;
    } else {
        echo wf_theme_get_option('meta_description');
    }
} // wf_theme_description

function wf_theme_keywords() {
    global $post;

    if (is_singular() && get_post_meta($post->ID, '_wf_theme_keywords', true)) {
        $tmp = get_post_meta($post->ID, '_wf_theme_keywords', true);
        $tmp = str_replace(array('{site-title}', '{site-tagline}', '{site-description}', '{site-keywords}', '{page-title}'),
                           array(get_bloginfo('name'), get_bloginfo('description'), wf_theme_get_option('meta_description'), wf_theme_get_option('meta_keywords'), get_the_title($post->ID)),
                           $tmp);
        echo $tmp;
    } else {
        echo wf_theme_get_option('meta_keywords');
    }
} // wf_theme_keywords

function wf_theme_customize_redirect() {
  echo '<script type="text/javascript">window.location.href = "customize.php";</script>';
  echo '<p>If you are not automatically redirected <a href="customize.php">click here</a>.</p>';
} //wf_theme_customize_redirect

function wf_theme_export_options() {
  $data = wf_theme_get_option();
  $data = serialize($data);
  $data = base64_encode(gzdeflate($data, 9));

  return $data;
} // wf_theme_export_options

function wf_theme_import_options($data) {
  $data = @gzinflate(base64_decode(trim($data)));
  $data = @unserialize($data);

  if (is_array($data) && sizeof($data)) {
    update_option(WF_THEME_OPTIONS, $data);
    return true;
  } else {
    return false;
  }
} // wf_theme_import_options

function wf_theme_min_version_notice() {
  echo '<div class="error"><p>' . __('<b>' . WF_THEME_NAME . '</b> theme requires <b>WordPress v3.5</b> or higher to function properly.', WF_THEME_TEXTDOMAIN) .
       ' Please <a href="' . admin_url('update-core.php') . '">update</a> your WP core.</p></div>';
} // wf_theme_min_version_notice

function wf_theme_download_export() {
  if(isset($_GET['wf_theme_download_export']) && $_GET['wf_theme_download_export'] == '1') {
    $data = wf_theme_export_options();
    header('Content-type: text/plain');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename="' . sanitize_key(WF_THEME_NAME) . '-export-' . date('Y-m-d') . '.txt"');
    die($data);
  }
} // wf_theme_download_export
add_action('init', 'wf_theme_download_export');

function wf_theme_process_import() {
  if (isset($_POST['wf-theme-process-import'])) {
    if (!empty($_POST['wf-theme-import-options'])) {
      if (wf_theme_import_options($_POST['wf-theme-import-options'])) {
        add_settings_error('wf-theme-import-options', 'wf-theme-import-options', __('Options successfully imported.', WF_THEME_TEXTDOMAIN), 'updated');
      } else {
        add_settings_error('wf-theme-import-options', 'wf-theme-import-options', __('No options were imported. Provided import data is corrupted.', WF_THEME_TEXTDOMAIN));
      }
    } elseif (!empty($_FILES['wf-theme-import-options-file']['tmp_name'])) {
      if (is_uploaded_file($_FILES['wf-theme-import-options-file']['tmp_name'])) {
        $data = file_get_contents($_FILES['wf-theme-import-options-file']['tmp_name']);
        if (wf_theme_import_options($data)) {
          add_settings_error('wf-theme-import-options', 'wf-theme-import-options', __('Options successfully imported.', WF_THEME_TEXTDOMAIN), 'updated');
        } else {
          add_settings_error('wf-theme-import-options', 'wf-theme-import-options', __('No options were imported. Provided import file is corrupted.', WF_THEME_TEXTDOMAIN));
        }
      } else {
        add_settings_error('wf-theme-import-options', 'wf-theme-import-options', __('Problem uploading file.', WF_THEME_TEXTDOMAIN));
      }
    } else {
      add_settings_error('wf-theme-import-options', 'wf-theme-import-options', __('No options were imported. Either copy/paste the export data into the textarea or choose an export file.', WF_THEME_TEXTDOMAIN));
    }
  }
} // wf_theme_process_import

function wf_theme_process_demo_import() {
  if (!empty($_POST['wf-theme-import-demo-data'])) {
    require_once get_template_directory() . '/admin/import-demo.php';
    $tmp = wf_theme_import_demo();
    if ($tmp) {
      add_settings_error('wf-theme-import-demo', 'wf-theme-import-demo', __('Demo data imported!', WF_THEME_TEXTDOMAIN) . ' <a target="_blank" href="' . home_url(). '">View</a> or <a href="' . admin_url('customize.php') . '">customize</a> the site.', 'updated');
      if (!get_option('permalink_structure')) {
        add_settings_error('wf-theme-import-demo-permalinks', 'wf-theme-import-demo-permalinks', 'Please enable <a href="' .  admin_url('options-permalink.php') . '">permalinks</a>!', 'error');
      }
    }
  }
} // wf_theme_process_import

function wf_theme_process_options_reset() {
  if (isset($_POST['wf-theme-reset-options'])) {
    update_option(WF_THEME_OPTIONS, array());
    add_settings_error('wf-theme-reset-options', 'wf-theme-reset-options', __('Theme options have been successfully reset to default values.', WF_THEME_TEXTDOMAIN), 'updated');
  }
} // wf_theme_process_options_reset

function template_directory_uri() {
  echo get_template_directory_uri();
} // template_directory_uri

function is_demo() {
  if (strpos($_SERVER['HTTP_HOST'], '.webfactoryltd.com') !== false) {
    return true;
  } else {
    return false;
  }
} //is_demo

function is_theme_customize() {
  global $wp_customize;

  if (is_object($wp_customize) && $wp_customize->is_preview()) {
    return true;
  } else {
    return false;
  }
} // is_theme_customize

function wf_theme_admin_bar_render() {
  global $wp_admin_bar;

  if (current_user_can('edit_themes')) {
    $wp_admin_bar->add_menu( array(
      'parent' => false,
      'id' => 'customize-wf-theme',
      'title' => __('Customize Theme', WF_THEME_TEXTDOMAIN),
      'href' => admin_url('customize.php'),
      'meta' => false));
  }
} // wf_theme_admin_bar_render
add_action('wp_before_admin_bar_render', 'wf_theme_admin_bar_render');

function wf_theme_activated() {
  update_option('wf_theme_activated', true);
} // wf_theme_activated
add_action('after_switch_theme', 'wf_theme_activated');

function wf_theme_activated_notice() {
  $screen = get_current_screen();

  if (get_option('wf_theme_activated') && $screen->base != 'appearance_page_wf_theme_options') {
    echo '<div class="updated"><p>' . __('Thank you for activating <b>' . WF_THEME_NAME . '</b>!', WF_THEME_TEXTDOMAIN) . ' Please open <a href="' . admin_url('themes.php?page=wf_theme_options') . '">' . WF_THEME_NAME . ' Tools</a>
    to import demo data. It\'s the <b>fastest and easiest way</b> to setup the theme.</p></div>';
  }
} // wf_theme_activated_notice
add_action('admin_notices', 'wf_theme_activated_notice');

function wf_theme_body_class() {
  if (is_front_page()) {
    $tmp = get_body_class();
/*    foreach ($tmp as $i => $class) {
      if ($class == 'page') {
        unset($tmp[$i]);
        break;
      }
    } */
    
    $tmp = array();
    echo 'class="' . join(' ',$tmp ) . '"';
  } else {
    body_class('single');
  }
} // wf_theme_body_class

function wf_theme_sanitize_hex_color( $color ) {
  if (!$color || $color == 'false' )
    return '';

  // 3 or 6 hex digits, or the empty string.
  if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
    return $color;

  return null;
}

// check if user is on login page
function wf_theme_is_login_page() {
  $tmp = in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));

  return $tmp;
} // wf_theme_is_login_page

function wf_theme_add_options_page() {
  add_theme_page(__('Customize Theme', WF_THEME_TEXTDOMAIN), __('Customize Theme', WF_THEME_TEXTDOMAIN), 'edit_theme_options', 'wf_customize', 'wf_theme_customize_redirect');
  add_theme_page(__(WF_THEME_NAME . ' Tools', WF_THEME_TEXTDOMAIN), __(WF_THEME_NAME, WF_THEME_TEXTDOMAIN), 'edit_theme_options', 'wf_theme_options', 'wf_theme_options_page');
} // wf_theme_add_options_page
add_action('admin_menu', 'wf_theme_add_options_page');

function wf_theme_options_page() {
  update_option('wf_theme_activated', false);
  wf_theme_process_demo_import();
  wf_theme_process_import();
  wf_theme_process_options_reset();
  settings_errors();

  echo '<div class="wrap">' .  get_screen_icon('tools') . '<h2>' . WF_THEME_NAME . ' Tools</h2>';
  echo '<h3 class="title">Import Demo Data</h3>';
  echo '<p>Importing demo data (post, pages, images, theme settings, ...) is the easiest way to setup your theme. It will
  allow you to quickly edit everything instead of creating content from scratch. When you import the data following things will happen:</p>';
  echo '<ul class="bullets">
  <li>no existing posts, pages, categories, images, custom post types or any other data will be deleted or modified</li>
  <li>no WordPress settings will be modified except the site title and front page type</li>
  <li>about 10 posts, a few pages, 10+ images, some widgets and one menu will get imported</li>
  <li>images will be downloaded from our server; these images are copyrighted and watermarked by Envato\'s PhotoDune and are for demo use only</li>
  <li>please click import only once and wait, it can take a couple of minutes</li>
  </ul>';
  echo '<form method="post" action="' . admin_url('themes.php?page=wf_theme_options') .'">';
  echo get_submit_button('Import Demo Data', 'primary', 'wf-theme-import-demo-data');
  echo '</form>';

  echo '<hr /><h3 class="title">Theme Options</h3>';
  echo '<p>All theme options are configured using the built-in <a href="' . admin_url('customize.php') . '" title="Open Theme Customizer">Theme Customizer</a>.</p>';

  echo '<hr /><h3 class="title">Export Options</h3>';
  echo '<p>Please note: the export data contains <b>only</b> theme options. It doesn\'t contain any general WordPress
        settings found under the <i>Settings</i> menu, posts, pages, images or anything other besides settings found under <i>Theme - Customize</i>.</p>';
  echo '<textarea rows="3" cols="100" id="wf-theme-export-options">' . wf_theme_export_options() . '</textarea>';
  echo get_submit_button('Download Options Export', 'secondary', 'wf-theme-download-export');

  echo '<hr /><h3 class="title">Import Options</h3>';
  echo '<form method="post" enctype="multipart/form-data" action="' . admin_url('themes.php?page=wf_theme_options') .'">';
  echo '<p>Use only options exported from another site using the same version of ' . WF_THEME_NAME . ' theme.<br />
  Copy/paste the data into the textarea or choose a file with export data.</p>';
  echo '<textarea rows="3" cols="100" id="wf-theme-import-options" name="wf-theme-import-options"></textarea><br />';
  echo '<input type="file" name="wf-theme-import-options-file" />';
  echo get_submit_button('Import Options', 'secondary', 'wf-theme-process-import');
  echo '</form>';

  echo '<hr /><h3 class="title">Reset Options</h3>';
  echo '<form method="post" action="' . admin_url('themes.php?page=wf_theme_options') .'">';
  echo '<p>This will reset <b>only</b> the theme options to default values. No WordPress related options will be modified.<br />
  There is no undo! Export Options before resetting if you want to make a backup copy.</p>';
  echo get_submit_button('Reset Options', 'secondary', 'wf-theme-reset-options');
  echo '</form>';

  echo '</div>'; // wrap
} // wf_theme_options_page

function wf_theme_box_seo() {
    global $post;
    $title = get_post_meta($post->ID, '_wf_theme_title', true);
    $description = get_post_meta($post->ID, '_wf_theme_description', true);
    $keywords = get_post_meta($post->ID, '_wf_theme_keywords', true);

    wp_nonce_field('wf_theme_save', 'wf_theme_nonce');
    echo '<p><label for="wf_theme_title">Title:</label> <input type="text" value="' . $title . '" class="regular-text" name="wf_theme_title" id="wf_theme_title" /></p>';
    echo '<p><label for="wf_theme_description">Meta Description:</label> <input type="text" value="' . $description . '" class="regular-text" name="wf_theme_description" id="wf_theme_description" /></p>';
    echo '<p><label for="wf_theme_keywords">Meta Keywords:</label> <input type="text" value="' . $keywords . '" class="regular-text" name="wf_theme_keywords" id="wf_theme_keywords" /></p>';
    echo '<p><i>' . __('Available variables: {site-title}, {site-tagline}, {site-description}, {site-keywords} and {page-title}.', WF_THEME_TEXTDOMAIN) . '</i><br />';
    echo '<i>' . __('Leave any field blank to use the default value set in <a href="customize.php">theme customizer</a>.', WF_THEME_TEXTDOMAIN) . '</i></p>';
} // wf_theme_box_seo

  // helper function for creating dropdowns
function wf_theme_create_select_options($options, $selected = null, $output = true) {
  $out = "\n";

  foreach ($options as $tmp) {
    if ($selected == $tmp['val']) {
      $out .= "<option selected=\"selected\" value=\"{$tmp['val']}\">{$tmp['label']}&nbsp;</option>\n";
    } else {
      $out .= "<option value=\"{$tmp['val']}\">{$tmp['label']}&nbsp;</option>\n";
    }
  } // foreach

  if ($output) {
    echo $out;
  } else {
    return $out;
  }
} // create_select_options

function wf_theme_comment($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment;

  echo '<li ' . comment_class('', NULL, NULL, false) . ' id="li-comment-' . get_comment_ID() . '">';
  echo '<div id="comment-' . get_comment_ID() . '"><div class="comment-author vcard">';
  echo get_avatar($comment, $size = '48');
  printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>', WF_THEME_TEXTDOMAIN), get_comment_author_link());
  echo '</div>';
  if ($comment->comment_approved == '0') {
    echo '<em>' . __('Your comment is awaiting moderation.', WF_THEME_TEXTDOMAIN) . '</em>';
    echo '<br />';
  }

  echo '<div class="comment-meta commentmetadata">';
  echo '<a href="' . htmlspecialchars(get_comment_link($comment->comment_ID)) . '">';
  printf('%1$s at %2$s', get_comment_date(), get_comment_time());
  echo '</a>';
  edit_comment_link('(Edit)', '  ', '');
  echo '</div>';
  comment_text();
  echo '<div class="reply">';
  comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'])));
  echo '</div></div>';
} // wf_theme_comment

function wf_theme_manage_pages_columns($columns) {
  $columns['template'] = __('Template', WF_THEME_TEXTDOMAIN);

  return $columns;
} // wf_theme_manage_pages_columns
add_filter('manage_pages_columns', 'wf_theme_manage_pages_columns', 10, 2);

function wf_theme_manage_pages_custom_column($column_name, $post_id) {
  global $post_type;

  if ($column_name == 'template') {
    $tmp = get_file_description(get_page_template($post_id));
    $tmp = str_replace('Page Template', '', $tmp);
    $tmp = trim($tmp);
    if(empty($tmp)) {
      $tmp = 'Default Page Template';
    }
    echo $tmp;
  }
} //wf_theme_manage_pages_custom_column
add_action('manage_pages_custom_column', 'wf_theme_manage_pages_custom_column', 10, 2);

function wf_theme_exclude_category($query) {
  if ($query->is_home() && wf_theme_get_option('slider_category')) {
    $query->set('cat', '-' . wf_theme_get_option('slider_category'));
  }
  return $query;
}
add_filter('pre_get_posts', 'wf_theme_exclude_category');