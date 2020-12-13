<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Green Air Pos</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="<?php echo config('app.url'); ?>/resources/master/images/favicon.png" />
    <!-- animate -->
    <link rel="stylesheet" href="<?php echo config('app.url'); ?>/resources/master/home/animate.css">
    <!-- bootstrap -->
    <link rel="stylesheet" href="<?php echo config('app.url'); ?>/resources/master/home/bootstrap.min.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="<?php echo config('app.url'); ?>/resources/master/home/style.css">
    <!-- responsive Stylesheet -->
    <link rel="stylesheet" href="<?php echo config('app.url'); ?>/resources/master/home/responsive.css">   



    </head>
<body>

<!-- preloader area start -->
<div class="preloader" id="preloader" style="display: none;">
    <div class="preloader-inner">
        <div class="spinner">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
    </div>
</div>
<!-- preloader area end -->

<br>
<br>

<!-- navbar area start -->
<nav class="navbar navbar-area navbar-expand-lg">
    <div class="container nav-container">
        <div class="collapse navbar-collapse" id="riyaqas_main_menu">
            <div class="logo-wrapper desktop-logo">
                <a href="http://codingeek.io/html/riyaqas/index.html" class="logo">
                    <img src="<?php echo config('app.url'); ?>/resources/master/images/ga.png" height="100" weight="10" alt="logo">
                </a>
            </div>
        </div>
    </div>
</nav>
<!-- navbar area end -->

<!-- header area start -->
<div class="header-area h8-banner-area h8-banner-area-bg">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-6 col-md-6 offset-xl-1">
                <div class="header-inner-details">
                    <div class="header-inner">
                        <h1 class="title wow  fadeInUp animated" data-wow-duration="1s" data-wow-delay="0s" style="color:cadetblue; visible; animation-duration: 1s; animation-delay: 0s; animation-name: fadeInUp;">GREEN AIR</h1>
                        <p class="wow  fadeInUp animated" data-wow-duration="1s" data-wow-delay="0.3s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.3s; animation-name: fadeInUp;">One shop Electronics & Air Conditioning Solutions.</p>
                        <div class="btn-wrapper desktop-left padding-top-20 wow  fadeInUp animated" data-wow-duration="1s" data-wow-delay="0.6s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.6s; animation-name: fadeInUp;">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/home') }}" class="btn btn-radius btn-red-border mr-2 mb-2">Home</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-radius btn-red-border mr-2 mb-2" >Login</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-radius btn-blue mb-2">Register</a>
                                @endif
                            @endauth
                        @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 hidden-sm">
                <div class="banner-animate-thumb banner-animate-thumb-2">
                    <div class="header-img-1 wow  fadeInRight animated" data-wow-duration="1s" data-wow-delay="0s" style="visibility: visible; animation-duration: 1s; animation-delay: 0s; animation-name: fadeInRight;">
                        <img src="<?php echo config('app.url'); ?>/resources/master/images/11.png" alt="banner-img">
                    </div>
                    <div class="header-img-2 wow  fadeInDown animated" data-wow-duration="1s" data-wow-delay="0.5s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.5s; animation-name: fadeInDown;">
                        <img src="<?php echo config('app.url'); ?>/resources/master/images/12.png" alt="banner-img">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- header area End -->
 


</body></html>