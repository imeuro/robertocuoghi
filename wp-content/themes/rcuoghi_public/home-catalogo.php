<?php /* Template Name: Home Sito */  get_header();
function showTheCam() {
	$webcam = false;
	date_default_timezone_set('Europe/Rome'); // CET
	$timeformat = 'd/m/Y H:i';
	$timenow = strtotime(date($timeformat));
	// echo 'timenow: '.$timenow."\n"; // echos today!

	$timestart = date(strtotime("05/12/2019 16:00"));
	$timeend = date(strtotime("05/12/2019 17:00"));
	$second_timestart = date(strtotime("05/12/2019 17:42"));
	$second_timeend = date(strtotime("05/12/2019 24:00"));
	$third_timestart = date(strtotime("07/12/2019 20:00"));
	$third_timeend = date(strtotime("07/12/2019 23:10"));



	if ((($timenow >= $timestart) && ($timenow <= $timeend)) || (($timenow >= $second_timestart) && ($timenow <= $second_timeend)) || (($timenow >= $third_timestart) && ($timenow <= $third_timeend))){
	    // echo "is between";
	    $webcam = true;
	    return true;
	}else{
		// echo "NO GO!"; 
		return false;
	}
}
?>


<div class="container-full homepage">

    <div class="onecol hidden">
        <h1><a href="<?php echo get_site_url().'/artworks/'; ?>" title="Roberto Cuoghi artworks"><img src="https://www.robertocuoghi.com/wp-content/uploads/2019/02/inst.png" alt="This is the official website of Roberto Cuoghi (born September 23, 1973, Modena, Italy)" class="wp-image-1572" srcset="https://www.robertocuoghi.com/wp-content/uploads/2019/02/inst.png 1000w, https://www.robertocuoghi.com/wp-content/uploads/2019/02/inst-508x124.png 508w, https://www.robertocuoghi.com/wp-content/uploads/2019/02/inst-973x238.png 973w, https://www.robertocuoghi.com/wp-content/uploads/2019/02/inst-25x6.png 25w" sizes="(max-width: 1000px) 100vw, 1000px"></a></h1>
        <?php the_content(); ?>
    </div>

</div>


<?php if (showTheCam()) : ?>
<!-- DISPLAY THE WEBCAM -->
webcam time!
<!-- END DISPLAY THE WEBCAM -->
<?php else : ?>
<!-- ARTIFIZIO OMINI -->
<div id="videocontainer" class="fullscreen-video"> 
    <video id="videocontent" autoplay loop muted playsinline></video>
</div>
<!-- END ARTIFIZIO OMINI -->
<?php endif; ?>



<?php get_footer(); ?>
