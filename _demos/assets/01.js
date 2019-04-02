  $(document).ready(function () {
    //initialize swiper when document ready


		/*
		var mySwiper = new Swiper ('.swiper-container', {
      // Optional parameters
			slidesPerView: 7,
			spaceBetween: 30,
      freeMode: true,
      loop: true,
			autoplay: {
        delay: 0,
        disableOnInteraction: true,
				waitForTransition: true
      },
    })
		*/

		function randomNumberFromRange(min,max) {
		    return Math.floor(Math.random()*(max-min+1)+min);
		}


		$('.slick.marquee').each(function(){
			var startslide =  randomNumberFromRange(1, 7);
			var speedslide =  randomNumberFromRange(1000, 10000);
			console.log(speedslide);
			$(this).slick({
				speed: speedslide,
				autoplay: true,
				autoplaySpeed: 0,
				centerMode: true,
				cssEase: 'linear',
				slidesToShow: 1,
				slidesToScroll: 1,
				variableWidth: true,
				infinite: true,
				initialSlide: startslide,
				arrows: false,
				buttons: false
			});
		});




});
