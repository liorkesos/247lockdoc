<?php
/**
 * Permatex
 * (c) Web factory Ltd, 2013
 */

define('WF_THEME_NAME', 'Permatex');
define('WF_THEME_VERSION', '1.40');
define('WF_THEME_TEXTDOMAIN', 'wf_permatex');

require_once get_template_directory() . '/admin/common-functions.php';

if(is_demo() && file_exists(get_template_directory() . '/admin/demo-setup.php') && !current_user_can('administrator')) {
  require_once get_template_directory() . '/admin/demo-setup.php';
} else {
  define('WF_THEME_OPTIONS', 'per_theme_options');
}

require_once get_template_directory() . '/admin/theme-customize.php';
require_once get_template_directory() . '/admin/shortcodes.php';
require_once get_template_directory() . '/admin/widgets.php';
require_once get_template_directory() . '/admin/simple-page-ordering.php';

if (!version_compare(get_bloginfo('version'), 3.5, '>=')) {
  if (is_admin()) {
    add_action('admin_notices', 'wf_theme_min_version_notice');
  } else {
    echo '<p>' . __('<b>' . WF_THEME_NAME . '</b> theme requires <b>WordPress v3.5</b> or higher to function properly. Please upgrade.', WF_THEME_TEXTDOMAIN) . '</p>';
    die();
  }
}

function wf_theme_customize_enqueue() {
  wp_enqueue_style('wf-theme-admin', get_template_directory_uri() . '/admin/css/common.css', array(), WF_THEME_VERSION);
  wp_enqueue_style('wf-font-icons', get_template_directory_uri() . '/css/font-awesome.min.css', array(), WF_THEME_VERSION);
  wp_enqueue_style('wf-font-icons2', get_template_directory_uri() . '/css/font-awesome-ie7.min.css', array(), WF_THEME_VERSION);
  wp_enqueue_script('wf-theme-admin', get_template_directory_uri() . '/admin/js/common.js', array('jquery'), WF_THEME_VERSION);
} // wf_theme_customize_enqueue
add_action('customize_controls_enqueue_scripts', 'wf_theme_customize_enqueue');

function wf_theme_customizer_js() {
  wp_enqueue_script('wf-theme-admin', get_template_directory_uri() . '/admin/js/theme-customizer.js', array('jquery'), WF_THEME_VERSION);
} // wf_theme_cutomizer_js
add_action('customize_preview_init', 'wf_theme_customizer_js');

function wf_setup_theme(){
  add_theme_support('post-thumbnails');
  add_theme_support('automatic-feed-links');

  add_image_size('per-slider', 360, 480, true);
  add_image_size('per-gallery-thumb', 250, 190, true);
  add_image_size('per-gallery-thumb-large', 500, 390, true);
  add_image_size('per-screenshots', 250, 182, true);
  add_image_size('per-loop', 240, 170, true);

  add_filter('widget_text', 'do_shortcode');
  add_filter('widget_title', 'do_shortcode');

  register_nav_menu('primary', __('Primary Menu', WF_THEME_TEXTDOMAIN));
  register_nav_menu('front_page', __('Front Page Menu', WF_THEME_TEXTDOMAIN));

  global $primary_menu_options;
  $primary_menu_options = array('theme_location'  => 'primary',
                                'menu'            => __('Primary', WF_THEME_TEXTDOMAIN),
                                'depth'           => 2,
                                'container'       => false,
                                'container_class' => false,
                                'container_id'    => false,
                                'menu_class'      => false,
                                'menu_id'         => null,
                                'echo'            => false,
                                'fallback_cb'     => null,
                                'before'          => null,
                                'after'           => null,
                                'link_before'     => null,
                                'link_after'      => null,
                                'items_wrap'      => '<ul id="main-navigation" class="hidden-phone">%3$s</ul>');
  global $front_page_menu_options;
  $front_page_menu_options = array('theme_location'  => 'front_page',
                                   'menu'            => __('Front Page', WF_THEME_TEXTDOMAIN),
                                   'depth'           => 2,
                                   'container'       => false,
                                   'container_class' => false,
                                   'container_id'    => false,
                                   'menu_class'      => false,
                                   'menu_id'         => null,
                                   'echo'            => false,
                                   'fallback_cb'     => null,
                                   'before'          => null,
                                   'after'           => null,
                                   'link_before'     => null,
                                   'link_after'      => null,
                                   'items_wrap'      => '<ul id="main-navigation" class="hidden-phone">%3$s</ul>');

  load_theme_textdomain(WF_THEME_TEXTDOMAIN, get_template_directory() . '/languages');
} // wf_setup_theme
add_action('after_setup_theme', 'wf_setup_theme');

