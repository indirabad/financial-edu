(function($) { $(function() {  
   /* Common JS */
   if($("body").hasClass("translatepress-ar")){

   }

   $(document).on('click', '.app-show-subscribe-form-button', function(e) {
   		e.preventDefault();

   		$(document).find('#eBoursaModal').modal('show');
   });
}) })(jQuery)
