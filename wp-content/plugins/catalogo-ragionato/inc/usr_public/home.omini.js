var col = jQuery('.onecol');
var sw = jQuery(window).width();
var cw = col.width();
var numcols = Math.round( ( sw + cw - 1 ) / cw );
if (sw < cw) { numcols = 1; }
var anim_W = cw * numcols;
var offset = (sw - anim_W) / 2;
var sl_marquee = jQuery('.slick.marquee');



$(document).ready(function () {

	console.log('-- Window width: '+sw);

	initHome();

});


window.addEventListener("resize",debounce(function(e){

	console.log('-- New window width: '+sw);
	// slickDestroy();
	initHome();

}));



/**
=========================================================
											FUNCTIONS
=========================================================
**/

function debounce(func){
  var timer;
  return function(event){
    if(timer) clearTimeout(timer);
    timer = setTimeout(func,100,event);
  };
}


function randomNumberFromRange(min,max) {
	return Math.floor(Math.random()*(max-min+1)+min);
}


function initHome() {

		sl_marquee.each(function(i) {
			var speedslide =  randomNumberFromRange(5,30);
			// console.log('slickmarquee#'+i);
			// console.log('slide #'+i+' speed: '+speedslide);
			jQuery(this).css('animation-duration',speedslide+'s');
		});
}
