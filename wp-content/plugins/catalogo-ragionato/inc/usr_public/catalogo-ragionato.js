/**
 * catalogo-ragionato.js
 *
 * rcuoghi_public theme
 *
**/
var sw = jQuery(window).width();

// MENU ARTWORKS
var asaid = jQuery('aside.artworks-navi');
var series = jQuery('aside .series');
var secondseries = series.eq(1).find('ul');
var thirdseries = series.eq(2).find('ul');
var tituli = jQuery('aside.artworks-navi > ul li h2');
var cunteiners = jQuery('aside.artworks-navi > ul li ul');
var mein = jQuery('#main');

function isScrolledOutOfView(elem)
{
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();

    var elemTop = $(elem).offset().top;
    var elemBottom = elemTop + $(elem).height();
		// console.log('docViewBottom: '+docViewBottom);
		// console.log('elemTop: '+elemTop);
    return ((elemBottom <= docViewTop) || (docViewBottom <= elemTop));
}

secondseries.children('li').eq(0).addClass('meta-cat');
series.eq(0).find('ul').append(secondseries.html());
secondseries.remove();

thirdseries.children('li').eq(0).addClass('meta-cat');
series.eq(0).find('ul').append(thirdseries.html());
thirdseries.remove();

if (secondseries.length !== 0) {
	// se siamo in pagina archivio per taxonomy, sostituisci nome taxonomy con term (!!)
	if ( asaid.attr('data-term') && asaid.attr('data-term').length !== 0 ) {
		console.log('siamo in una tax');
		var curtax = asaid.attr('data-tax');
		var curterm = asaid.attr('data-term');
		asaid.children('ul').children('li.'+curtax).children('H2').addClass('highlight').html(curterm);
	}

	tituli.on('click',function(){
		// reset
		cunteiners.slideUp();
		cunteiners.removeClass('open');
		if (sw < 999) {
			mein.css('opacity','0');
		}
		if(!jQuery(this).hasClass('open')) { // se è chiuso
			jQuery(this).siblings('ul').slideDown(500);
			jQuery(this).siblings('ul').addClass('open');
			tituli.removeClass('open');
			jQuery(this).addClass('open');
			if (asaid.length !== 0) {
				var adjust = 0;
				if (sw < 999) {
					adjust = 10;
					asaid.children('ul').children('li').each(function(){
						jQuery(this).hide();
					})
					jQuery(this).parent().removeAttr('style').addClass('open');
				}
				setTimeout(function(){
					asaid.addClass('fixd').css({
						'position':'relative',
						'top': (window.scrollY+adjust)+'px'
					});

				},600);
			}


		} else { // se è aperto
			jQuery(this).removeClass('open');
			if (asaid.length !== 0) {
				asaid.removeClass('fixd').removeAttr('style');
			}
			if (sw < 999) {
				mein.css('opacity','1');
				asaid.children('ul').children('li').each(function(){
					jQuery(this).show();
				})
				jQuery(this).parent().removeClass('open');
			}
		}


	});
}

jQuery(document).on('scroll', function(){
	if (asaid.length !== 0) {
		if (isScrolledOutOfView(asaid) === true) {
			// reset the aside
			cunteiners.slideUp();
			cunteiners.removeClass('open');
			tituli.removeClass('open');
			setTimeout(function(){
				asaid.removeClass('fixd').removeAttr('style');
				if (sw < 999) {
					mein.css('opacity','1');
					asaid.children('ul').children('li').each(function(){
						jQuery(this).show().removeClass('open');
					})
				}
			},1000);
		}
	}
});


// video player init
var vid = document.querySelectorAll('.initvid');
if (vid.length !== 0) {
	// <link href="https://vjs.zencdn.net/7.4.1/video-js.css" rel="stylesheet">
	// <script src='https://vjs.zencdn.net/7.4.1/video.js'></script>
	var pjs = document.createElement('script');
	pjs.src = 'https://vjs.zencdn.net/7.4.1/video.js';
	pjs.async = 'true';
	document.body.appendChild(pjs);

	var pcss = document.createElement('link');
	pcss.href = 'https://vjs.zencdn.net/7.4.1/video-js.css';
	pcss.rel = 'stylesheet';
	document.head.appendChild(pcss);
}

// video in scheda artwork:
var vidz = document.querySelectorAll('.artwork-videocont');
var quantividz = vidz.length;
if (quantividz !== 0) {

	var videoBox = '';
	var videoUrl = '';
	var videoDesc = '';
	var videoW = '';
	var videoH = '';
	var player = '';

	for (i=1; i<=quantividz; i++) {
		console.log(i);
		var id = i-1;
		videoUrl = vidz[id].getAttribute('data-video');
		videoDesc = vidz[id].getAttribute('data-video-description');
		videoW = Math.floor(vidz[id].getAttribute('data-video-width'));
		videoH = Math.floor(vidz[id].getAttribute('data-video-height'));
		videoBox += '<video id="RCvideo-'+id+'" class="video-js initvid"></video>';
		videoBox += '<small class="rc-video-description">'+videoDesc+'</small>';


  }

	var b = document.getElementById('viewmore_txt');
	if (b) { 
		b.innerHTML = videoBox + b.innerHTML 
	} else { // fix if no exibitions, still displays the video
		var c = document.createElement('p');
		c.setAttribute('class','art_exhibitions');
		var d = document.getElementById('rc-artwork-caption');
		d.appendChild(c);
		c.innerHTML ='<span id="viewmore_txt" class="closed">'+videoBox+'</span><hr class="divider" /><button id="viewmore_btn"></button>';
	}	


	pjs.onload = function() {

		player = videojs('RCvideo-'+id);
		player.src({type: "video/mp4", src: videoUrl});
		player.controls(true);
		player.autoplay(false);
		player.preload('metadata');
		if (videoH>videoW) {
			player.fluid(false);
			player.width(320);
			player.height((videoH*320)/videoW);
			player.addClass('RCvideo-vertical');
		} else {
			player.fluid(true);
		}

	}	

}

