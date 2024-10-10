<header>
    <!--Mobile Header-->
    <div class="mobile-header bg-white typo-dark">
        <div class="mobile-header-inner">
            <div class="sticky-outer">
                <div class="sticky-head">
                    <div class="basic-container clearfix" style="padding: 10px">
                        <ul class="nav mobile-header-items pull-right">
                            <li class="nav-item"><a href="#" class="zmm-toggle img-before"><i class="ti-menu"></i></a></li>
                        </ul>
                        <ul class="nav mobile-header-items pull-left">
                            <li>
                                <a href="#" class="img-before"><img width="60%" src="<?php echo e(asset('logo-dark.png')); ?>" width="70" class="img-fluid" width="149" height="45" alt="Logo"></a>
                            </li>
                        </ul>

                    </div>
                    <!-- .basic-container -->
                </div>
                <!-- .sticky-head -->
            </div>
            <!-- .sticky-outer -->
        </div>
        <!-- .mobile-header-inner -->
    </div>
    <!-- .mobile-header -->
    <!--Header-->
    <div class="header-inner header-1">
        <!--Sticky part-->
        <div class="sticky-outer">
            <div class="sticky-head">
                <!--Navbar-->
                <nav class="navbar nav-shadow">
                    <div class="basic-container clearfix">
                        <div class="navbar-inner">
                            <!--Overlay Menu Switch-->
                            <ul class="nav navbar-items pull-left">
                                <li class="list-item">
                                    <a href="#" class="logo-general"><img src="<?php echo e(asset('logo-dark.png')); ?>" class="img-fluid" width="70" alt="Marketwell Solutions" /></a>
                                    <a href="#" class="logo-sticky"><img src="<?php echo e(asset('logo-dark.png')); ?>" class="img-fluid" width="70" alt="Marketwell Solutions" /></a>
                                </li>
                            </ul>
                            <!-- Menu -->
                            <ul class="nav navbar-items pull-right">
                                <style>

                                    @media screen and (min-width: 600px) {
                                        #desktopSideBar {
                                            visibility: hidden;
                                            display: none;
                                        }
                                    }
                                </style>
                                <!--List Item-->
                                    <li class="list-item">
                                        <ul class="nav navbar-main menu-dark">
                                            <li class="<?php echo $__env->yieldContent('home'); ?>"><a href="#">Home</a></li>
                                            <li class="<?php echo $__env->yieldContent('about'); ?>"><a href="#">Contracts Adverts</a></li>
                                            <li class="<?php echo $__env->yieldContent('login'); ?>"><a href="#">Login</a></li>
                                        </ul>
                                    </li>
                                    <!--List Item End-->
                                    <!--List Item-->
                                    <li class="list-item">
                                        <div class="header-navbar-text-1"><a href="#" class="h-donate-btn">Sign Up</a></div>
                                    </li>
                                <!--List Item End-->
                            </ul>
                            <!-- Menu -->
                        </div>
                    </div>
                </nav>
            </div>
            <!--sticky-head-->
        </div>
        <!--sticky-outer-->
    </div>
</header>
<?php /**PATH C:\xampp-server\htdocs\nittpaperless\resources\views/includes/page-navbar.blade.php ENDPATH**/ ?>