/**
 * Permatex
 * (c) Web factory Ltd, 2013
 */

jQuery(function($){
  $('#wf-theme-export-options').click(function() {
    $(this).select();
  });

  $('#wf-theme-download-export').click(function() {
    window.location = 'themes.php?page=wf_theme_options&wf_theme_download_export=1';
  });

  $('#customize-control-header_type select').live('change', function() {
    change_header_type();
  });
  
  change_header_type();
  
  $('#customize-control-logo_icon select').dropdownIconPreview();
  
  $('#customize-control-predefined_colors .predefined-color-sample').live('click', function() {
    $('#customize-control-color_main .color-picker-hex').wpColorPicker('color', $(this).css('background-color'));

    return false;
  });
}); // onload

function change_header_type() {
  val = jQuery('#customize-control-header_type select').val();

  jQuery('#customize-section-wf_frontpage .customize-control').hide();
  jQuery('#accordion-section-wf_frontpage .customize-control').hide();
  jQuery('#customize-control-header_sticky_fp').show();
  jQuery('#customize-control-nav_menu_locations-front_page').show();
  jQuery('#customize-control-header_type').show()
  jQuery('#customize-control-header_tagline').show()
  jQuery('#customize-control-front_page_help').show()
  if (val == '0') {
  } else if (val == '1') {
    jQuery('#customize-control-header_page_id').show();    
    jQuery('#customize-control-help_fp_1').show();
  } else if (val == '2') {
    jQuery('#customize-control-header_page_id').show();
    jQuery('#customize-control-slider_animation').show();
    jQuery('#customize-control-slider_category').show();
    jQuery('#customize-control-slider_pause').show();
    jQuery('#customize-control-slider_pause_hover').show();
    jQuery('#customize-control-slider_controls').show();
  }
} // change_header_type

// dropdownIconPreview
(function($) {
  $.fn.dropdownIconPreview = function() {
    var index = 1;
    
    var methods = {
      updateDropdownPreview: function(dropdown) {
        var span = '#' + $(dropdown).attr('data-preview-el');
        $(span).removeClass().addClass('dropdown-preview').addClass('icon-3x');
    
        if ($(dropdown).val()) {
          $(span).addClass($(dropdown).val());
        }
      }
    };
    
    return this.each(function() {
      if (!$(this).is('select') || $(this).attr('data-preview-el')) {
        return this; 
      }
    
      $(this).attr('data-preview-el', 'dropdown-preview-' + index);
      $(this).after('<span class="dropdown-preview" id="dropdown-preview-' + index + '"></span>');
      
      methods.updateDropdownPreview(this);
      $(this).change(function() {
        methods.updateDropdownPreview(this);
      });
      
      index++;
    });
  }
})(jQuery); // dropdownIconPreview