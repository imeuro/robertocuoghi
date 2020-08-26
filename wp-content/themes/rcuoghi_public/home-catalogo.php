<?php /* Template Name: Home Sito */  get_header(); ?>


<div class="container-full homepage">

    <div class="onecol hidden">
        <h1><a href="<?php echo get_site_url().'/artworks/'; ?>" title="Roberto Cuoghi artworks">
        <img src="https://www.robertocuoghi.com/wp-content/uploads/2019/09/coniglio2019-1024x794.jpg" alt="This is the official website of Roberto Cuoghi (born September 23, 1973, Modena, Italy)" class="wp-image-2034" srcset="https://www.robertocuoghi.com/wp-content/uploads/2019/09/coniglio2019-1024x794.jpg 1024w, https://www.robertocuoghi.com/wp-content/uploads/2019/09/coniglio2019-508x394.jpg 508w, https://www.robertocuoghi.com/wp-content/uploads/2019/09/coniglio2019-973x754.jpg 973w, https://www.robertocuoghi.com/wp-content/uploads/2019/09/coniglio2019-25x19.jpg 25w, https://www.robertocuoghi.com/wp-content/uploads/2019/09/coniglio2019.jpg 1125w" sizes="(max-width: 1024px) 100vw, 1024px"></a></h1>
        <?php the_content(); ?>
    </div>

</div>

<!-- ARTIFIZIO OMINI -->
<div id="videocontainer" class="fullscreen-video"> 
    <video id="videocontent" autoplay loop muted playsinline></video>
</div>
<!-- END ARTIFIZIO OMINI -->


<?php get_footer(); ?>