// WIEW MORE Button
var VMbtn = jQuery('#viewmore_btn, .viewmore_btn');
var VMtxt = jQuery('#viewmore_txt, .viewmore_txt');
VMbtn.on('click',function(){
	VMtxt.slideToggle();
	VMbtn.toggleClass('open');
	if (VMtxt.hasClass('closed')) {
		VMtxt.removeClass('closed');
		//VMbtn.text('Close');
	} else {
		VMtxt.addClass('closed');
		//VMbtn.text('View more');
	}
});

// SEARCH in Header
var SForm = jQuery('#rc_searchform');
SForm.find('.search-field').attr('placeholder','');



// INIT F***ing INFINITE SCROLL
var initinfscroll = function() {
	if (jQuery('.nav-links a').length !== 0 && jQuery('.archive-posts').length !== 0) {
		var archiveCont = jQuery('.archive-posts').infiniteScroll({
		  path: '.nav-links a',
		  hideNav: '.posts-navigation',
		  history: true,
		  status: '.page-load-status',
		  // debug: true,
		  append: 'article',
		});

		archiveCont.on( 'append.infiniteScroll', function() { 
			initlazyload() 
		});

	}
}

// INIT LAZYLOAD:
var initlazyload = function() {
	if (jQuery('.rc-lazyload').length !== 0) {
		var RC_LazyLoad = new LazyLoad({
			elements_selector: ".rc-lazyload",
			class_loaded: "rc-lazyloaded",
			threshold: 0
		});
	}
}


var logoLinkUrl = function() {
	var curdomain = document.referrer.indexOf(location.protocol + "//" + location.host);
	//event.preventDefault();
	if (curdomain === 0) { // we already were browsing the website --> back button
		history.back();
	} else { // direct hit from outside --> /artworks
		var relpath = '';
		if (location.host !== 'www.robertocuoghi.com') { relpath = '/robertocuoghi'; }
		document.location = location.protocol + "//" + location.host + relpath + '/artworks/';
	}
}



function debounce(func){
  var timer;
  return function(event){
    if(timer) clearTimeout(timer);
    timer = setTimeout(func,100,event);
  };
}

/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////

jQuery(document).ready( function() {
	console.log('-- Window width: '+sw);


	// DISATTIVATO PER DEBUG, POI RIATTIVARE!
	//
	// jQuery(document).on("contextmenu",function(e){
	//   if(e.target.nodeName != "INPUT" && e.target.nodeName != "TEXTAREA")
	//     e.preventDefault();
	//   	console.log(e.target.nodeName);
	// });

	initinfscroll()
	initlazyload();

	var coniglioEffect = document.getElementById("coniglioEffect");
	if (coniglioEffect && coniglioEffect !== null) {
		coniglioEffect.addEventListener("click", function(event){
			event.preventDefault();
			logoLinkUrl();
		});
	}

	// IN PAGE SWIPER:
	var swiper_activator = jQuery('figure[data-mode="swiper"]');

	if(swiper_activator.length !== 0) {
		var artworks_slider = new Swiper('.swiper-container', {
			speed: 400,
			spaceBetween: 100,
			centeredSlides: true,
			loop: true,
			autoHeight: true,
			pagination: {
				el: '.swiper-pagination',
				type: 'bullets',
				clickable: true,
			},
			keyboard: {
				enabled: true,
				onlyInViewport: false,
			},
			on: {
				init: function () {
		      if(jQuery('#canvas-webgl').length > 0) {
						setTimeout(function() {
							jQuery('#glitchJS').attr('src','/wp-content/plugins/catalogo-ragionato/inc/usr_public/glitch.js');
							jQuery('#fl_swipercontainer .swiper-slide, #fl_swipercontainer .swiper-slide img').css('max-height',picHeight+'px');
						},1500);
					}
		    },
				click: function () {
					// var bigpic = jQuery('.swiper-slide-active > a').attr('data-big-pic');
					//console.log('adding data-big-pic: '+bigpic);
				},
			}
		});
	}


});




window.addEventListener("resize",debounce(function(e){
	sw = jQuery(window).width();
	console.log('-- New window width: '+sw);
}));

$(document).on('lity:open', function(event, instance) {
	setTimeout(function() {
    jQuery('.lity-content img').attr('data-lity-close','');
	},500);
});