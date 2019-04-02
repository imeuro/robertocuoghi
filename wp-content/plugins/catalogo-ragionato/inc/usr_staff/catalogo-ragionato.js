jQuery(document).ready( function() {


	// DISATTIVATO PER DEBUG, POI RIATTIVARE!
	//
  // jQuery(document).on("contextmenu",function(e){
  //   if(e.target.nodeName != "INPUT" && e.target.nodeName != "TEXTAREA")
  //     e.preventDefault();
  //   	console.log(e.target.nodeName);
  // });


});


jQuery(window).on('resize', function(){


});


var slideGently = function(target) {
	var headerh = $('#hederWrapper').height()+10;
	var totalScroll = jQuery(target).offset().top-headerh;
	jQuery('html, body').animate({
		scrollTop: totalScroll+'px',
	}, 1000);
}
