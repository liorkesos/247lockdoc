/*
 * Permatex
 * (c) 2013, Web factory Ltd
 */

jQuery(function($) {
  $('#teaser').height($('.teaser-right').height());

  // lightbox gallery on carosel
  if ($(window).width() > 767) {
    if ($("a[data-gal^='prettyPhoto']").length) {
      $("a[data-gal^='prettyPhoto']").each(function(ind, el) {
        $(el).attr('rel', $(el).attr('data-gal'));
      });

      $("a[rel^='prettyPhoto']").prettyPhoto({social_tools: false, deeplinking: false});
    }
  } else {
    $("a[data-gal^='prettyPhoto']").click(function() {
      return false;
    });
  }

  // carosel slider/gallery
  if ($(window).width() > 767) {
    if ($('.flexslider-carousel').length) {
      $('.flexslider-carousel').flexslider({
        animation: "slide",
        easing: "swing",
        slideshow: true,
        slideshowSpeed: 7000,
        animationSpeed: 600,
        touch: true,
        controlNav: false,
        directionNav: true,
        animationLoop: true,
        itemWidth: 220,
        itemMargin: 0,
        minItems: 4,
        maxItems: 4
      });
    }
  }

  // Equal height widgets
  var max_height = 0;

  $('.tiw').each(function(i, item) {
    var current_element_height = $(item).height();
    if (current_element_height > max_height) {
      max_height = current_element_height;
    }
  });

  $('.tiw').each(function(i, item) {
    $(item).height(max_height + 'px');
  });

  // header slider
  if ($('.flexslider').length) {
    $('.flexslider').flexslider({
      animation: wf_theme.slider_animation,
      animationSpeed: 800,
      directionNav: (wf_theme.slider_controls == '1' || wf_theme.slider_controls == '3')? true: false,
      controlNav: (wf_theme.slider_controls == '2' || wf_theme.slider_controls == '3')? true: false,
      pauseOnAction: true,
      pauseOnHover: !!parseInt(wf_theme.slider_pause_hover, 10),
      direction: 'horizontal',
      slideshow: !!parseInt(wf_theme.slider_pause, 10),
      slideshowSpeed: parseInt(wf_theme.slider_pause, 10)
    });
  }

  // init twitter feeds
  $('.tweet').each(function(index, element){
    $(element).tweet({
            username: $(element).attr('data-username'),
            avatar_size: $(element).attr('data-avatar-size'),
            count: $(element).attr('data-count'),
            join_text: 'auto',
            auto_join_text_default: ' we said, ',
            auto_join_text_ed: ' we ',
            auto_join_text_ing: ' we were ',
            auto_join_text_reply: ' we replied to ',
            auto_join_text_url: ' we were checking out ',
            loading_text: 'loading tweets...',
            modpath: wf_theme.ajaxurl + '?action=wf_theme_twitter_api'
    });
  }); // each twitter widget

  // blockquote rotator
  $('.quote-group').each(function(index, element){
    $('blockquote', element).quovolver(500, 6000);
  });

  // simple open/close FAQ
  $('.faq .question').bind('click', function(){
    $(this).siblings('.answer').slideToggle();
  });

  // tooltips on social icons
  $('.social-icon span').tooltip();

  // make front page menu link to sections
  if (wf_theme.is_front_page && $('#main-navigation li').length) {
    $('#main-navigation li a').each(function(index, elem) {
      link = $(elem).attr('href');
      tmp = $('*[data-permalink="' + link + '"]')
      if ($(tmp).length == 1) {
        $(elem).attr('href', '#' + $(tmp).attr('id'));
      }

      if ($(elem).attr('href').charAt(0) == '#') {
        $(elem).addClass('smoothscroll');
      }
    });
  }

  // smooth scrolling anchors
  $('.smoothscroll').click(function(e) {
    el = $(this).attr('href');
    $('html, body').animate({scrollTop: $(el).offset().top - 0}, 'slow');
    e.preventDefault();

    return false;
  });

  // main menu
  $('#main-navigation>li').hover(function(){
    var sub = $('.sub-menu', $(this));

    if ($(sub).length) {
      $(sub).fadeIn(300);
    }
  }, function(){
    var sub = $('.sub-menu', $(this));

    if ($(sub).length) {
      $(sub).stop().fadeOut(300);
    }
  });

  // generate mobile menu
  if ($('.menu_mobile').length) {
    var mobile_menu = $('.menu_mobile');
    $('#main-navigation li a').each(function(index, elem) {
      if ($(elem).parents('ul.sub-menu').length) {
        tmp = '&nbsp;&nbsp;-&nbsp;' + $(elem).html();
      } else {
        tmp = $(elem).html();
      }

      if ($(elem).parent('li').hasClass('current-menu-item')) {
        mobile_menu.append($('<option></option>').val($(elem).attr('href')).html(tmp).attr('selected', 'selected'));
      } else {
        mobile_menu.append($('<option></option>').val($(elem).attr('href')).html(tmp));
      }
    });
  }

  // mark submenus
  //$('#main-navigation ul.sub-menu').parent('li').children('a').html(function(){ return $(this).html() + ' +'; });

  // mobile menu click
  $('#primary_menu_mobile').change(function() {
    link = $(this).val();
    if (!link) {
      return;
    }
    document.location.href = link;

    return false;
  });

  // gmap init
  $('.gmap').each(function(index, element) {
    var gmap = $(element);
    var addr = 'http://maps.google.com/maps?hl=en&ie=utf8&output=embed&sensor=true&iwd=1&mrt=loc&t=m&q=' + encodeURIComponent(gmap.attr('data-address'));
    addr += '&z=' + gmap.attr('data-zoom');
    if (gmap.attr('data-bubble') == 'true') {
      addr += '&iwloc=addr';
    } else {
      addr += '&iwloc=near';
    }
    gmap.attr('src', addr);
  });

  /* links & icons hover effects
  $('#logo,.store-buttons a,.social-icon span,.flexslider-carousel img').css('opacity', '1');
  $('#logo,.store-buttons a,.social-icon span,.flexslider-carousel img').hover(
    function () {
      $(this).stop().animate({ opacity: .35 }, 'normal');
    },
    function () {
      $(this).stop().animate({ opacity: 1 }, 'normal');
  }); */

  $('.over').css('opacity', '0');
  $('.over').hover(
    function () {
       $(this).stop().animate({ opacity: 1 }, 'slow');
    },
    function () {
       $(this).stop().animate({ opacity: 0 }, 'slow');
  });

  // init newsletter subscription AJAX handling
  if ($('#newsletterform').length > 0) {
    $('#newsletterform').ajaxForm({ dataType: 'json',
                                    data: {action: 'wf_theme_newsletter'},
                                    timeout: 15000,
                                    error: function() { $('#newsletter-email').removeClass('preloading'); alert('MailChimp is currently unavailable. Please try again later.'); },
                                    success: newsletterResponseMailchimp});
    $('#newslettersubmit').click(function() { $('#newsletter-email').addClass('preloading'); $('#newsletterform').submit(); return false; });
  } // if newsletter form

  // load captcha question
  if ($('#captcha-img').length) {
    $.post(wf_theme.ajaxurl, {action: 'wf_theme_captcha', generate: 1}, function(response) {
      $('#captcha-img').html(response);
    });
  }

      // init contact form validation and AJAX handling
  if ($("#contact_form").length > 0) {
    $("#contact_form").validate({ rules: { name: 'required',
                                      email: { required: true, email: true },
                                      message: 'required',
                                      type: 'required',
                                      captcha: {required: true, remote: { url: wf_theme.ajaxurl, type: 'post', data: {action: 'wf_theme_captcha', check: 1, captcha: function() { return jQuery('#captcha').val(); } } }}},
                                messages: { name: "This field is required.",
                                            message: "This field is required.",
                                            email: { required: "This field is required.",
                                                     email: "Please enter a valid email address."},
                                            captcha: 'Are you sure you\'re a human? Please recheck.'},
                                submitHandler: function(form) { $(form).ajaxSubmit({url: wf_theme.ajaxurl, data: { action: 'wf_theme_contact_send' }, type: 'post', dataType: 'html', success: contactFormResponse}); }
                              });
  }
}); // onload


