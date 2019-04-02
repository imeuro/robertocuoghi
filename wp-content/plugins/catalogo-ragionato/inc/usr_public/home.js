var col = jQuery('.onecol');
var sw = jQuery(window).width();
var VMbtn = jQuery('.viewmore_btn');
var VMtxt = jQuery('.viewmore_txt');
var offTop = col.offset().top;


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

		VMbtn.on('click',function(){
			//VMtxt.slideToggle(300);
			console.log('testo...');
		});


}
