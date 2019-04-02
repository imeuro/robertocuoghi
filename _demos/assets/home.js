  $(document).ready(function () {


		function randomNumberFromRange(min,max) {
		    return Math.floor(Math.random()*(max-min+1)+min);
		}


		$('.slick.marquee').each(function(){
			var startslide =  randomNumberFromRange(1, 7);
			var speedslide =  randomNumberFromRange(5000, 10000);
			console.log(speedslide);
			$(this).slick({

				speed: speedslide,
				vertical: true,
				verticalSwiping: true,
				adaptiveHeight: false,
				autoplay: true,
				autoplaySpeed: 0,
				centerMode: false,
				cssEase: 'linear',
				slidesToShow: 4,
				slidesToScroll: 1,
				// variableWidth: true,
				infinite: true,
				initialSlide: startslide,
				arrows: false,
				buttons: false,
				draggable: false,
				pauseOnFocus: false,
				pauseOnHover: false

			});



		});

  });
