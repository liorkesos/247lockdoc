<?php
/**
 * Permatex
 * (c) Web factory Ltd, 2013
 */

$wf_theme_customize_options = array(
  'dummy' => array('default' => ''),
  'meta_author' => array('default' => 'Your company Ltd, 2013.'),
  'meta_description' => array('default' => 'Awesome WordPress site based on the Permatex theme.'),
  'meta_keywords' => array('default' => 'leads, creative, video, portfolio, awesome, wordpress, theme, wp'),
  'favicon' => array('default' => get_template_directory_uri() . '/images/favicon.ico'),

  'font' => array('default' => 'passion', 'transport' => 'postMessage'),
  'color_main' => array('default' => '#c0392b', 'sanitize_callback' => 'wf_theme_sanitize_hex_color', 'transport' => 'postMessage'),
  'color_background' => array('default' => '', 'sanitize_callback' => 'wf_theme_sanitize_hex_color'),
  'color_header_background' => array('default' => '', 'sanitize_callback' => 'wf_theme_sanitize_hex_color'),
  'color_section_light_background' => array('default' => '', 'sanitize_callback' => 'wf_theme_sanitize_hex_color'),
  'color_section_dark_background' => array('default' => '', 'sanitize_callback' => 'wf_theme_sanitize_hex_color'),
  'color_text' => array('default' => '', 'sanitize_callback' => 'wf_theme_sanitize_hex_color'),
  'color_link' => array('default' => '', 'sanitize_callback' => 'wf_theme_sanitize_hex_color'),
  'color_link_menu' => array('default' => '', 'sanitize_callback' => 'wf_theme_sanitize_hex_color'),
  'color_h1' => array('default' => '', 'sanitize_callback' => 'wf_theme_sanitize_hex_color'),
  'color_h2' => array('default' => '', 'sanitize_callback' => 'wf_theme_sanitize_hex_color'),
  'color_h3' => array('default' => '', 'sanitize_callback' => 'wf_theme_sanitize_hex_color'),
  'color_h4' => array('default' => '', 'sanitize_callback' => 'wf_theme_sanitize_hex_color'),
  'custom_css' => array('default' => ''),

  'logo' => array('default' => get_template_directory_uri() . '/images/permatex-logo.png'),
  'logo_icon' => array('default' => 'icon-magic'),

  'header_type' => array('default' => '1'),
  'header_page_id' => array('default' => '0'),
  'header_tagline' => array('default' => '[center]Welcome to Permatex![/center]'),

  'slider_category' => array('default' => '0'),
  'slider_pause' => array('default' => '3000'),
  'slider_pause_hover' => array('default' => '1'),
  'slider_controls' => array('default' => '1'),
  'slider_animation' => array('default' => 'fade'),

  'newsletter_api_key' => array('default' => '#'),
  'newsletter_list' => array('default' => '#'),
  'newsletter_msg_ok' => array('default' => 'Thank you for subscribing! Please confirm your subscription in the email you\'ll receive shortly.'),

  'footer_copyright' => array('default' => 'Copyright <a href="#">yourcompany.com</a> 2013.'),
  'footer_totop' => array('default' => '1'),
  'footer_logo' => array('default' => get_template_directory_uri() . '/images/permatex-footer-logo.png'),

  'page_404_id' => array('default' => '0'),
  'post_social' => array('default' => '1'),

  'twitter_consumer_key' => array('default' => ''),
  'twitter_consumer_secret' => array('default' => ''),
  'twitter_user_token' => array('default' => ''),
  'twitter_user_secret' => array('default' => ''),

  'contact_form_title' => array('default' => 'Request a quote now!'),
  'contact_form_subtitle' => array('default' => 'Our agents are standing by locked & loaded'),
  'contact_form_name' => array('default' => 'Your name'),
  'contact_form_email' => array('default' => 'Your email'),
  'contact_form_type' => array('default' => ' - tell us what you need - '),
  'contact_form_type_values' => array('default' => "a website\na landing page\nan iPhone app\nan Android app\na WordPress theme"),
  'contact_form_details' => array('default' => 'Details ...'),
  'contact_form_file_upload' => array('default' => 'Please attach your project file.'),
  'contact_form_extra_field' => array('default' => ''),
  'contact_form_extra_field2' => array('default' => ''),
  'contact_form_button' => array('default' => 'Get a quote!'),
  'contact_form_email_address' => array('default' => get_option('admin_email')),
  'contact_form_email_subject' => array('default' => 'New contact from your website'),
  'contact_form_email_body' => array('default' => 'Someone has contacted you trough the site\'s contact form with the following details; '),
  'contact_form_msg_ok' => array('default' => 'Thank you for contacting us! We\'ll get back to you ASAP.'),
  'contact_form_redirect_url' => array('default' => ''),
  'contact_form_autoreply' => array('default' => '0'),
  'contact_form_autoreply_subject' => array('default' => 'Thank you for contacting us'),
  'contact_form_autoreply_body' => array('default' => "We have received your email and will get back to you ASAP.\n\nHave a great day!"),
  'contact_form_mc_api_key' => array('default' => ''),
  'contact_form_mc_list' => array('default' => '')
  );

