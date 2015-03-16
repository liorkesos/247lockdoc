<?php
/**
 * Permatex
 * (c) Web factory Ltd, 2013
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<title><?php wp_title(''); ?></title>
<meta name="description" content="<?php wf_theme_description(); ?>" />
<meta name="keywords" content="<?php wf_theme_keywords(); ?>" />
<meta name="author" content="<?php wf_theme_option('meta_author'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/fav.png">
<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php
  wp_head();
?>
</head>
<?php
  echo '<body ';
  body_class();
  echo '>';

  /*if (!is_front_page()) {
?>
<header id="top">
      <div class="container">
        <div class="row">
          <div class="span12">
            <h1 id="logo"><a href="<?php echo home_url(); ?>">
<?php
  if (wf_theme_get_option('logo_icon')) {                
?>            
             <!-- <span class="logo-fontcon <?php wf_theme_option('logo_icon'); ?>"></span> -->
<?php
  }
  if (wf_theme_get_option('logo')) {
?>
              <img src="<?php wf_theme_option('logo'); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>"></a>
<?php
  }                 
?>              
            </h1>
            <div id="navigation">
<?php
      global $primary_menu_options;
      $menu = wp_nav_menu($primary_menu_options);
      echo $menu;

      if ($menu) {
?>
      <select id="primary_menu_mobile" class="menu_mobile hidden-desktop hidden-tablet">
        <option value="">- main menu -</option>
      </select>
<?php
      } // if $menu
?>
            </div>
          </div>
        </div>
      </div>
    </header>
<?php
      *///} else {
?>
<header id="top">
      <div class="container">
        <div class="row">
          <div class="span12">
            <h1 id="logo"><a href="<?php echo home_url(); ?>">
<?php
  if (wf_theme_get_option('logo_icon')) {                
?>            
              <span class="logo-fontcon <?php wf_theme_option('logo_icon'); ?>"></span>
<?php
  }
  if (wf_theme_get_option('logo')) {
?>
              <img src="<?php wf_theme_option('logo'); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>"></a>
<?php
  }                 
?>             
Call the LockDoc -  (877) 365- 0729 
            </h1>
            <div id="navigation">
<?php
      global $front_page_menu_options;
      $menu = wp_nav_menu($front_page_menu_options);
      echo $menu;

      if ($menu) {
?>
      <select id="primary_menu_mobile" class="menu_mobile hidden-desktop hidden-tablet">
        <option value="">- main menu -</option>
      </select>
<?php
      } // if $menu
?>
            </div>
          </div>
        </div>
      </div>
    </header>
<?php //} ?>    
