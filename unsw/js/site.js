(function ($) {
  Drupal.behaviors.unswModule = {
    attach: function(context, settings) {
      $('a.print').click(function(e){
        e.preventDefault();
        window.print();
      });
    
    }
  };
})(jQuery);