function wf_theme_customize_register($wp_customize) {
  global $wf_theme_customize_options;
  require get_template_directory() . '/admin/theme-customize-custom-controls.php';

  // register sections
  $wp_customize->add_section('title_tagline', array('title' => __('Title, Metadata & SEO', WF_THEME_TEXTDOMAIN), 'priority' => 20));
  $wp_customize->add_section('wf_style', array('title' => __('Colors, Fonts & CSS', WF_THEME_TEXTDOMAIN), 'priority' => 25));
  $wp_customize->add_section('wf_header', array('title' => __('Header', WF_THEME_TEXTDOMAIN), 'priority' => 30));
  $wp_customize->add_section('wf_frontpage', array('title' => __('Front Page', WF_THEME_TEXTDOMAIN), 'priority' => 35));
  $wp_customize->add_section('wf_footer', array('title' => __('Footer', WF_THEME_TEXTDOMAIN), 'priority' => 40));
  $wp_customize->add_section('wf_newsletter', array('title' => __('Newsletter', WF_THEME_TEXTDOMAIN), 'priority' => 45));
  $wp_customize->add_section('wf_contact_form', array('title' => __('Contact Form', WF_THEME_TEXTDOMAIN), 'priority' => 37));
  $wp_customize->add_section('wf_twitter', array('title' => __('Twitter Feed', WF_THEME_TEXTDOMAIN), 'priority' => 48));
  $wp_customize->add_section('wf_misc', array('title' => __('Miscellaneous', WF_THEME_TEXTDOMAIN), 'priority' => 50));

  // register settings
  $default_setting_details = array('type' => 'option', 'default' => '', 'transport' => 'refresh');
  foreach ($wf_theme_customize_options as $option_name => $details) {
    if (substr($option_name, 0, 1) == '_') {
      continue;
    }
    $details = array_merge($default_setting_details, $details);
    $wp_customize->add_setting(WF_THEME_OPTIONS . '[' . $option_name . ']', $details);
  }

  // section - title
  $wp_customize->get_control('blogdescription')->label = 'Site Tagline';
  $wp_customize->get_control('blogname')->priority = 1;
  @$wp_customize->get_control('nav_menu_locations[primary]')->label = 'Menu';
  @$wp_customize->get_control('nav_menu_locations[primary]')->section = 'wf_header';
  @$wp_customize->get_control('nav_menu_locations[primary]')->priority = 15;
  @$wp_customize->get_control('nav_menu_locations[front_page]')->label = 'Menu';
  @$wp_customize->get_control('nav_menu_locations[front_page]')->section = 'wf_frontpage';
  @$wp_customize->get_control('nav_menu_locations[front_page]')->priority = 2;

  $wp_customize->add_control(new WP_Customize_Textarea($wp_customize, 'meta_description', array(
   'label'   => 'Meta Description',
   'section' => 'title_tagline',
   'settings'   => WF_THEME_OPTIONS . '[meta_description]' )));
  $wp_customize->add_control('meta_keywords', array(
    'label'   => 'Meta Keywords',
    'section' => 'title_tagline',
    'settings' => WF_THEME_OPTIONS . '[meta_keywords]',
    'type'    => 'text'));
  $wp_customize->add_control(new WP_Customize_Help($wp_customize, 'seo_help', array(
    'label'    => 'SEO options can be configured for each individual post and page when editing them. The settings above are used for the front page and as default values.',
    'section'  => 'title_tagline',
    'settings' => WF_THEME_OPTIONS . '[dummy]')));
  $wp_customize->add_control('meta_author', array(
    'label'   => 'Meta Author',
    'section' => 'title_tagline',
    'settings' => WF_THEME_OPTIONS . '[meta_author]',
    'type'    => 'text'));
  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'favicon', array(
   'label'   => 'Favicon',
   'section' => 'title_tagline',
   'settings'   => WF_THEME_OPTIONS . '[favicon]')));

  // section - style
  $wp_customize->add_control('font', array(
    'label'   => 'Font',
    'section' => 'wf_style',
    'priority' => 0,
    'settings' => WF_THEME_OPTIONS . '[font]',
    'type'    => 'select',
    'choices' => array(
        'allerta' => 'Allerta',
        'arial' => 'Arial',
        'cabin' => 'Cabin',
        'capriola' => 'Capriola',
        'chivo' => 'Chivo',
        'doppioone' => 'Doppio One',
        'hammersmithone' => 'Hammersmith One',
        'montserrat' => 'Montserrat',
        'opensans' => 'Open Sans',
        'passion' => 'Passion (default)',
        'ubuntu' => 'Ubuntu')));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_main', array(
    'label'    => 'Main Color',
    'section'  => 'wf_style',
    'priority' => 1,
    'settings' => WF_THEME_OPTIONS . '[color_main]')));
  $wp_customize->add_control(new WP_Customize_Predefined_Colors($wp_customize, 'predefined_colors', array(
    'label'   => 'Predefined colors:',
    'colors'  => array('#9b59b6', '#2980b9', '#3498db', '#2ecc71', '#16a085', '#27ae60', '#f39c12', '#c0392b', '#d35400', '#bdc3c7', '#f1c40f'),
    'section' => 'wf_style',
    'priority' => 1,
    'settings' => WF_THEME_OPTIONS . '[dummy]')));
  $wp_customize->add_control(new WP_Customize_Help($wp_customize, 'custom_color_help', array(
    'label'   => 'Changing the settings below will significantly alter the theme\'s design. We recommend using only the two main settings above.',
    'section' => 'wf_style',
    'priority' => 2,
    'settings' => WF_THEME_OPTIONS . '[dummy]')));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_background', array(
    'label'    => 'Background Color',
    'section'  => 'wf_style',
    'priority' => 3,
    'settings' => WF_THEME_OPTIONS . '[color_background]')));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_header_background', array(
    'label'    => 'Header Background Color',
    'section'  => 'wf_style',
    'priority' => 3,
    'settings' => WF_THEME_OPTIONS . '[color_header_background]')));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_section_dark_background', array(
    'label'    => 'Dark Section Background Color',
    'section'  => 'wf_style',
    'priority' => 4,
    'settings' => WF_THEME_OPTIONS . '[color_section_dark_background]')));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_section_light_background', array(
    'label'    => 'Light Section Background Color',
    'section'  => 'wf_style',
    'priority' => 4,
    'settings' => WF_THEME_OPTIONS . '[color_section_light_background]')));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_text', array(
    'label'    => 'Text Color',
    'section'  => 'wf_style',
    'priority' => 4,
    'settings' => WF_THEME_OPTIONS . '[color_text]')));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_link', array(
    'label'    => 'Links Color',
    'section'  => 'wf_style',
    'priority' => 5,
    'settings' => WF_THEME_OPTIONS . '[color_link]')));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_link_menu', array(
    'label'    => 'Menu Items Color',
    'section'  => 'wf_style',
    'priority' => 5,
    'settings' => WF_THEME_OPTIONS . '[color_link_menu]')));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_h1', array(
    'label'    => 'Headings 1 Color',
    'section'  => 'wf_style',
    'priority' => 6,
    'settings' => WF_THEME_OPTIONS . '[color_h1]')));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_h2', array(
    'label'    => 'Headings 2 Color',
    'section'  => 'wf_style',
    'priority' => 7,
    'settings' => WF_THEME_OPTIONS . '[color_h2]')));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_h3', array(
    'label'    => 'Headings 3 Color',
    'section'  => 'wf_style',
    'priority' => 8,
    'settings' => WF_THEME_OPTIONS . '[color_h3]')));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_h4', array(
    'label'    => 'Headings 4 Color',
    'section'  => 'wf_style',
    'priority' => 9,
    'settings' => WF_THEME_OPTIONS . '[color_h4]')));
  $wp_customize->add_control(new WP_Customize_Textarea($wp_customize, 'custom_css', array(
    'label'   => 'Custom CSS',
    'section' => 'wf_style',
    'priority' => 15,
    'settings'   => WF_THEME_OPTIONS . '[custom_css]')));
   $wp_customize->add_control(new WP_Customize_Help($wp_customize, 'custom_css_help', array(
    'label'   => 'If you need to add custom CSS to the theme copy/paste it here (without the &lt;style&gt; tags).',
    'section' => 'wf_style',
    'priority' => 16,
    'settings' => WF_THEME_OPTIONS . '[dummy]')));

  // section - header
  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logo', array(
   'label'   => 'Logo Image',
   'priority' => 3,
   'section' => 'wf_header',
   'settings'   => WF_THEME_OPTIONS . '[logo]')));
  $wp_customize->add_control('logo_icon', array(
    'label'   => 'Logo Icon',
    'section' => 'wf_header',
    'priority' => 2,
    'settings' => WF_THEME_OPTIONS . '[logo_icon]',
    'type'    => 'select',
    'choices' => wf_theme_get_icons_list()));
  $wp_customize->add_control(new WP_Customize_Help($wp_customize, 'header_help', array(
    'label'   => 'Header menu can be separately configured for front page under the "Front Page" section.',
    'section' => 'wf_header',
    'priority' => 25,
    'settings' => WF_THEME_OPTIONS . '[dummy]')));

  // front page
  $wp_customize->add_control(new WP_Customize_Help($wp_customize, 'front_page_help', array(
    'label'   => 'Changing the "Front Page Displays" setting in WP admin under Settings - Reading will change the options available for front page. If you want to use the landing page layout choose the "Static page" option. See documentation for details.',
    'section' => 'wf_frontpage',
    'priority' => 1,
    'settings' => WF_THEME_OPTIONS . '[dummy]')));
  if (get_option('show_on_front') != 'page') {
    $wp_customize->add_control(new WP_Customize_Textarea($wp_customize, 'header_tagline', array(
     'label'   => 'Header Tagline',
     'section' => 'wf_frontpage',
     'priority' => 2,
     'settings'   => WF_THEME_OPTIONS . '[header_tagline]')));
  } else {
  $wp_customize->add_control('header_type', array(
    'label'   => 'Header Type',
    'section' => 'wf_frontpage',
    'priority' => 3,
    'settings' => WF_THEME_OPTIONS . '[header_type]',
    'type'    => 'select',
    'choices' => array(
        '0' => 'No header',
        '1' => 'Contact form',
        '2' => 'iPad Slider')));
  $tmp = get_pages(array('post_status' => 'publish,draft,private'));
   $pages = array('0' => '-none-');
   foreach ($tmp as $tmp2) {
     $pages[$tmp2->ID] = get_the_title($tmp2->ID);
  }
  $wp_customize->add_control('header_page_id', array(
    'label'   => 'Header Content Page (left column)',
    'section' => 'wf_frontpage',
    'priority' => 4,
    'settings' => WF_THEME_OPTIONS . '[header_page_id]',
    'type'    => 'select',
    'choices' => $pages));
  $wp_customize->add_control(new WP_Customize_Help($wp_customize, 'help_fp_1', array(
   'label'   => 'Please configure the contact form in the "Contact Form" section below.' ,
   'section' => 'wf_frontpage',
   'priority' => 5,
   'settings'   => WF_THEME_OPTIONS . '[dummy]')));
  $wp_customize->add_control(new WP_Customize_Category($wp_customize, 'slider_category', array(
   'label'   => 'Slider Posts Category',
   'section' => 'wf_frontpage',
   'show_option_none' => 'No category selected',
   'priority' => 15,
   'settings'   => WF_THEME_OPTIONS . '[slider_category]')));
  $wp_customize->add_control('slider_controls', array(
    'label'   => 'Slider Controls',
    'section' => 'wf_frontpage',
    'priority' => 16,
    'settings' => WF_THEME_OPTIONS . '[slider_controls]',
    'type'    => 'select',
    'choices' => array(
        '0' => 'None',
        '1' => 'Arrows',
        '2' => 'Circles',
        '3' => 'Arrows & Circles')));
  $wp_customize->add_control('slider_animation', array(
    'label'   => 'Slider Animation',
    'section' => 'wf_frontpage',
    'priority' => 17,
    'settings' => WF_THEME_OPTIONS . '[slider_animation]',
    'type'    => 'select',
    'choices' => array(
        'fade' => 'Fade',
        'slide' => 'Slide')));
  $wp_customize->add_control('slider_pause', array(
    'label'   => 'Slider Pause Time',
    'section' => 'wf_frontpage',
    'priority' => 18,
    'settings' => WF_THEME_OPTIONS . '[slider_pause]',
    'type'    => 'select',
    'choices' => array(
        '0' => 'Disable auto slide',
        '1000' => '1 second',
        '1500' => '1.5 seconds',
        '2000' => '2 seconds',
        '2500' => '2.5 seconds',
        '3000' => '3 seconds',
        '3500' => '3.5 seconds',
        '4000' => '4 seconds',
        '4500' => '4.5 seconds',
        '5000' => '5 seconds',
        '5500' => '5.5 seconds',
        '6000' => '6 seconds',
        '6500' => '6.5 seconds',
        '7000' => '7 seconds',
        '7500' => '7.5 seconds',
        '8000' => '8 seconds',
        '8500' => '8.5 seconds',
        '9000' => '9 seconds',
        '9500' => '9.5 seconds',
        '10000' => '10 seconds')));
    $wp_customize->add_control('slider_pause_hover', array(
    'label'   => 'Pause Slider on Hover',
    'section' => 'wf_frontpage',
    'priority' => 19,
    'settings' => WF_THEME_OPTIONS . '[slider_pause_hover]',
    'type'    => 'select',
    'choices' => array(
        '0' => 'False',
        '1' => 'True')));
  }
  // section - footer
  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_logo', array(
   'label'   => 'Footer Logo Image',
   'priority' => 2,
   'section' => 'wf_footer',
   'settings'   => WF_THEME_OPTIONS . '[footer_logo]')));
  $wp_customize->add_control(new WP_Customize_Textarea($wp_customize, 'footer_copyright', array(
   'label'   => 'Footer Copyright Text',
   'section' => 'wf_footer',
   'priority' => 3,
   'settings'   => WF_THEME_OPTIONS . '[footer_copyright]')));
  $wp_customize->add_control('footer_totop', array(
    'label'   => '"Go to top" Button',
    'section' => 'wf_footer',
    'priority' => 4,
    'settings' => WF_THEME_OPTIONS . '[footer_totop]',
    'type'    => 'select',
    'choices' => array(
        '0' => 'Hide',
        '1' => 'Show')));

  // section - newsletter
  $wp_customize->add_control('newsletter_api_key', array(
    'label'   => 'MailChimp API Key',
    'section' => 'wf_newsletter',
    'settings' => WF_THEME_OPTIONS . '[newsletter_api_key]',
    'type'    => 'text'));
  $wp_customize->add_control('newsletter_list', array(
    'label'   => 'MailChimp List Name',
    'section' => 'wf_newsletter',
    'settings' => WF_THEME_OPTIONS . '[newsletter_list]',
    'type'    => 'text'));
  $wp_customize->add_control(new WP_Customize_Textarea($wp_customize, 'newsletter_msg_ok', array(
   'label'   => 'Message After Successful Subscribe',
   'section' => 'wf_newsletter',
   'priority' => 11,
   'settings' => WF_THEME_OPTIONS . '[newsletter_msg_ok]')));
  $wp_customize->add_control(new WP_Customize_Help($wp_customize, 'help351', array(
   'label'   => 'Use the [newsletter] shortcode to place the subscription box in any section on the front page.',
   'section' => 'wf_newsletter',
   'priority' => 20,
   'settings' => WF_THEME_OPTIONS . '[dummy]')));

   // section - contact form
   $wp_customize->add_control(new WP_Customize_Textarea($wp_customize, 'contact_form_title', array(
    'label'   => 'Title',
    'section' => 'wf_contact_form',
    'priority' => 1,
    'settings' => WF_THEME_OPTIONS . '[contact_form_title]',
    'type'    => 'text')));
   $wp_customize->add_control(new WP_Customize_Textarea($wp_customize, 'contact_form_subtitle', array(
    'label'   => 'Subtitle',
    'section' => 'wf_contact_form',
    'priority' => 2,
    'settings' => WF_THEME_OPTIONS . '[contact_form_subtitle]',
    'type'    => 'text')));
   $wp_customize->add_control('contact_form_name', array(
    'label'   => 'Name Field Description',
    'section' => 'wf_contact_form',
    'priority' => 3,
    'settings' => WF_THEME_OPTIONS . '[contact_form_name]',
    'type'    => 'text'));
   $wp_customize->add_control('contact_form_email', array(
    'label'   => 'Email Field Description',
    'section' => 'wf_contact_form',
    'priority' => 4,
    'settings' => WF_THEME_OPTIONS . '[contact_form_email]',
    'type'    => 'text'));
   $wp_customize->add_control('contact_form_type', array(
    'label'   => 'Type Field Description',
    'section' => 'wf_contact_form',
    'priority' => 5,
    'settings' => WF_THEME_OPTIONS . '[contact_form_type]',
    'type'    => 'text'));
   $wp_customize->add_control(new WP_Customize_Textarea($wp_customize, 'contact_form_type_values', array(
    'label'   => 'Type Field Values',
    'section' => 'wf_contact_form',
    'priority' => 6,
    'settings' => WF_THEME_OPTIONS . '[contact_form_type_values]',
    'type'    => 'text')));
   $wp_customize->add_control(new WP_Customize_Help($wp_customize, 'help-form-1', array(
   'label'   => 'Put each value in a separate line.<br>If you want to remove the type field completely leave this field blank.' ,
   'section' => 'wf_contact_form',
   'priority' => 7,
   'settings'   => WF_THEME_OPTIONS . '[dummy]')));
   $wp_customize->add_control('contact_form_details', array(
    'label'   => 'Details Field Description',
    'section' => 'wf_contact_form',
    'priority' => 8,
    'settings' => WF_THEME_OPTIONS . '[contact_form_details]',
    'type'    => 'text'));
    $wp_customize->add_control(new WP_Customize_Help($wp_customize, 'help-form-41', array(
     'label'   => 'If you want to remove the details field leave the description blank.' ,
     'section' => 'wf_contact_form',
     'priority' => 8,
     'settings'   => WF_THEME_OPTIONS . '[dummy]')));
   $wp_customize->add_control('contact_form_extra_field', array(
    'label'   => 'First Extra Field Description',
    'section' => 'wf_contact_form',
    'priority' => 9,
    'settings' => WF_THEME_OPTIONS . '[contact_form_extra_field]',
    'type'    => 'text'));
   $wp_customize->add_control('contact_form_extra_field2', array(
    'label'   => 'Second Extra Field Description',
    'section' => 'wf_contact_form',
    'priority' => 10,
    'settings' => WF_THEME_OPTIONS . '[contact_form_extra_field2]',
    'type'    => 'text'));
   $wp_customize->add_control(new WP_Customize_Help($wp_customize, 'help-form-2', array(
   'label'   => 'If you don\'t need the extra input field(s) leave the descriptions blank and the field(s) will be removed.' ,
   'section' => 'wf_contact_form',
   'priority' => 11,
   'settings'   => WF_THEME_OPTIONS . '[dummy]')));
   $wp_customize->add_control('contact_form_file_upload', array(
    'label'   => 'File Upload Field Description',
    'section' => 'wf_contact_form',
    'priority' => 12,
    'settings' => WF_THEME_OPTIONS . '[contact_form_file_upload]',
    'type'    => 'text'));
   $wp_customize->add_control(new WP_Customize_Help($wp_customize, 'help-form-552', array(
   'label'   => 'Uploaded files are stored in your /wp-content/uploads/ folder. Link to the file will be sent in the contact email. Default WP file upload restrictions apply to all files.<br>If you don\'t need the file upload field leave the descriptions blank and it will be removed.' ,
   'section' => 'wf_contact_form',
   'priority' => 13,
   'settings'   => WF_THEME_OPTIONS . '[dummy]')));
   $wp_customize->add_control('contact_form_button', array(
    'label'   => 'Submit Button Text',
    'section' => 'wf_contact_form',
    'priority' => 14,
    'settings' => WF_THEME_OPTIONS . '[contact_form_button]',
    'type'    => 'text'));
   $wp_customize->add_control(new WP_Customize_Help($wp_customize, 'help-form-323', array(
   'label'   => '<br><hr>' ,
   'section' => 'wf_contact_form',
   'priority' => 15,
   'settings'   => WF_THEME_OPTIONS . '[dummy]')));
   $wp_customize->add_control(new WP_Customize_Textarea($wp_customize, 'contact_form_msg_ok', array(
    'label'   => 'Message After Successful Form Submit',
    'section' => 'wf_contact_form',
    'priority' => 16,
    'settings' => WF_THEME_OPTIONS . '[contact_form_msg_ok]',
    'type'    => 'text')));
   $wp_customize->add_control('contact_form_redirect_url', array(
    'label'   => 'Contact Form Redirect URL',
    'section' => 'wf_contact_form',
    'priority' => 17,
    'settings' => WF_THEME_OPTIONS . '[contact_form_redirect_url]',
    'type'    => 'text'));
   $wp_customize->add_control(new WP_Customize_Help($wp_customize, 'help-form-32', array(
   'label'   => 'If you want the user to be redirected to a new ("thank you") page after a successful form submit enter the URL. If the field is left blank user will see the "Message After Successful Form Submit" defined above.' ,
   'section' => 'wf_contact_form',
   'priority' => 18,
   'settings'   => WF_THEME_OPTIONS . '[dummy]')));
   $wp_customize->add_control(new WP_Customize_Textarea($wp_customize, 'contact_form_email_subject', array(
    'label'   => 'Email Subject',
    'section' => 'wf_contact_form',
    'priority' => 19,
    'settings' => WF_THEME_OPTIONS . '[contact_form_email_subject]',
    'type'    => 'text')));
   $wp_customize->add_control(new WP_Customize_Textarea($wp_customize, 'contact_form_email_body', array(
    'label'   => 'Email Body',
    'section' => 'wf_contact_form',
    'priority' => 20,
    'settings' => WF_THEME_OPTIONS . '[contact_form_email_body]',
    'type'    => 'text')));
   $wp_customize->add_control('contact_form_email_address', array(
    'label'   => 'Your Email Address',
    'section' => 'wf_contact_form',
    'priority' => 21,
    'settings' => WF_THEME_OPTIONS . '[contact_form_email_address]',
    'type'    => 'text'));

   $wp_customize->add_control('contact_form_autoreply', array(
    'label'   => 'Auto-reply Email',
    'section' => 'wf_contact_form',
    'priority' => 21,
    'settings' => WF_THEME_OPTIONS . '[contact_form_autoreply]',
    'type'    => 'select',
    'choices' => array(
        '0' => 'Disable autoreply',
        '1' => 'Enable autoreply')));
   $wp_customize->add_control(new WP_Customize_Help($wp_customize, 'help_autoreply', array(
   'label'   => 'When someone submits the contact form they will immediately receive an auto-reply on the email address they provided in the form.',
   'section' => 'wf_contact_form',
   'priority' => 21,
   'settings' => WF_THEME_OPTIONS . '[dummy]')));
   $wp_customize->add_control(new WP_Customize_Textarea($wp_customize, 'contact_form_autoreply_subject', array(
    'label'   => 'Auto-reply Email Subject',
    'section' => 'wf_contact_form',
    'priority' => 22,
    'settings' => WF_THEME_OPTIONS . '[contact_form_autoreply_subject]',
    'type'    => 'text')));
    $wp_customize->add_control(new WP_Customize_Textarea($wp_customize, 'contact_form_autoreply_body', array(
    'label'   => 'Auto-reply Email Body',
    'section' => 'wf_contact_form',
    'priority' => 23,
    'settings' => WF_THEME_OPTIONS . '[contact_form_autoreply_body]',
    'type'    => 'text')));
    
    $wp_customize->add_control(new WP_Customize_Help($wp_customize, 'help_form_mc', array(
   'label'   => 'After the form is successfully submitted the user can be automatically subscribed to a MailChimp list. This setting is not related to the newsletter shortcode.',
   'section' => 'wf_contact_form',
   'priority' => 27,
   'settings' => WF_THEME_OPTIONS . '[dummy]')));
    $wp_customize->add_control('contact_form_mc_api_key', array(
    'label'   => 'MailChimp API Key',
    'section' => 'wf_contact_form',
    'priority' => 25,
    'settings' => WF_THEME_OPTIONS . '[contact_form_mc_api_key]',
    'type'    => 'text'));
    $wp_customize->add_control('contact_form_mc_list', array(
    'label'   => 'MailChimp List Name',
    'section' => 'wf_contact_form',
    'priority' => 26,
    'settings' => WF_THEME_OPTIONS . '[contact_form_mc_list]',
    'type'    => 'text'));


   // section - Twitter
   $wp_customize->add_control(new WP_Customize_Help($wp_customize, 'help-twitter-1', array(
   'label'   => 'Due to new Twitter API rules you have to create an application in order to show custom Twitter feeds. The process is very simple and free. Go to <a href="https://dev.twitter.com/" target="_blank">dev.twitter.com</a> and login with your Twitter account. Click "My applications" under your account avatar and then click "Create a new application". Application details are really not important. After the app is created click "Create my access token" and copy/paste 4 string in appropriate fields here.' ,
   'section' => 'wf_twitter',
   'priority' => 1,
   'settings'   => WF_THEME_OPTIONS . '[dummy]')));
   $wp_customize->add_control(new WP_Customize_Textarea($wp_customize, 'twitter_consumer_key', array(
    'label'   => 'Consumer Key',
    'section' => 'wf_twitter',
    'priority' => 5,
    'settings' => WF_THEME_OPTIONS . '[twitter_consumer_key]')));
   $wp_customize->add_control(new WP_Customize_Textarea($wp_customize, 'twitter_consumer_secret', array(
    'label'   => 'Consumer Secret',
    'section' => 'wf_twitter',
    'priority' => 6,
    'settings' => WF_THEME_OPTIONS . '[twitter_consumer_secret]',
    'type'    => 'text')));
   $wp_customize->add_control(new WP_Customize_Textarea($wp_customize, 'twitter_user_token', array(
    'label'   => 'Access Token',
    'section' => 'wf_twitter',
    'priority' => 6,
    'settings' => WF_THEME_OPTIONS . '[twitter_user_token]',
    'type'    => 'text')));
   $wp_customize->add_control(new WP_Customize_Textarea($wp_customize, 'twitter_user_secret', array(
    'label'   => 'Access Token Secret',
    'section' => 'wf_twitter',
    'priority' => 6,
    'settings' => WF_THEME_OPTIONS . '[twitter_user_secret]',
    'type'    => 'text')));
   $wp_customize->add_control(new WP_Customize_Help($wp_customize, 'help-twitter-2', array(
   'label'   => 'Please note that this only sets up the Twitter feed authorization. In order to show it you haveto use the shortcode - [twitter count=1 avatar_size=32]account-name[/twitter]',
   'section' => 'wf_twitter',
   'priority' => 10,
   'settings'   => WF_THEME_OPTIONS . '[dummy]')));

   // section - miscellaneous
   $tmp = get_pages(array('post_status' => 'publish,draft,private'));
   $pages = array('0' => '-none-');
   foreach ($tmp as $tmp2) {
     $pages[$tmp2->ID] = get_the_title($tmp2->ID);
  }
  $wp_customize->add_control('page_404_id', array(
    'label'   => '404 Page',
    'section' => 'wf_misc',
    'priority' => 2,
    'settings' => WF_THEME_OPTIONS . '[page_404_id]',
    'type'    => 'select',
    'choices' => $pages));
  $wp_customize->add_control('post_social', array(
    'label'   => 'Social buttons/counters below post content',
    'section' => 'wf_misc',
    'priority' => 3,
    'settings' => WF_THEME_OPTIONS . '[post_social]',
    'type'    => 'select',
    'choices' => array(
        '0' => 'Hide social counters',
        '1' => 'Show social counters')));

  // remove default sections
  $wp_customize->remove_section('static_front_page');
  $wp_customize->remove_section('nav');
} // wf_theme_customize_register
add_action('customize_register', 'wf_theme_customize_register');