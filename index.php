<!DOCTYPE html>
<?php
if(file_exists('./bot/.maintenance.txt')){
    header('location: /maintenance');
    die;
}
?>
<html lang="en">
    <head>
        <script src="https://telegram.org/js/telegram-web-app.js" onload="window.Telegram.WebApp.expand(); window.Telegram.WebApp.setHeaderColor('#000000'); window.Telegram.WebApp.setBackgroundColor('#000000');"></script>
        <meta charset="UTF-8"/>
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://tog.tg"/>
        <meta property="og:site_name" content="The Tog">
        <meta property="og:title" content="The Tog"/>
        <!-- <meta property="og:image" content="https://cobuild.ams3.cdn.digitaloceanspaces.com/website/logo-32.png" /> -->
        <meta property="og:description" content="The Tog"/>
        <meta property="og:locale" content="en_US"/>
        <!-- <link rel="shortcut icon" type="image/png" href="https://cobuild.ams3.cdn.digitaloceanspaces.com/website/logo-32.png" /> -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
        <title>BLACK NINJA</title>
        <style>
            body, html {
                background-color: #000;
                height: 100vh;
                padding: 0;
                margin: 0;
            }

            #woof {
                position: absolute;
                bottom: 35%;
                -webkit-transition: opacity 1s ease-in;
                -moz-transition: opacity 1s ease-in;
                transition: opacity 1s ease-in;
                z-index: 100;
                will-change: transform, opacity;
                text-align: center;
                width: 100%;
                font-size: 24px;
                opacity: 0;
            }

            #loader {
                position: absolute;
                top: 50%;
                /* top: 80px; */
                left: 50%;
                -webkit-transform: translate(-50%, -webkit-calc(-50% - 91px));
                -moz-transform: translate(-50%, -moz-calc(-50% - 91px));
                -ms-transform: translate(-50%, calc(-50% - 91px));
                transform: translate(-50%, calc(-50% - 91px));
                -webkit-transition: all .5s ease;
                -moz-transition: all .5s ease;
                transition: all .5s ease;
                /* transition: top .5s ease, width .5s ease, height .5s ease, opacity .6 ease; */
                z-index: 100;
                will-change: transform, opacity;
                width: 237px;
                height: 242px;
            }

            #loader.readyToSlide {
                top: 280px;
                width: 82px;
                height: 84px;
            }

            #loader.readyToFadeOut {
                opacity: 0;
            }

            #off-loader {
                position: absolute;
                top: 50%;
                left: 50%;
                -webkit-transform: translate(-50%, -webkit-calc(-50% - 91px + 43px));
                -moz-transform: translate(-50%, -moz-calc(-50% - 91px + 43px));
                -ms-transform: translate(-50%, calc(-50% - 91px + 43px));
                transform: translate(-50%, calc(-50% - 91px + 43px));
                -webkit-transition: all .3s ease;
                -moz-transition: all .3s ease;
                transition: all .3s ease;
                z-index: 90;
                opacity: 0;
                display: none;
                -webkit-box-orient: vertical;
                -webkit-box-direction: normal;
                -webkit-flex-direction: column;
                -moz-box-orient: vertical;
                -moz-box-direction: normal;
                flex-direction: column;
                padding-bottom: 40px;
            }

            #off-loader svg {
                width: 237px;
                height: 242px;
            }

            #off-loader div {
                margin-top: 20px;
                height: 20px;
                font-size: 20px;
                display: -webkit-box;
                display: -webkit-flex;
                display: -moz-box;
                display: flex;
                -webkit-box-align: center;
                -webkit-align-items: center;
                -moz-box-align: center;
                align-items: center;
                -webkit-box-pack: center;
                -webkit-justify-content: center;
                -moz-box-pack: center;
                justify-content: center;
            }

            #off-loader.readyToFadeIn {
                opacity: 1;
            }

            .preload {
                opacity: 0;
                display: none;
            }
        </style>
        <script defer data-domain="onetime.dog" src="/assets/script.js"></script>
        <script type="module" crossorigin src="/assets/index-2f78f68e.js?v=232"></script>
        <link rel="modulepreload" crossorigin href="/assets/vendor-1253c29e.js">
        <link rel="stylesheet" href="/assets/index-26cd5fcb.css">
    </head>
    <body data-mode="dark">
        <img class="preload" src="/assets/star.png"/>
        <div id="woof">woof</div>
        <img id="loader" xmlns="http://www.w3.org/2000/svg" width="237" height="245" viewBox="0 0 237 245" fill="none" src="logo.png">
            
        <div id="off-loader">
            <img id="loader" xmlns="http://www.w3.org/2000/svg" width="237" height="245" viewBox="0 0 237 245" fill="none" src="logo.png">
               
            <Br><Br><Br>
            <div>Who are you Ninja?</div>
        </div>
        <div id="root"></div>
        <script>
            setTimeout(()=>{
                if (document.getElementById('woof')) {
                    document.getElementById('woof').style.opacity = '1'
                }
            }
            , 10000)
        </script>
    </body>
</html>
