<?php
/**
 * Permatex
 * (c) Web factory Ltd, 2013
 */

  function wf_theme_import_demo_misc() {
    global $wpdb;
    $options = array();

    $slider = (int) get_category_by_slug('header-slider')->term_id;
    $page_404 = get_page_by_title('Page not found (error 404)');
    $page_header = get_page_by_title('Super Effective');
    $page_blog = get_page_by_path('blog');
    $page_front = get_page_by_path('front-page');

    $options['slider_category'] = $slider;
    $options['page_404_id'] = $page_404->ID;
    $options['header_page_id'] = $page_header->ID;
    update_option(WF_THEME_OPTIONS, $options);

    update_option('blogname', 'Permatex');
    update_option('show_on_front', 'page');

    update_option('page_for_posts', $page_blog->ID);
    update_option('page_on_front', $page_front->ID);
  } // wf_theme_import_demo_misc

  function wf_theme_import_demo_widgets() {
    $sidebars = get_option('sidebars_widgets');
    $sidebars['wf-main'] = array('search-21', 'text-21');
    $sidebars['wf-pages'] = array('search-22', 'text-22');
    $sidebars['wf-front-page'] = array('tiw-27', 'tiw-28', 'tiw-29', 'tiw-30', 'tiw-31', 'tiw-32');
    update_option('sidebars_widgets', $sidebars);

    $search = get_option('widget_search');
    $search[21] = $search[22] = array('title' => 'Search');
    $search['_multiwidget'] = 1;
    update_option('widget_search', $search);

    $text = get_option('widget_text');
    $text[21] = array('title' => 'This is the "main" sidebar', 'filter' => true, 'text' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.');
    $text[22] = array('title' => 'This is the "pages" sidebar', 'filter' => true, 'text' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.');
    $text['_multiwidget'] = 1;
    update_option('widget_text', $text);

    $tiw = get_option('widget_tiw');
    $tiw[27] = array('title' => 'Sample title', 'icon' => 'icon-play-circle', 'text' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Suspendisse nec urna et nulla viverra semper.', 'button' => 'Watch video', 'button_href' => '#top');
    $tiw[28] = array('title' => 'Sample title', 'icon' => 'icon-pencil', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nec urna et nulla viverra semper.', 'button' => 'View blog', 'button_href' => '/blog/');
    $tiw[29] = array('title' => 'Sample title', 'icon' => 'icon-wrench', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nec urna et nulla viverra semper.', 'button' => 'Shortcodes', 'button_href' => '/shortcodes/');
    $tiw[30] = array('title' => 'Sample title', 'icon' => 'icon-cogs', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nec urna et nulla viverra semper.', 'button' => 'Customize', 'button_href' => '#');
    $tiw[31] = array('title' => 'Sample title', 'icon' => 'icon-cog', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nec urna et nulla viverra semper.', 'button' => 'Customize', 'button_href' => '#');
    $tiw[32] = array('title' => 'Sample title', 'icon' => 'icon-heart', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nec urna et nulla viverra semper.', 'button' => 'Customize', 'button_href' => '#');
    $tiw['_multiwidget'] = 1;
    update_option('widget_tiw', $tiw);


  } // wf_theme_import_demo_widgets

  function wf_theme_import_demo_menus() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'terms';

    $menu_id1 = $wpdb->get_var("SELECT term_id FROM $table_name where slug = 'permatex-primary'");
    $menu_id2 = $wpdb->get_var("SELECT term_id FROM $table_name where slug = 'permatex-front-page'");
    set_theme_mod('nav_menu_locations', array('primary' => $menu_id1, 'front_page' => $menu_id2));
  } // wf_theme_import_demo_menus

  function wf_theme_import_demo_xml(){
    $error = false;
    if (!defined('WP_LOAD_IMPORTERS')) {
      define('WP_LOAD_IMPORTERS', true);
    }
    require_once ABSPATH . 'wp-admin/includes/import.php';

    if (!class_exists('WP_Import')) {
      $class_wp_import = get_template_directory() . '/admin/wordpress-importer/wordpress-importer.php';
      if (file_exists($class_wp_import)) {
        require_once($class_wp_import);
      } else {
        $error = true;
      }
    }

    if ($error) {
      add_settings_error('wf-theme-import-demo', 'wf-theme-import-demo', __('Demo data import failed! Try importing manually trough Tools - Import.', WF_THEME_TEXTDOMAIN), 'error');
      return false;
    } else {
      if(!is_file(get_template_directory() . '/admin/demo-data.xml')) {
        add_settings_error('wf-theme-import-demo', 'wf-theme-import-demo', __('Demo data XML file is missing.', WF_THEME_TEXTDOMAIN), 'error');
        return false;
      } else {
        ob_start();
        $wp_import = new wp_import();
        $wp_import->fetch_attachments = true;
        $wp_import->import(get_template_directory() . '/admin/demo-data.xml');
        ob_end_clean();
      }
    }

    return true;
  } // wf_theme_import_demo_xml

  function wf_theme_import_demo() {
    $xml = wf_theme_import_demo_xml();
    if ($xml) {
      wf_theme_import_demo_misc();
      wf_theme_import_demo_widgets();
      wf_theme_import_demo_menus();

      return true;
    } else {
      return false;
    }
  } // wf_theme_import_demo