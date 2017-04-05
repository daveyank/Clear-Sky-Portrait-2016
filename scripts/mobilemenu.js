jQuery(document).ready(function($) {
 
  $("#menu-main-menu").before('<div id="mobile-menu-icon"></div>');
	$("#mobile-menu-icon").click(function() {
		$("#menu-main-menu").slideToggle();
	});
	
});