function wf_theme_widgets_init() {
  register_sidebar(array(
    'name' => __('Widgets Section on Front Page', WF_THEME_TEXTDOMAIN),
    'id' => 'wf-front-page',
    'description' => __('"Text with icon" widget looks best in this sidebar. Use the [fp-widgets] shortcode to place the sidebar anywhere you need it in sections on front page.', WF_THEME_TEXTDOMAIN),
    'before_widget' => '<div id="%1$s" class="span4 box %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  ));
  register_sidebar(array(
    'name' => __('Main Sidebar', WF_THEME_TEXTDOMAIN),
    'id' => 'wf-main',
    'description' => __('Sidebar area for all content except single pages.', WF_THEME_TEXTDOMAIN),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',
  ));
  register_sidebar(array(
    'name' => __('Pages Sidebar', WF_THEME_TEXTDOMAIN),
    'id' => 'wf-pages',
    'description' => __('Sidebar area for single pages.', WF_THEME_TEXTDOMAIN),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',
    ));
} // wf_theme_widgets_init
add_action('widgets_init', 'wf_theme_widgets_init');

function wf_theme_wp_print_scripts() {
  if (is_admin()) {
    return;
  }

  $out = '';

  if (wf_theme_get_option('color_main')) {
    $out .= '.twitter-image,#navigation ul li a:hover,a:hover.newsletter-btn,.section-black h3.section-title,a:hover.buy-btn,.section-grey .subtitle,.box:hover .box-icon,.box:hover h3,.callus,.logo-fontcon,#calltoaction-form .btn:hover { color: ' . wf_theme_get_option('color_main') . ';} ';
    $out .= '.section-colored,#teaser,#teaser-page,#calltoaction-form .btn,.faq .colored,a.buy-btn,a.newsletter-btn, .tagcloud a { background: ' . wf_theme_get_option('color_main') . '; } ';
    $out .= '.tagcloud a:before { border-color: transparent ' . wf_theme_get_option('color_main') . ' transparent transparent; } ';
  }

  if (wf_theme_get_option('color_background')) {
    $out .= 'body { background-color: ' . wf_theme_get_option('color_background') . '; } ';
  }

  if (wf_theme_get_option('color_header_background')) {
    $out .= 'header, .sub-menu { background-color: ' . wf_theme_get_option('color_header_background') . '; } ';
  }

  if (wf_theme_get_option('color_section_dark_background')) {
    $out .= '.section-black { background-color: ' . wf_theme_get_option('color_section_dark_background') . '; } ';
  }

  if (wf_theme_get_option('color_section_light_background')) {
    $out .= '.section-grey { background-color: ' . wf_theme_get_option('color_section_light_background') . '; } ';
  }

  if (wf_theme_get_option('color_text')) {
    $out .= 'body { color: ' . wf_theme_get_option('color_text') . '; } ';
  }

  if (wf_theme_get_option('color_link')) {
    $out .= 'a { color: ' . wf_theme_get_option('color_link') . '!important; } ';
  }
  if (wf_theme_get_option('color_link_menu')) {
    $out .= '#main-navigation a { color: ' . wf_theme_get_option('color_link_menu') . '!important; }';
  }
  if (wf_theme_get_option('color_h1')) {
    $out .= 'h1 { color: ' . wf_theme_get_option('color_h1') . '!important; }';
  }
  if (wf_theme_get_option('color_h2')) {
    $out .= 'h2 { color: ' . wf_theme_get_option('color_h2') . '!important; }';
  }
  if (wf_theme_get_option('color_h3')) {
    $out .= 'h3 { color: ' . wf_theme_get_option('color_h3') . '!important; }';
  }
  if (wf_theme_get_option('color_h4')) {
    $out .= 'h4 { color: ' . wf_theme_get_option('color_h4') . '!important; }';
  }

  if (wf_theme_get_option('custom_css')) {
    $out .= wf_theme_get_option('custom_css') . ' ';
  }

  if ($out) {
    $out = '<style media="all" id="wf-custom-css" type="text/css">' . $out . '</style>';
    echo "\n" . $out . "\n";
  }
} // wf_theme_wp_print_scripts
add_action('wp_print_scripts', 'wf_theme_wp_print_scripts');

function wf_theme_box_post() {
  global $post;
  $link = get_post_meta($post->ID, '_slide_link', true);

  wp_nonce_field('wf_theme_save', 'wf_theme_nonce');
  echo '<p>' . __('Following settings <b>apply only</b> to posts that are used in the header slider.', WF_THEME_TEXTDOMAIN) . '</p>';
  echo '<p><label for="wf_theme_link">' . __('Link:', WF_THEME_TEXTDOMAIN) . '</label> <input type="text" value="' . $link . '" class="regular-text" name="wf_slide_link" id="wf_slide_link" /></p>';
} // wf_theme_box_post

function wf_theme_box_section() {
  global $post;
  $subtitle = get_post_meta($post->ID, '_section_subtitle', true);
  $style = get_post_meta($post->ID, '_section_style', true);

  $styles = array();
  $styles[] = array('val' => 'section-black', 'label' => 'Dark');
  $styles[] = array('val' => 'section-grey', 'label' => 'Light');
  $styles[] = array('val' => 'section-colored', 'label' => 'Main site color');

 wp_nonce_field('wf_theme_save', 'wf_theme_nonce');
  echo '<p>' . __('Following settings <b>apply only</b> to pages with the "Front Page Section" template that are displayed on the front page. Please choose that template from the dropdown menu on the right if you want the page to appear on the front page.', WF_THEME_TEXTDOMAIN) . '</p>';

  echo '<p><label for="wf_section_subtitle">' . __('Subtitle:', WF_THEME_TEXTDOMAIN) . '</label> <input type="text" value="' . $subtitle . '" class="regular-text" name="wf_section_subtitle" id="wf_section_subtitle" /></p>';
  echo '<p><label for="wf_section_style">' . __('Background color:', WF_THEME_TEXTDOMAIN) . '</label> <select name="wf_section_style" id="wf_section_style">' . wf_theme_create_select_options($styles, $style, 0) . '</select></p>';
} // wf_theme_box_section

function wf_theme_add_meta_box() {
  add_meta_box('wf-theme-fp', __('Front Page Section Options', WF_THEME_TEXTDOMAIN), 'wf_theme_box_section', 'page', 'normal', 'high');

  add_meta_box('wf-theme-post', __('Slide Options', WF_THEME_TEXTDOMAIN), 'wf_theme_box_post', 'post', 'normal', 'high');

  add_meta_box('wf-theme-seo', __('SEO Options', WF_THEME_TEXTDOMAIN), 'wf_theme_box_seo', 'page', 'normal', 'high');
  add_meta_box('wf-theme-seo', __('SEO Options', WF_THEME_TEXTDOMAIN), 'wf_theme_box_seo', 'post', 'normal', 'high');
} // wf_theme_add_meta_box
add_action('add_meta_boxes', 'wf_theme_add_meta_box');

function wf_theme_save_postdata($post_id) {
  if (!wp_verify_nonce(@$_POST['wf_theme_nonce'], 'wf_theme_save') || (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)) {
    return $post_id;
  }

  if (isset($_POST['wf_theme_tagline'])) {
    update_post_meta($post_id, '_tagline', $_POST['wf_theme_tagline']);
  }
  if (isset($_POST['wf_slide_link'])) {
    update_post_meta($post_id, '_slide_link', $_POST['wf_slide_link']);
  }
  if (isset($_POST['wf_section_subtitle'])) {
    update_post_meta($post_id, '_section_subtitle', $_POST['wf_section_subtitle']);
    update_post_meta($post_id, '_section_style', $_POST['wf_section_style']);
  }
  if (isset($_POST['wf_theme_title'])) {
    update_post_meta($post_id, '_wf_theme_title', $_POST['wf_theme_title']);
    update_post_meta($post_id, '_wf_theme_description', $_POST['wf_theme_description']);
    update_post_meta($post_id, '_wf_theme_keywords', $_POST['wf_theme_keywords']);
  }

  return $post_id;
} // wf_theme_save_postdata
add_action('save_post', 'wf_theme_save_postdata');

function wf_theme_init() {
  global $wp_styles;

  if (!is_admin() && !wf_theme_is_login_page()) {
    wp_enqueue_style('wf-reset', get_template_directory_uri() . '/css/reset.css', array(), WF_THEME_VERSION);
    wp_enqueue_style('wf-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), WF_THEME_VERSION);
    wp_enqueue_style('wf-bootstrap-responsive', get_template_directory_uri() . '/css/bootstrap-responsive.min.css', array(), WF_THEME_VERSION);
    wp_enqueue_style('wf-style', get_template_directory_uri() . '/css/style.css', array(), WF_THEME_VERSION);
    wp_enqueue_style('wf-style-responsive', get_template_directory_uri() . '/css/style-responsive.css', array(), WF_THEME_VERSION);
    wp_enqueue_style('wf-prettyphoto', get_template_directory_uri() . '/css/prettyPhoto.css', array(), WF_THEME_VERSION);
    wp_enqueue_style('wf-fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), WF_THEME_VERSION);
    wp_enqueue_style('wf-font', get_template_directory_uri() . '/css/fonts/' . wf_theme_get_option('font') . '.css', array(), WF_THEME_VERSION);
    wp_enqueue_style('wf-ie7', get_template_directory_uri() . '/css/font-awesome-ie7.min.css', array(), WF_THEME_VERSION);
    $wp_styles->add_data('wf-ie7', 'conditional', 'IE 7');
    wp_enqueue_style('wf-ie8', get_template_directory_uri() . '/css/ie8.css', array(), WF_THEME_VERSION);
    $wp_styles->add_data('wf-ie8', 'conditional', 'IE 8' );
    wp_enqueue_style('wf_flexslider', get_template_directory_uri() . '/css/flexslider.css', array(), WF_THEME_VERSION);

    wp_enqueue_script('jquery');
    wp_enqueue_script('wf_bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), WF_THEME_VERSION, true);
    wp_enqueue_script('wf_twitter', get_template_directory_uri() . '/js/jquery.tweet.js', array('jquery'), WF_THEME_VERSION, true);
    wp_enqueue_script('wf_prettyphoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array('jquery'), WF_THEME_VERSION, true);
    wp_enqueue_script('wf_quvolver', get_template_directory_uri() . '/js/jquery.quovolver.js', array('jquery'), WF_THEME_VERSION, true);
    wp_enqueue_script('wf_form', get_template_directory_uri() . '/js/jquery.form.js', array('jquery'), WF_THEME_VERSION, true);
    wp_enqueue_script('wf_html5_placeholder', get_template_directory_uri() . '/js/jquery.html5-placeholder-shim.js', array('jquery'), WF_THEME_VERSION, true);
    wp_enqueue_script('wf_form_validate', get_template_directory_uri() . '/js/jquery.validate.js', array('jquery'), WF_THEME_VERSION, true);
    wp_enqueue_script('wf_flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', array('jquery'), WF_THEME_VERSION, true);
    wp_enqueue_script('wf_theme_common', get_template_directory_uri() . '/js/common.js', array('jquery'), WF_THEME_VERSION, true);
  }
  if (is_admin()) {
    wp_enqueue_style('wf-theme-admin', get_template_directory_uri() . '/admin/css/common.css', array(), WF_THEME_VERSION);
    wp_enqueue_script('wf-theme-admin', get_template_directory_uri() . '/admin/js/common.js', array('jquery'), WF_THEME_VERSION);

    if (strpos($_SERVER['REQUEST_URI'], 'widgets.php') !== false) {
      wp_enqueue_style('wf-fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), WF_THEME_VERSION);
      wp_enqueue_style('wf-ie7', get_template_directory_uri() . '/css/font-awesome-ie7.min.css', array(), WF_THEME_VERSION);
      $wp_styles->add_data('wf-ie7', 'conditional', 'if IE 7');
    }
  } // if is admin

  if (!session_id()) {
    @session_start();
  }
} // wf_theme_init
add_action('init', 'wf_theme_init');

function wf_theme_wp() {
  $wf_theme_js_vars = array('ajaxurl' => admin_url('admin-ajax.php'),
                            'theme_folder' => get_template_directory_uri(),
                            'theme_options' => WF_THEME_OPTIONS,
                            'is_home' => (int) is_home(),
                            'is_front_page' => (int) is_front_page(),
                            'newsletter_msg_ok' => wf_theme_get_option('newsletter_msg_ok'),
                            'slider_pause' => wf_theme_get_option('slider_pause'),
                            'slider_pause_hover' => wf_theme_get_option('slider_pause_hover'),
                            'slider_controls' => wf_theme_get_option('slider_controls'),
                            'slider_animation' => wf_theme_get_option('slider_animation'),
                            'contact_form_redirect_url' => wf_theme_get_option('contact_form_redirect_url'),
                            'contact_form_msg_ok' => wf_theme_get_option('contact_form_msg_ok'));

  wp_localize_script('jquery', 'wf_theme', $wf_theme_js_vars);
} // wf_theme_wp
add_action('wp', 'wf_theme_wp');

function wf_theme_ajax_newsletter() {
  require_once get_template_directory() . '/admin/newsletter-mailchimp.php';
} // wf_theme_ajax_newsletter
add_action('wp_ajax_wf_theme_newsletter', 'wf_theme_ajax_newsletter');
add_action('wp_ajax_nopriv_wf_theme_newsletter', 'wf_theme_ajax_newsletter');

function wf_theme_ajax_twitter_api() {
  require_once get_template_directory() . '/admin/twitter-api.php';
} // wf_theme_twitter_api
add_action('wp_ajax_wf_theme_twitter_api', 'wf_theme_ajax_twitter_api');
add_action('wp_ajax_nopriv_wf_theme_twitter_api', 'wf_theme_ajax_twitter_api');

function wf_theme_ajax_captcha() {
  if (isset($_REQUEST['check'])) {
      if (sanitize_text_field($_REQUEST['captcha']) == $_SESSION['captcha']) {
        die('true');
      } else {
        die('false');
      }
  } else {
    $a = rand(1, 10);
    $b = rand(1, 10);

    if ($a > $b) {
      $out = "$a - $b =";
      $_SESSION['captcha'] = $a - $b;
    } else {
      $out = "$a + $b =";
      $_SESSION['captcha'] = $a + $b;
    }
    die("$out");
  }
}
add_action('wp_ajax_wf_theme_captcha', 'wf_theme_ajax_captcha');
add_action('wp_ajax_nopriv_wf_theme_captcha', 'wf_theme_ajax_captcha');

function wf_theme_ajax_contact_send() {
  $details = $extra_details = '';
  $ok = 0;
  if (!session_id()) {
    @session_start();
  }
  
  if ($_POST['captcha'] != $_SESSION['captcha']) {
    die("-1");
  }
  
  $name = sanitize_text_field($_POST['name']);
  $email = sanitize_email($_POST['email']);
  $type = sanitize_text_field($_POST['type']);
  
  if (wf_theme_get_option('contact_form_extra_field')) {
    $extra = sanitize_text_field($_POST['extra']);
  }
  if (wf_theme_get_option('contact_form_extra_field2')) {
    $extra2 = sanitize_text_field($_POST['extra2']);
  }

  $details .= 'Name: ' . $name . "\r\n";
  $details .= 'Email: ' . $email . "\r\n";
  if ($type) {
    $details .= 'Type: ' . $type . "\r\n";
  }
  if (wf_theme_get_option('contact_form_details')) {
    $message = esc_html($_POST['message']);
    $details .= 'Message: ' . $message . "\r\n";
  }
  if (wf_theme_get_option('contact_form_extra_field')) {
    $details .= 'First extra field: ' . $extra . "\r\n";
  }
  if (wf_theme_get_option('contact_form_extra_field2')) {
    $details .= 'Second extra field: ' . $extra2 . "\r\n";
  }
  if (wf_theme_get_option('contact_form_file_upload')) {
    if (!function_exists('wp_handle_upload')) {
      require_once(ABSPATH . 'wp-admin/includes/file.php');
    }
    $movefile = wp_handle_upload($_FILES['fileattach'], array('test_form' => false, 'unique_filename_callback' => 'wf_unique_filename'));
    if ($movefile && isset($movefile['url'])) {
      $details .= 'Uploaded file: ' . $movefile['url'] . "\r\n";
    } else {
      die("-2");
    }
  }

  $extra_details .= "\r\n" . 'IP address: ' . $_SERVER['REMOTE_ADDR'] . "\r\n";
  $extra_details .= 'User agent: ' . $_SERVER['HTTP_USER_AGENT'] . "\r\n";

  $admin = "Someone has contacted you trough the site's contact form with the following details:\r\n{$details}{$extra_details}\r\nYou can reply to this email to respond.";

  $body = wf_theme_get_option('contact_form_email_body');
  $body .= "\r\n" . $details . $extra_details;

  $headers = 'Reply-to: ' . $name . ' <' . $email . '>' . "\r\n";
  $headers .= 'From: ' . get_bloginfo('name') . ' <' . get_bloginfo('admin_email') . '>' . "\r\n";
  $ok += wp_mail(wf_theme_get_option('contact_form_email_address'), wf_theme_get_option('contact_form_email_subject'), $body, $headers);

  if ($ok && wf_theme_get_option('contact_form_autoreply') && is_email($email)) {
    $headers = 'From: ' . get_bloginfo('name') . ' <' . wf_theme_get_option('contact_form_email_address') . '>' . "\r\n";
    $headers .= 'Reply-to: ' . wf_theme_get_option('contact_form_email_address') . "\r\n";
    wp_mail($email, wf_theme_get_option('contact_form_autoreply_subject'), wf_theme_get_option('contact_form_autoreply_body'), $headers);
  }
  
  // subscribe to newsletter?
  if ($ok && wf_theme_get_option('contact_form_mc_api_key') && wf_theme_get_option('contact_form_mc_list')) {
    require_once get_template_directory() . '/admin/form-mailchimp.php';
    
    $api = new MCAPI(wf_theme_get_option('contact_form_mc_api_key'));
    $listId = $api->lists(array('list_name' => wf_theme_get_option('contact_form_mc_list')), 0, 1);
    $listId = @$listId['data'][0]['id'];
    if ($listId) {
      $retval = $api->listSubscribe($listId, $email, array('FNAME' => $name), null, true, null, null, true);
    }
  }

  die("$ok");
}
add_action('wp_ajax_wf_theme_contact_send', 'wf_theme_ajax_contact_send');
add_action('wp_ajax_nopriv_wf_theme_contact_send', 'wf_theme_ajax_contact_send');

function wf_theme_dequeue_scripts() {
  global $twitter_js, $contact_js, $quote_js, $prettyphoto_js, $filterable_js, $flexslider_js;

  if (!$twitter_js) {
    wp_dequeue_script('wf_twitter');
  }
  if (!$contact_js) {
    wp_dequeue_script('wf_form');
    wp_dequeue_script('wf_form_validate');
  }
  if (!$quote_js) {
    wp_dequeue_script('wf_quvolver');
  }
  if (!$prettyphoto_js) {
    wp_dequeue_script('wf_prettyphoto');
  }
  if (!$flexslider_js) {
    wp_dequeue_script('wf_flexslider');
    wp_dequeue_style('wf_flexslider');
  }
}
add_action('wp_footer', 'wf_theme_dequeue_scripts');

function wf_theme_get_icons_list() {
  $icons_raw = 'icon-adjust,icon-adn,icon-align-center,icon-align-justify,icon-align-left,icon-align-right,icon-ambulance,icon-anchor,icon-android,icon-angle-down,icon-angle-left,icon-angle-right,icon-angle-up,icon-apple,icon-archive,icon-arrow-down,icon-arrow-left,icon-arrow-right,icon-arrow-up,icon-asterisk,icon-backward,icon-ban-circle,icon-bar-chart,icon-barcode,icon-beaker,icon-beer,icon-bell,icon-bell-alt,icon-bitbucket,icon-bitbucket-sign,icon-bold,icon-bolt,icon-book,icon-bookmark,icon-bookmark-empty,icon-briefcase,icon-btc,icon-bug,icon-building,icon-bullhorn,icon-bullseye,icon-calendar,icon-calendar-empty,icon-camera,icon-camera-retro,icon-caret-down,icon-caret-left,icon-caret-right,icon-caret-up,icon-certificate,icon-check,icon-check-empty,icon-check-minus,icon-check-sign,icon-chevron-down,icon-chevron-left,icon-chevron-right,icon-chevron-sign-down,icon-chevron-sign-left,icon-chevron-sign-right,icon-chevron-sign-up,icon-chevron-up,icon-circle,icon-circle-arrow-down,icon-circle-arrow-left,icon-circle-arrow-right,icon-circle-arrow-up,icon-circle-blank,icon-cloud,icon-cloud-download,icon-cloud-upload,icon-cny,icon-code,icon-code-fork,icon-coffee,icon-cog,icon-cogs,icon-collapse,icon-collapse-alt,icon-collapse-top,icon-columns,icon-comment,icon-comment-alt,icon-comments,icon-comments-alt,icon-compass,icon-copy,icon-credit-card,icon-crop,icon-css3,icon-cut,icon-dashboard,icon-desktop,icon-double-angle-down,icon-double-angle-left,icon-double-angle-right,icon-double-angle-up,icon-download,icon-download-alt,icon-dribbble,icon-dropbox,icon-edit,icon-edit-sign,icon-eject,icon-ellipsis-horizontal,icon-ellipsis-vertical,icon-envelope,icon-envelope-alt,icon-eraser,icon-eur,icon-exchange,icon-exclamation,icon-exclamation-sign,icon-expand,icon-expand-alt,icon-external-link,icon-external-link-sign,icon-eye-close,icon-eye-open,icon-facebook,icon-facebook-sign,icon-facetime-video,icon-fast-backward,icon-fast-forward,icon-female,icon-fighter-jet,icon-file,icon-file-alt,icon-file-text,icon-file-text-alt,icon-film,icon-filter,icon-fire,icon-fire-extinguisher,icon-flag,icon-flag-alt,icon-flag-checkered,icon-flickr,icon-folder-close,icon-folder-close-alt,icon-folder-open,icon-folder-open-alt,icon-font,icon-food,icon-forward,icon-foursquare,icon-frown,icon-fullscreen,icon-gamepad,icon-gbp,icon-gift,icon-github,icon-github-alt,icon-github-sign,icon-gittip,icon-glass,icon-globe,icon-google-plus,icon-google-plus-sign,icon-group,icon-hand-down,icon-hand-left,icon-hand-right,icon-hand-up,icon-hdd,icon-headphones,icon-heart,icon-heart-empty,icon-home,icon-hospital,icon-h-sign,icon-html5,icon-inbox,icon-indent-left,icon-indent-right,icon-info,icon-info-sign,icon-inr,icon-instagram,icon-italic,icon-jpy,icon-key,icon-keyboard,icon-krw,icon-laptop,icon-leaf,icon-legal,icon-lemon,icon-level-down,icon-level-up,icon-lightbulb,icon-link,icon-linkedin,icon-linkedin-sign,icon-linux,icon-list,icon-list-alt,icon-list-ol,icon-list-ul,icon-location-arrow,icon-lock,icon-long-arrow-down,icon-long-arrow-left,icon-long-arrow-right,icon-long-arrow-up,icon-magic,icon-magnet,icon-mail-reply-all,icon-male,icon-map-marker,icon-maxcdn,icon-medkit,icon-meh,icon-microphone,icon-microphone-off,icon-minus,icon-minus-sign,icon-minus-sign-alt,icon-mobile-phone,icon-money,icon-moon,icon-move,icon-music,icon-off,icon-ok,icon-ok-circle,icon-ok-sign,icon-paper-clip,icon-paste,icon-pause,icon-pencil,icon-phone,icon-phone-sign,icon-picture,icon-pinterest,icon-pinterest-sign,icon-plane,icon-play,icon-play-circle,icon-play-sign,icon-plus,icon-plus-sign,icon-plus-sign-alt,icon-print,icon-pushpin,icon-puzzle-piece,icon-qrcode,icon-question,icon-question-sign,icon-quote-left,icon-quote-right,icon-random,icon-refresh,icon-remove,icon-remove-circle,icon-remove-sign,icon-reorder,icon-repeat,icon-reply,icon-reply-all,icon-resize-full,icon-resize-horizontal,icon-resize-small,icon-resize-vertical,icon-retweet,icon-road,icon-rocket,icon-rss,icon-rss-sign,icon-save,icon-screenshot,icon-search,icon-share,icon-share-alt,icon-share-sign,icon-shield,icon-shopping-cart,icon-signal,icon-sign-blank,icon-signin,icon-signout,icon-sitemap,icon-skype,icon-smile,icon-sort,icon-sort-by-alphabet,icon-sort-by-alphabet-alt,icon-sort-by-attributes,icon-sort-by-attributes-alt,icon-sort-by-order,icon-sort-by-order-alt,icon-sort-down,icon-sort-up,icon-spinner,icon-stackexchange,icon-star,icon-star-empty,icon-star-half,icon-star-half-empty,icon-step-backward,icon-step-forward,icon-stethoscope,icon-stop,icon-strikethrough,icon-subscript,icon-suitcase,icon-sun,icon-superscript,icon-table,icon-tablet,icon-tag,icon-tags,icon-tasks,icon-terminal,icon-text-height,icon-text-width,icon-th,icon-th-large,icon-th-list,icon-thumbs-down,icon-thumbs-down-alt,icon-thumbs-up,icon-thumbs-up-alt,icon-ticket,icon-time,icon-tint,icon-trash,icon-trello,icon-trophy,icon-truck,icon-tumblr,icon-tumblr-sign,icon-twitter,icon-twitter-sign,icon-umbrella,icon-underline,icon-undo,icon-unlink,icon-unlock,icon-unlock-alt,icon-upload,icon-upload-alt,icon-usd,icon-user,icon-user-md,icon-vk,icon-volume-down,icon-volume-off,icon-volume-up,icon-warning-sign,icon-weibo,icon-windows,icon-wrench,icon-xing,icon-xing-sign,icon-youtube,icon-youtube-play,icon-youtube-sign,icon-zoom-in,icon-zoom-out';

  $icons_raw = explode(',', $icons_raw);
  $icons[''] = 'no icon';
  foreach ($icons_raw as $icon) {
    $icon = trim($icon);
    $tmp = str_replace('icon-', '', $icon);
    $tmp = str_replace('-', ' ', $tmp);
    $icons[$icon] = $tmp;
  }

  return $icons;
}

function wf_unique_filename($dir, $name, $ext) {
  $tmp = substr(md5(rand(1, 100000)), 0, 6) . '-' . $name . $ext;
  
  return $tmp;
}