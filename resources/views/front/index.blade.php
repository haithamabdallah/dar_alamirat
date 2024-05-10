<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dar Alamirat</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@2.0.0/dist/iconify-icon.min.js"></script>
    <link rel="icon" href="{{asset('front-assets/images/fav.png')}}">
    <link rel="stylesheet" href="{{asset('front-assets/css/style.min.css')}}">
    <?php

    $msg = isset($_GET['msg']) ? $_GET['msg'] : '';

    ?>
</head>
<body>




    <div class="slideshow">
        <div class="slideshow-image" style="background-image: url({{asset('front-assets/images/slide-01.jpg')}})"></div>
        <div class="slideshow-image" style="background-image: url({{asset('front-assets/images/slide-02.jpg')}})"></div>
        <div class="slideshow-image" style="background-image: url({{asset('front-assets/images/slide-03.jpg')}})"></div>
    </div>


    <!-- Hero Section -->
    <section id="hero">
        <div class="hero-content">

            <div id="logo">
                <a href="javascript:;">
                    <img src="{{asset('front-assets/images/dar-logo.svg')}}" alt="">
                </a>
            </div>


            <div class="subtitle">
                <span>Skin Care - Makeups - Baby Supplies - Personal Care</span>
            </div>


            <div id="counter">
                <div class="item">
                    <div class="text">
                        <span id="days"></span>
                    </div>
                </div>

                <div class="item">
                    <div class="text">
                        <span id="hours"></span>
                    </div>
                </div>

                <div class="item">
                    <div class="text">
                        <span id="minutes"></span>
                    </div>
                </div>

                <div class="item">
                    <div class="text">
                        <span id="seconds"></span>
                    </div>
                </div>
            </div>

            <div class="subtitle">
                <?php
                if($msg == null){
                  echo"<span>Get Subscribe to our mailing list for latest update</span>";

              }
              else{
                echo"<span>Thanks for subscribing</span>";
              }



              ?>
              <!--  <span>Get Subscribe to our mailing list for latest update</span>-->
                <div class="email-box">
                    <form action="mail.php" method="post">
                        <input type="email" placeholder="Your Email" name="email">
                        <input type="submit"  style="background-color: transparent;width:200px;color: whitesmoke;margin-top: 24px;text-align: center;font-size: 25px;cursor: pointer;" value="Subscribe">
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ./Hero Section -->

    <!-- footer -->
    <footer>
        <p>Made With Love by: <a href="https://www.pixeldm.ca/">Pixel Digital Marketing</a></p>
        <ul class="menu">
            <li><a href="javascript:;"><iconify-icon icon="tabler:brand-facebook" width="24" height="24"></iconify-icon></a></li>
            <li><a href="javascript:;"><iconify-icon icon="tabler:brand-instagram" width="24" height="24"></iconify-icon></a></li>
            <li><a href="javascript:;"><iconify-icon icon="tabler:brand-snapchat" width="24" height="24"></iconify-icon></a></li>
            <li><a href="javascript:;"><iconify-icon icon="tabler:mail-fast" width="24" height="24"></iconify-icon></a></li>
        </ul>
    </footer>
    <!-- ./footer -->

    <script src="{{asset('front-assets/js/scripts.js')}}"></script>

</body>
</html>
