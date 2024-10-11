<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <title><?php echo e($title ?? 'NITT e-Procurment'); ?></title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <meta property="og:type" content="website">
    <meta property="og:locale" content="en_NG">
    <meta property="og:url" content="<?php echo e(\URL::current()); ?>">
    <meta property="og:title" content="<?php echo e($title ?? 'Nigeria Institute of Transport Technology'); ?>">
    <meta property="og:description"  content="<?php echo e($description ?? 'The leading Transport and Logistics Development Institute in Nigeria and the entire West African sub-region, setting the standard for excellence and innovation in the industry'); ?>">
    <meta property="og:image" content="<?php echo e($logo ?? asset('guest/images/meta-logo.png')); ?>">

    <meta property="twitter:type" content="website">
    <meta property="twitter:locale" content="en_NG">
    <meta property="twitter:url" content="<?php echo e(\URL::current()); ?>">
    <meta property="twitter:title" content="<?php echo e($title ?? 'Nigeria Institute of Transport Technology'); ?>">
    <meta property="twitter:description"  content="<?php echo e($description ?? 'The leading Transport and Logistics Development Institute in Nigeria and the entire West African sub-region, setting the standard for excellence and innovation in the industry'); ?>">
    <meta property="twitter:image" content="<?php echo e($logo ?? asset('guest/images/meta-logo.png')); ?>">

    <meta name="google:card" content="summary_large_image">
    <meta name="google:url" content="<?php echo e(\URL::current()); ?>">
    <meta name="google:description" content="<?php echo e($description ?? 'The leading Transport and Logistics Development Institute in Nigeria and the entire West African sub-region, setting the standard for excellence and innovation in the industry'); ?>">
    <meta name="google:title" content="<?php echo e($title ?? 'Nigeria Institute of Transport Technology'); ?>">
    <meta name="google:image" content="<?php echo e($logo ?? asset('guest/images/meta-logo.png')); ?>">

    <meta name="description" content="<?php echo e($description ?? 'The leading Transport and Logistics Development Institute in Nigeria and the entire West African sub-region, setting the standard for excellence and innovation in the industry'); ?>" />
    <meta name="author" content="Nigeria Institute of Transport Technology" />
    <meta name="url" content="<?php echo e(\URL::current()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords" content="mission, mobilizing, igniting, training, seminars, Grow with Mike " />
    <link href="<?php echo e(asset('guest/images/favicon.png')); ?>" rel="icon">
    <!--Title-->
    <title>Zegen - Home 2</title>
    <!-- CSS -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo e(asset('guest/css/bootstrap.min.css')); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('guest/css/font-awesome.min.css')); ?>">
    <!-- Simple Line Icons -->
    <link rel="stylesheet" href="<?php echo e(asset('guest/css/simple-line-icons.min.css')); ?>">
    <!-- Themify Icons -->
    <link rel="stylesheet" href="<?php echo e(asset('guest/css/themify-icons.css')); ?>">
    <!-- Owl Slider -->
    <link rel="stylesheet" href="<?php echo e(asset('guest/css/owl.carousel.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('guest/css/owl.theme.default.min.css')); ?>">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="<?php echo e(asset('guest/css/magnific-popup.css')); ?>">
	 <!-- Revolution Slider -->
	 <link rel="stylesheet" type="text/css" href="<?php echo e(asset('guest/rs-plugin/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css')); ?>">
	 <!-- REVOLUTION STYLE SHEETS -->
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('guest/rs-plugin/css/settings.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('guest/rs-plugin/css/home-2/rs6.css')); ?>">
    <!-- Main Style -->
    <link rel="stylesheet" href="<?php echo e(asset('guest/css/color-schemes/red.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('guest/css/style.css')); ?>" class="main-style">
    <style>	#rev_slider_6_1_wrapper .tp-loader.spinner1{ background-color: #FFFFFF !important; } </style>
	<style>.rs-layer.Concept-Content a,.rs-layer.Concept-Content a:visited{color:#fff !important; border-bottom:1px solid #fff !important; font-weight:700 !important}.rs-layer.Concept-Content a:hover{border-bottom:1px solid transparent !important}.rs-layer.Concept-Content-Dark a,.rs-layer.Concept-Content-Dark a:visited{color:#000 !important; border-bottom:1px solid #000 !important; font-weight:700 !important}.rs-layer.Concept-Content-Dark a:hover{border-bottom:1px solid transparent !important}@media only screen and (max-width:575px){rs-layer.res-slide-btn{padding:7px 16px !important;  font-size:13px !important}}#rev_slider_2_1_wrapper .uranus.tparrows{width:50px; height:50px; background:rgba(255,255,255,0)}#rev_slider_2_1_wrapper .uranus.tparrows:before{width:50px; height:50px; line-height:50px; font-size:40px; transition:all 0.3s;-webkit-transition:all 0.3s}#rev_slider_2_1_wrapper .uranus.tparrows.rs-touchhover:before{opacity:0.75}</style>
    <?php echo \Livewire\Livewire::styles(); ?>

</head>
<!--Body Start-->
<body data-res-from="1025">
    <div class="page-loader"></div>

    <div class="zmm-wrapper">
        <a href="#" class="zmm-close close"></a>
        <div class="zmm-inner bg-white typo-dark">
            <div class="text-center mobile-logo-part margin-bottom-30">
                 <a href="<?php echo e(route('welcome')); ?>" class="img-before"><img src="<?php echo e(asset('logo-dark.png')); ?>" class="img-fluid" width="170" height="51" alt="Logo"></a>
            </div>
            <div class="zmm-main-nav">
            </div>
			<div class="search-form-wrapper margin-top-30">
			    <form class="search-form" role="search">
			        <div class="input-group add-on">
			            <input class="form-control" placeholder="Search for.." name="srch-term" type="text">
			            <div class="input-group-btn">
			                <button class="btn btn-default search-btn" type="submit"><i class="ti-arrow-right"></i></button>
			            </div>
			        </div>
			    </form>
			</div>
        </div>
    </div>

    <!-- Main wrapper-->
    <div class="page-wrapper">
        <div class="page-wrapper-inner">
            <?php echo $__env->make('includes.page-navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <!-- header -->
			<!-- START Zegen Home 2 REVOLUTION SLIDER 6.6.5 --><p class="rs-p-wp-fix"></p>

            <?php echo e($slot); ?>

        </div>
        <!-- .page-wrapper-inner -->
    </div>
    <!--page-wrapper-->

    <!-- Footer -->
    <footer id="footer" class="footer footer-1 footer-bg-img" data-bg="images/bg/footer-bg.jpg') }}">
        <!--Footer Widgets Columns Posibilities 4-->
        <div class="footer-widgets">
            <div class="footer-middle-wrap footer-overlay-dark">
                <div class="color-overlay"></div>
                <div class="container">
                    <div class="row">
                         <div class="col-lg-5 widget text-widget">
                            <div class="widget-title">
                                <!-- Title -->
                                <h3 class="title typo-white">About CEC </h3>
                            </div>
                            <!-- Text -->
                            <div class="widget-text margin-bottom-30">
                                <p>The leading Transport and Logistics Development Institute in Nigeria and the entire West African sub-region, setting the standard for excellence and innovation in the industry.</p>
                            </div>
                            
                        </div>
                        <!-- Col -->
                        <div class="col-lg-3 widget text-widget">
                            <div class="widget-title">
                                <!-- Title -->
                                <h3 class="title typo-white">Quick Links</h3>
                            </div>
                            <!-- Text -->
                            <div class="menu-quick-links">
                                <ul class="menu">
                                    <li class="menu-item"><a href="">Hoe</a></li>
                                    <li class="menu-item"><a href="">Adverts</a></li>
                                    <li class="menu-item"><a href="">Login</a></li>
                                    <li class="menu-item"><a href="">Signup</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Col -->
                        
                        <!-- Col -->
                        <div class="col-lg-4 widget contact-info-widget">
                            <div class="widget-title">
                                <!-- Title -->
                                <h3 class="title typo-white">Newsletter</h3>
                            </div>
                            <p>Sign up for our newsletter to stay updated on all events at Nigeria Institute of Transport Technology, Contract Adverts.</p>
                            <div class="mailchimp-widget-wrap">
                                <!-- subscribe form -->
                                <form id="subscribe-form-1" class="subscribe-form" action="inc/function.php">
                                    <div class="input-group add-on">
                                        <input type="text" class="form-control" name="mcemail" autocomplete="off" id="mcemail-1" placeholder="Email Address">
                                        <div class="input-group-btn">
                                            <button class="btn btn-default subscribe-btn" type="submit">Sign Up</button>
                                        </div>
                                    </div>
                                    <p class="subscribe-status-msg hide"></p>
                                </form>
                            </div>
                        </div>
                        <!-- Col -->
                    </div>
                </div>
            </div>
        </div>
        <!--Footer Copyright Columns Posibilities 4-->
        <div class="footer-copyright">
            <div class="footer-bottom-wrap pad-tb-20 typo-white">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="footer-bottom-items ">
                                <li class="nav-item">
                                    <div class="nav-item-inner">
                                        Copyrights  © 2024 <a href="#">National Institute of Transport Technology</a>. </span>
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Footer -->
    <!-- jQuery Lib -->
    <script src="<?php echo e(asset('guest/js/jquery.min.js')); ?>"></script>
    <!-- Bootstrap Js -->
    <script src="<?php echo e(asset('guest/js/bootstrap.bundle.min.js')); ?>"></script>
    <!-- Easing Js -->
    <script src="<?php echo e(asset('guest/js/jquery.easing.min.js')); ?>"></script>
    <!-- Carousel Js Code -->
    <script src="<?php echo e(asset('guest/js/owl.carousel.min.js')); ?>"></script>
    <!-- Isotope Js -->
    <script src="<?php echo e(asset('guest/js/isotope.pkgd.min.js')); ?>"></script>
    <!-- Magnific Popup Js -->
    <script src="<?php echo e(asset('guest/js/jquery.magnific-popup.min.js')); ?>"></script>
	<!-- Day Counter Js -->
    <script src="<?php echo e(asset('guest/js/jquery.countdown.min.js')); ?>"></script>
	<!-- Circle Progress Js -->
    <script src="<?php echo e(asset('guest/js/jquery.circle.progress.min.js')); ?>"></script>
	<!-- Validator Js -->
    <script src="<?php echo e(asset('guest/js/validator.min.js')); ?>"></script>
    <!-- Smart Resize Js -->
    <script src="<?php echo e(asset('guest/js/smartresize.min.js')); ?>"></script>
    <!-- Appear Js -->
    <script src="<?php echo e(asset('guest/js/jquery.appear.min.js')); ?>"></script>
    <!-- Theme Custom Js -->
    <script src="<?php echo e(asset('guest/js/custom.js')); ?>"></script>
	<!-- REVOLUTION JS FILES -->
	<script src="<?php echo e(asset('guest/rs-plugin/js/jquery.themepunch.tools.min.js')); ?>"></script>
	<script src="<?php echo e(asset('guest/rs-plugin/js/jquery.themepunch.revolution.min.js')); ?>"></script>
	<!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
	<script src="<?php echo e(asset('guest/rs-plugin/js/home-2/rbtools.min.js')); ?>"></script>
	<script src="<?php echo e(asset('guest/rs-plugin/js/home-2/rs6.min.js')); ?>"></script>
	<script src="<?php echo e(asset('guest/rs-plugin/js/home-2/home-2.js')); ?>"></script>
    <?php echo \Livewire\Livewire::scripts(); ?>

</body>
<!-- Body End -->
</html>
<?php /**PATH C:\xampp\htdocs\nittpaperless\resources\views/layouts/guest.blade.php ENDPATH**/ ?>