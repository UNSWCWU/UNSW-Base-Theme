(function ($) {
  Drupal.behaviors.unswModule = {
    attach: function(context, settings) {
      $('a.print').click(function(e){
        e.preventDefault();
        window.print();
      });
	  /* Make sure this is the ID of the menu you want to be responsive */
	  $('#nice-menu-1').slicknav();
    
    }
  };
})(jQuery);
