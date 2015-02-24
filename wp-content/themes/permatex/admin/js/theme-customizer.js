/**
 * Permatex
 * (c) Web factory Ltd, 2013
 */

jQuery(function($){
  wp.customize(wf_theme.theme_options + '[color_main]', function(value) {
    value.bind(function(to) {
      if (to == 'false' || !to || to == false) {
        return;
      }

      $('.twitter-image,#navigation ul li a:hover,a:hover.newsletter-btn,.section-black h3.section-title,a:hover.buy-btn,.section-grey .subtitle,.box:hover .box-icon,.box:hover h3,.callus, header .logo-fontcon, #calltoaction-form .btn:hover').css('color', to);
      $('.section-colored,#teaser,#teaser-page,#calltoaction-form .btn,.faq .colored,a.buy-btn,a.newsletter-btn, .tagcloud a').css('background', to);
      $('.tagcloud a:before').css('border-color', 'transparent ' + to + 'transparent transparent;');

      $('#wf-custom-css').html('.tagcloud a:before {border-color: transparent ' + to + ' transparent transparent;}');
    });
  });

  wp.customize(wf_theme.theme_options + '[font]', function(value) {
    value.bind(function(to) {
      $('#wf-font-css').attr('href', wf_theme.theme_folder + '/css/fonts/' + to + '.css');
    });
  });
});