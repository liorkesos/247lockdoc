<?php
/**
 * Template Name: Front Page
 *
 * Permatex
 * (c) Web factory Ltd, 2013
 */

  get_header();

  if (wf_theme_get_option('header_type')) { // if header
?>
<div id="teaser">
        <div class="container">
        <div class="row">
          <div class="span12">
          <div class="teaser-holder">
            <div class="teaser-left">
<?php
  $header_page_id = wf_theme_get_option('header_page_id');
  if ($header_page_id && get_post_field('post_content', $header_page_id)) {
    $content = apply_filters('the_content', get_post_field('post_content', $header_page_id));
    $title = get_the_title($header_page_id);
    $subtitle = get_post_meta($header_page_id, '_section_subtitle', true);
  } else {
    $content = '<p>Please use theme customizer, "Front Page" section to select content (page) for this space.</p>';
    $title = 'No page selected';
    $subtitle = 'No page selected';
  }

  echo '<h2>' . $title . '</h2>';
  echo '<h3>' . $subtitle . '</h3>';
  echo $content;
  edit_post_link(null, '<div class="clear"></div>', '', $header_page_id);
?>
            </div>
<?php
  if (wf_theme_get_option('header_type') == '1') { // form
    global $contact_js;
    $contact_js = true;
?>
            <div class="teaser-right">
              <div id="calltoaction-form" class="teaser-form">
                <div class="form-title">
                  <h3><?php echo esc_html(wf_theme_get_option('contact_form_title')); ?></h3>
                  <p class="callus"><?php echo esc_html(wf_theme_get_option('contact_form_subtitle')); ?></p>
                </div>
                <form id="contact_form" enctype="multipart/form-data" action="<?php echo get_permalink(); ?>" method="post">
                  <div class="form-section">
                    <input id="name" name="name" type="text" placeholder="<?php echo esc_attr(wf_theme_get_option('contact_form_name')); ?>">
                  </div>
                  <div class="form-section">
                    <input id="email" name="email" type="text" placeholder="<?php echo esc_attr(wf_theme_get_option('contact_form_email')); ?>">
                  </div>
<?php
  if (trim(wf_theme_get_option('contact_form_type_values'))) {
?>
                  <div class="form-section">
                    <select id="type" name="type">
                    <option value=""><?php echo esc_html(wf_theme_get_option('contact_form_type')); ?></option>
<?php
  $tmp = wf_theme_get_option('contact_form_type_values');
  $tmp = explode("\n", $tmp);
  $list = '';
  foreach ($tmp as $line) {
    $line = rtrim(rtrim(rtrim(trim($line), "\r"), "\n"));
    if ($line) {
      $list .= '<option value="' . esc_attr($line) . '">' . $line . '</option>';
    }
  }
  echo $list;
?>
                    </select>
                  </div>
<?php
  }
  if (wf_theme_get_option('contact_form_details')) {
?>
                  <div class="form-section">
                    <textarea id="message" class="removetext" name="message" cols="50" rows="3" placeholder="<?php echo esc_attr(wf_theme_get_option('contact_form_details')); ?>"></textarea>
                  </div>
<?php
  }

  if (wf_theme_get_option('contact_form_extra_field')) {
    echo '<div class="form-section">';
    echo '<input id="extra" name="extra" type="text" placeholder="' . esc_attr(wf_theme_get_option('contact_form_extra_field')) . '">';
    echo '</div>';
  }
  if (wf_theme_get_option('contact_form_extra_field2')) {
    echo '<div class="form-section">';
    echo '<input id="extra2" name="extra2" type="text" placeholder="' . esc_attr(wf_theme_get_option('contact_form_extra_field2')) . '">';
    echo '</div>';
  }

  if (wf_theme_get_option('contact_form_file_upload')) {
?>
                  <div class="form-section">
                    <div class="file-upload-container">
                    <?php echo wf_theme_get_option('contact_form_file_upload'); ?>
                    <input type="file" id="fileattach" name="fileattach" />
                    </div>
                  </div>
<?php
  }
?>
                  <div class="form-section">
                    <div class="captcha-question">Are you human?</div>
                    <div class="captcha-task">
                      <strong id="captcha-img">2 + 2 = </strong>
                      <input type="text" class="captcha-input-field" id="captcha" name="captcha" placeholder="?">
                    </div>
                    <div class="clear"></div>
                  </div>
                  <br>
                  <input type="submit" name="submit" class="btn" value="<?php echo esc_attr(wf_theme_get_option('contact_form_button')); ?>">
                </form>
              </div>
            </div>
<?php
  } else { // slider
    global $flexslider_js;
    $flexslider_js = true;

    echo '<div class="teaser-right no-width">';
    echo '<div id="device" class="ipad"><div id="teaser-slider"><div class="flexslider"><ul class="slides">';

    if (!wf_theme_get_option('slider_category') || wf_theme_get_option('slider_category') == '-1') {
      $slides = array();
    } else {
      $slides = get_posts(array('numberposts' => 12, 'category' => wf_theme_get_option('slider_category'), 'orderby' => 'post_date'));
    }

    foreach ($slides as $slide) {
      setup_postdata($slide);
      $link = get_post_meta($slide->ID, '_slide_link', true);
      echo '<li>';
      if ($link) {
        echo '<a title="' . get_the_title($slide->ID) . '" href="' . $link . '">';
      }
      echo get_the_post_thumbnail($slide->ID, 'per-slider');
      if ($link) {
        echo '</a>';
      }
      echo "</li>\n";
    }

    echo '</ul></div></div></div>';
    echo '</div>';
  }
?>
<div class="clear"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php
  } // if teaser

  global $post;
  $pages = array();
  $pages = get_pages(array('sort_column' => 'menu_order',
                           'post_status' => 'publish',
                           'meta_key'    => '_wp_page_template',
                           'meta_value'  => 'page-front-section.php'));

  $done = array();
  $i = 0;
  foreach ($pages as $page) {
    $post = $page;

    if (in_array($page->ID, $done)) {
      continue;
    } else {
      $done[] = $page->ID;
      $i++;
    }

    if (stripos($page->post_content, '[portfolio') !== false ||
        stripos($page->post_content, '[fp-widgets') !== false ||
        stripos($page->post_content, '[fp_widgets') !== false
        ) {
      $span12 = false;
    } else {
      $span12 = true;
    }

    if ($i % 2 == 0) {
      $class = 'section-black';
    } else {
      $class = 'section-grey';
    }

    $sec_addon_Class = '';
    if (has_post_thumbnail($page->ID)) {
      $sec_addon_Class = 'wf-featured-section';
    }

    echo '<section class="' . get_post_meta($page->ID, '_section_style', true) . ' '. $sec_addon_Class . '" data-permalink="' . esc_attr(get_permalink()) . '" id="section-' . $page->ID . '">';
    echo '<div class="container">';
    echo '<div class="row">';


    if (has_post_thumbnail($page->ID)) {
      echo '<div class="span12 wf-holder-inner">';
      echo '<div class="section-content">';
    } elseif ($span12) {
      echo '<div class="span12">';
    }
    if (get_the_title()) {
      echo '<h3 class="section-title">' . get_the_title() . '</h3>';
    }

    if (get_post_meta($page->ID, '_section_subtitle', true)) {
      echo '<div class="subtitle">' . get_post_meta($page->ID, '_section_subtitle', true) . '</div>';
    }
    echo apply_filters('the_content', $page->post_content);
    if ($span12 || has_post_thumbnail($page->ID)) {
      echo '</div>';
    }
    if (has_post_thumbnail($page->ID)) {
      echo '<div class="section-featured-image">';
      echo get_the_post_thumbnail($page->ID, 'per-front-section', array('class' => 'content-image align-right pull-bottom'));
      echo '</div>';
      echo '</div>';
    }

    edit_post_link(null, '<div class="clear"></div>', '', $post->ID);
    echo '</div></div></section>';
  }
  get_footer();
?>