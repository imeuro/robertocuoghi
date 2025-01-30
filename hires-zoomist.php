<html>
<head>
    <title>Zoomist</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/zoomist@2/zoomist.css" />
    <style>
        /* Minimal CSS Reset */
        html{box-sizing:border-box;font-size:16px}*,*:before,*:after{box-sizing:inherit}body,h1,h2,h3,h4,h5,h6,p,ol,ul{margin:0;padding:0;font-weight:normal}ol,ul{list-style:none}img{max-width:100%;height:auto}

        body { background: transparent; }
        .zoomist-container,
        .zoomist-wrapper,
        .zoomist-image {
            width: 100vw;
            margin: 0 auto;
            height:100dvh;
            /* background: #ffff; */
        }
        .zoomist-image {
            width: 100%;
            aspect-ratio: 1;
        }

        .zoomist-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
            background: #fff;
            cursor: grab
        }
        .zoomist-zoomer { 
            top: 50%;
            right: 5px;
            transform: translateY(-50%);
            border-radius: 2px;
        }
        .zoomist-slider.zoomist-slider-horizontal {
            top: initial;
            bottom: 5px;
            left: 50%;
            transform: translateX(-50%);
        }
        .zoomist-slider-button:before,
        .zoomist-slider-button:hover:before {
            box-shadow: none;
        }

        :root {
            --zoomist-slider-bg-color: rgba(255, 255, 255, .8);
            --zoomist-slider-border-radius: 3px;
            --zoomist-slider-padding-x: 40px;
            --zoomist-slider-padding-y: 20px;
            --zoomist-slider-track-color: rgba(0, 0, 0, .25);
            --zoomist-slider-track-color-hover: rgba(0, 0, 0, .8);
            --zoomist-slider-bar-size: 250px;
            --zoomist-slider-bar-side: 1px;
            --zoomist-slider-bar-border-radius: 2px;
            --zoomist-slider-bar-color: rgba(0, 0, 0, .25);
            --zoomist-slider-bar-color-hover: rgba(0, 0, 0, .8);
            --zoomist-slider-button-size: 15px;
            --zoomist-slider-button-color: rgba(50, 50, 50, 1);
        }
        </style>
</head>
<body>
    <?php
    if ($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == 'meuro.dev') {
        $base_url = '/robertocuoghi';
    } else {
        $base_url = '';
    }
    $hires_url = $base_url."/hires/{$_GET['art_code']}.jpg";
    //print_r($hires_url);
    ?>
    <div id="hiresZoom" class="zoomist-container"  style="background:#fff;">
        <div class="zoomist-wrapper">
            <div class="zoomist-image">
                <img src="<?php echo $hires_url; ?>" />
            </div>
        </div>
    </div>
    <script type="module">
    import Zoomist from 'https://cdn.jsdelivr.net/npm/zoomist@2/zoomist.js'
    const zoomist = new Zoomist('.zoomist-container', {
        // Optional parameters
        maxScale: 8,
        bounds: true,
        // if you need slider
        slider: true,
        // if you need zoomer
        zoomer: false
    });
    </script>
</body>
