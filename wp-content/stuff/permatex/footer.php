<?php
/**
 * Permatex
 * (c) Web factory Ltd, 2013
 */
?>

<footer>
       <div class="container">
          <div class="row">
            <div class="span12">
            <h1 id="logo-footer">
<?php
  if (wf_theme_get_option('logo_icon')) {                
?>            
              <span class="logo-fontcon <?php wf_theme_option('logo_icon'); ?>"></span>
<?php
  }
  if (wf_theme_get_option('footer_logo')) {
?>              
              <img src="<?php wf_theme_option('footer_logo'); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" class="footer-logo">
<?php
  }                 
?>              
            </h1>
              <p class="copyright"><?php wf_theme_option('footer_copyright'); ?></p>
<?php
  if (wf_theme_get_option('footer_totop')) {
?>              
              <div id="totop"><a class="smoothscroll" href="#top"><img src="<?php template_directory_uri(); ?>/images/totop.png" alt="Go to top"></a></div>
<?php
  }
?>                            
            </div>
          </div>
        </div>
    </footer>
<?php
  wp_footer();
?>
</body>
</html>