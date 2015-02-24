<?php
/**
 * Web factory themes framework
 * (c) Web factory Ltd, 2013
 */

  @session_start();
  define('DISALLOW_FILE_EDIT', true);
  define('WF_THEME_DEMO', true);
  define('WF_THEME_OPTIONS', 'wf_theme_options_tmp_' . session_id());

  // custom defaults for demo
  if (!get_option(WF_THEME_OPTIONS)) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'terms';

    $menu_id1 = $wpdb->get_var("SELECT term_id FROM $table_name where slug = 'permatex-primary'");
    $menu_id2 = $wpdb->get_var("SELECT term_id FROM $table_name where slug = 'permatex-front-page'");
    set_theme_mod('nav_menu_locations', array('primary' => $menu_id1, 'front_page' => $menu_id2));
    
    $tmp['twitter_consumer_key'] = 'C4udTosNPCjzzA6ZwtANw';
    $tmp['twitter_consumer_secret'] = 'xtObA8oRTTFbst2oBbES2a1ndFRL57qfqJHKImedQ';
    $tmp['twitter_user_token'] = '145670592-EkYvGKgL5XTng6BcPYhgGGHEZCTMulgapCBH0Maq';
    $tmp['twitter_user_secret'] = '2gPaTQLuvudh3f0xQMvEnn69agfTQ7ajLINa8oQEm0';
    
    $tmp['slider_category'] = 10;
    $tmp['page_404_id'] = 196;
    $tmp['tagline'] = '[title size="2"]Permatex is a responsive, product focused WordPress theme. [/title] [button href="http://themeforest.net/item/permatex-responsive-wordpress-video-landing-page/4892919?ref=WebFactory" class="box-btn"]Buy it now![/button]';
    $tmp['tagline_video'] = '[title size="2"]Welcome to Permatex![/title] [button href="http://themeforest.net/item/permatex-responsive-wordpress-video-landing-page/4892919?ref=WebFactory" class="box-btn"]Buy this landing page for only $35 and put your products in the focus![/button]';
    $tmp['footer_copyright'] = 'Copyright <a href="http://www.webfactoryltd.com/">Web factory Ltd</a> 2013.';
    update_option(WF_THEME_OPTIONS, $tmp);
  }

  add_filter('logout_url', 'wf_theme_admin_redirect');
  function wf_theme_admin_redirect($redirect_to, $url_redirect_to = '', $user = null) {
    return 'http://permatex-wp.webfactoryltd.com/';
  }

  if(is_admin() && (!defined('DOING_AJAX') || !@DOING_AJAX) && strpos($_SERVER['SCRIPT_FILENAME'], 'wp-admin/customize.php') === false && strpos($_SERVER['SCRIPT_FILENAME'], 'wp-admin/async-upload.php') === false) {
    header('location: /demo-logout.php');
  }

  wp_enqueue_style('wf-demo', get_template_directory_uri() . '/admin/css/demo.css', array(), WF_THEME_VERSION);

  function customize_theme_button() {
    if(is_demo() && !is_theme_customize() && !current_user_can('administrator')) {
      echo '<div class="options-panel-closed hidden-phone hidden-tablet">';
      echo '<a target="_parent" href="/demo-login.php" title="Customize the theme">';
      echo '<span class="customize">';
      echo 'Click here<br />to customize<br />the theme</span>';
      echo '<img src="' . get_template_directory_uri() . '/admin/images/tools-white.png" width="64" alt="Customize the theme" title="Customize the theme" />';
      echo '</a></div>';
    }
  } // customize_theme_button
  add_action('wp_footer', 'customize_theme_button');