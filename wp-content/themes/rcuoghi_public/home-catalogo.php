<?php /* Template Name: Home Sito */  get_header(); ?>


<div class="container-full homepage">

    <div class="onecol">
        <h1><a href="<?php echo get_site_url().'/artworks/'; ?>" title="Roberto Cuoghi artworks"><img src="https://www.robertocuoghi.com/wp-content/uploads/2019/02/inst.png" alt="This is the official website of Roberto Cuoghi (born September 23, 1973, Modena, Italy)" class="wp-image-1572" srcset="https://www.robertocuoghi.com/wp-content/uploads/2019/02/inst.png 1000w, https://www.robertocuoghi.com/wp-content/uploads/2019/02/inst-508x124.png 508w, https://www.robertocuoghi.com/wp-content/uploads/2019/02/inst-973x238.png 973w, https://www.robertocuoghi.com/wp-content/uploads/2019/02/inst-25x6.png 25w" sizes="(max-width: 1000px) 100vw, 1000px"></a></h1>
        <?php the_content(); ?>
    </div>

</div>

<!-- ARTIFIZIO OMINI -->
<div id="videocontainer" class="fullscreen-video"> 
    <video id="videocontent" autoplay loop muted playsinline></video>
</div>
<style>
    body {
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
    }
    #videocontainer.hidden,
    .homepage .onecol.hidden { opacity : 0; }
    video {
        min-height: 100vh;
        width: auto;
        min-width: 100vw;
        position: relative;
        left: 50%;
        transform: translateX(-50%);
    }
</style>
<script>
    var Vcont = document.getElementById('videocontainer');
    var Vtag = document.getElementById('videocontent');
    var Pcont = document.querySelector('.homepage .onecol');
    
    var Vurl = 'https://www.robertocuoghi.com/wp-content/uploads/intro/Retrobalera_1080';

    Pcont.classList.add('hidden'); // ASAP!

    var chooseVideoFormat = function() {
        var sw = window.innerWidth;
        if (sw < 640) {
            Vurl = 'https://www.robertocuoghi.com/wp-content/uploads/intro/Retrobalera_mob';
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

        //console.log('video chosen: '+Vurl);
    }

    chooseVideoFormat();

    window.onresize = function(event) {
        setTimeout(chooseVideoFormat(),500)
    };

    Vcont.addEventListener("click", Vfadeout);
    function Vfadeout() {
        // console.log('Vcont clicked');
        Vcont.className += ' hidden';
        setTimeout(() => {
            Vcont.remove();
        }, 500);
    };

    Vtag.addEventListener("canplay", BGfadein);
    function BGfadein() {
        console.log('BGfadein running');
        Vtag.play();
        setTimeout(() => {
            Pcont.classList.remove('hidden');
        }, 500);
    };
</script>
<!-- END ARTIFIZIO OMINI -->


<?php get_footer(); ?>
