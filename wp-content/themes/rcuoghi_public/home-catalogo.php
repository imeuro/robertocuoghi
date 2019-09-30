<?php /* Template Name: Home Sito */  get_header(); ?>


<div class="container-full homepage">

    <div class="onecol hidden">
        <h1><a href="<?php echo get_site_url().'/artworks/'; ?>" title="Roberto Cuoghi artworks"><img src="https://www.robertocuoghi.com/wp-content/uploads/2019/02/inst.png" alt="This is the official website of Roberto Cuoghi (born September 23, 1973, Modena, Italy)" class="wp-image-1572" srcset="https://www.robertocuoghi.com/wp-content/uploads/2019/02/inst.png 1000w, https://www.robertocuoghi.com/wp-content/uploads/2019/02/inst-508x124.png 508w, https://www.robertocuoghi.com/wp-content/uploads/2019/02/inst-973x238.png 973w, https://www.robertocuoghi.com/wp-content/uploads/2019/02/inst-25x6.png 25w" sizes="(max-width: 1000px) 100vw, 1000px"></a></h1>
        <?php the_content(); ?>
    </div>

</div>

<!-- ARTIFIZIO OMINI -->
<div id="videocontainer" class="fullscreen-video"> 
    <video id="videocontent" autoplay loop muted playsinline></video>
</div>
<style>
    body.fixed {
        overflow: hidden;
        position: fixed;
    }
    #page { float: left; }
    div#videocontainer {
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100vw;
        height: 100vh;
        z-index: 1000;
        opacity: 1;
        transition: opacity 500ms ease-in-out;
        cursor: pointer;
        backgroud: #fff;
    }

    #videocontainer.hidden,
    .homepage .onecol.hidden { opacity : 0; }
    #videocontainer video {
        min-height: 100vh;
        width: auto;
        min-width: 100vw;
        position: relative;
        left: 50%;
        transform: translateX(-50%);
    }
</style>  
<!-- END ARTIFIZIO OMINI -->


<?php get_footer(); ?>
