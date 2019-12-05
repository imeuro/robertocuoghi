var col = jQuery('.onecol');
var sw = jQuery(window).width();
var VMbtn = jQuery('.viewmore_btn');
var VMtxt = jQuery('.viewmore_txt');
var offTop = col.offset().top;
var Entrypoints = document.querySelectorAll('.homepage a[href*="/artworks"]');

// ARTIFIZIO OMINI
var Pcont = document.querySelector('.homepage .onecol');
var Vcont = document.getElementById('videocontainer');
var Vtag = document.getElementById('videocontent');


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

	var Entrypoints = document.querySelectorAll('.homepage a[href*="artworks"]');
	var EPts = Array.from(Entrypoints);
	Entrypoints.forEach(function(a){
		a.onclick = function(e) {
			// e.preventDefault();
			gtag('event', 'entrypoint', {
				'event_category' : 'homepage',
				'event_label' : 'enter website'
			});
		}
	});

	VMbtn.on('click',function(){
		//VMtxt.slideToggle(300);
		console.log('display testo...');
		// tracking gente che vede le note to collectors..
		// così per curiosità mia.
		var VMaction = 'open';
		if( this.classList.contains('open') !== true  ) {
			VMaction = 'close';
		}
		gtag('event', 'notes_collector', {
			'event_category' : 'homepage',
			'event_label' : 'toggled '+VMaction
		  });
	});

	if (Vcont && Vcont.classList.contains('playing') === false) { 
		Pcont.classList.add('hidden'); // ASAP!
		document.body.classList.add('fixed');
		//console.log('check se siamo in home...');
		setTimeout(chooseVideoFormat(),100);


		window.onresize = function(event) {
			setTimeout(chooseVideoFormat(),500);
		};
		Vcont.addEventListener("click", Vfadeout);
		//Vtag.addEventListener("canplay", BGfadein);

	}

}

// ARTIFIZIO OMINI
var chooseVideoFormat = function() {
	var sw = jQuery(window).width();
	var Vurl = 'https://www.robertocuoghi.com/wp-content/uploads/intro/Retrobalera_9col';

	if (sw < 640) {
		Vurl = 'http://www.rapconverter.com/SampleDownload/Sample1280';
	}
	
	var Vsource1 = document.createElement('source');
	Vsource1.setAttribute('type','video/mp4');
	Vsource1.setAttribute('src',Vurl + '.mp4');
	var Vsource2 = document.createElement('source');
	Vsource2.setAttribute('type','video/webm');
	Vsource2.setAttribute('src',Vurl + '.webm');
	Vtag.innerHTML = "";

	Vtag.append(Vsource1);
	Vtag.append(Vsource2);

	Vtag.load();
	Vtag.play();
	Vcont.classList.add('playing');
	console.log('video chosen: '+Vurl);
}
var Vfadeout = function() {
	// console.log('Vcont clicked');
	Vcont.classList.add('hidden');
	setTimeout(() => {
		Vcont.remove();
		document.body.classList.remove('fixed');
		Pcont.classList.remove('hidden');
	}, 500);
};

var BGfadein = function() {
		console.log('BGfadein running');
		setTimeout(() => {
			
		}, 500);
};
