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

</div>
	<div class="row footer-menus show-for-medium-up"> 
 	<div class="column medium-3">
	<div style="float: left; width: 45%">
	<h2 class="ttl">Services</h2>
	<ul>
		<li><a href="http://247lockdoc.com/services/lockout/">Lockout</a></li>
		<li><a href="http://247lockdoc.com/services/key-made/">Key Made</a></li>
		<li><a href="http://247lockdoc.com/services/key-cutting/">Key Cutting</a></li>
		<li><a href="http://247lockdoc.com/services/broken-key-extractor/">Broken Key Extractor</a></li>
	</ul>
	</div>
	</div>


    </footer>
<?php
  wp_footer();
?>
</body>
</html>