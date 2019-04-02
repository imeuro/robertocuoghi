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
	slickDestroy();
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

function slickDestroy() {
	jQuery('.slick.marquee').slick('unslick');
	jQuery('.onecol.cloned').remove();
}

function initHome() {

	sw = jQuery(window).width();
	console.log('cols: '+numcols);
	var rnd = randomNumberFromRange(-30,-100);

	// centra tutto
	jQuery('.container-full a').css('left',offset+'px');

	jQuery('.slick.marquee').on('init', function(slick){
  //console.log(slick);
	jQuery('.container-full').css('opacity','1');
	});


	if (numcols > 1) {
		for (var i = 1; i < numcols; i++) {
			jQuery('.onecol:first').clone().appendTo('.container-full a').addClass('cloned').css('left',(cw*(i))+'px');
		}
	}



	jQuery('.slick.marquee').each(function(){
		var startslide =  randomNumberFromRange(1, 7);

		jQuery(this).slick({
			speed: 3000,
			vertical: true,
			verticalSwiping: true,
			adaptiveHeight: false,
			autoplay: true,
			autoplaySpeed: 10,
			centerMode: false,
			cssEase: 'linear',
			slidesToShow: 4,
			slidesToScroll: 1,
			// variableWidth: true,
			infinite: true,
			initialSlide: 1,
			arrows: false,
			buttons: false,
			draggable: false,
			pauseOnFocus: false,
			pauseOnHover: false
		});

	});

	if (numcols > 1) {
		jQuery('.onecol').children('.slick.marquee').each(function(i) {
			var speedslide =  randomNumberFromRange(10, 70)*100;
			// console.log('slickmarquee#'+i);
			// console.log('slide #'+i+' speed: '+speedslide);
			jQuery('.slick.marquee').eq(i).slick('slickSetOption','speed',speedslide,true);
		});
	}
}
