<?php
/**
 * Permatex
 * (c) Web factory Ltd, 2013
 */

  echo '<div class="inner">';
  if (is_page()) {
    dynamic_sidebar('wf-pages');
  } else {
    dynamic_sidebar('wf-main');
  }
  echo '</div>';
?>