// handle contact form AJAX response
function contactFormResponse(response) {
  if (response == '1') {
    if (wf_theme.contact_form_redirect_url) {
      window.location.replace(wf_theme.contact_form_redirect_url);
    } else {
      alert(wf_theme.contact_form_msg_ok);
    }
  } else if (response == '-1') {
    alert('Please double-check the entered captcha question answer.');
  } else if (response == '-2') {
    alert('Error uploading attached file. Please check the file type and size.');
  } else {
    alert('We are having some technical difficulties. Please reload the page and try again.');
  }
} // contactFormResponse

// handle newsletter subscribe AJAX response - Mailchimp ver
function newsletterResponseMailchimp(response) {
  if (response.responseStatus == 'err') {
    if (response.responseMsg == 'ajax') {
      alert('Error - this script can only be invoked via an AJAX call.');
    } else if (response.responseMsg == 'name') {
      alert('Please enter a valid name.');
    } else if (response.responseMsg == 'email') {
      alert('Please enter a valid email address.');
    } else if (response.responseMsg == 'listid') {
      alert('Invalid MailChimp list name.');
    } else if (response.responseMsg == 'duplicate') {
      alert('You are already subscribed to our newsletter.');
    } else {
      alert('Undocumented error (' + response.responseMsg + '). Please refresh the page and try again.');
    }
  } else if (response.responseStatus == 'ok') {
    alert(wf_theme.newsletter_msg_ok);
  } else {
    alert('Undocumented error. Please refresh the page and try again.');
  }
} // newsletterResponseMailchimp