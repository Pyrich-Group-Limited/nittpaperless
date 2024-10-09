<header class="header-floating">
    <!--Mobile Header-->
    <div class="mobile-header bg-white typo-dark">
        <div class="mobile-header-inner">
            <div class="sticky-outer">
                <div class="sticky-head">
                    <div class="basic-container clearfix">
                        <ul class="nav mobile-header-items pull-left">
                            <li class="nav-item"><a href="#" class="zmm-toggle img-before"><i class="ti-menu"></i></a></li>
                        </ul>
                        <ul class="nav mobile-header-items pull-center">
                            <li>
                                <a href="{{ route('welcome')}}" class="img-before"><img src="{{ asset('guest/images/logo-dark.png') }}" class="img-fluid" width="149" height="45" alt="Logo"></a>
                            </li>
                        </ul>
                        <ul class="nav mobile-header-items pull-right">
                            <li class="nav-item"><a href="#" class="img-before overlay-search-switch"><i class="icon-magnifier icons"></i></a></li>
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
    <div class="header-inner header-2 header-absolute">
        <!--Topbar-->
        <div class="topbar">
            <div class="basic-container clearfix">
                <ul class="nav topbar-items pull-left">
                    <li class="nav-item">
                        <ul class="nav header-info">
                            <div class="header-address typo-white"><span class="ti-location-pin"></span> 684 West College St. Sun City, USA</div>
                        </ul>
                    </li>
                </ul>
                <ul class="nav topbar-items pull-right">
                    <li class="nav-item">
                        <div class="social-icons typo-white">
                            <a href="#" class="social-fb"><span class="ti-facebook"></span></a>
                            <a href="#" class="social-twitter"><span class="ti-twitter"></span></a>
                            <a href="#" class="social-instagram"><span class="ti-instagram"></span></a>
                        </div>
                    </li>
                    <li><a href="#" class="full-view-switch text-center"><i class="ti-search typo-white"></i></a></li>
                    <!--Search-->
                    <div class="full-view-wrapper hide">
                        <a href="#" class="close full-view-close"></a>
                        <form class="navbar-form search-form" role="search">
                            <div class="input-group">
                                <input class="form-control" placeholder="Search hit enter.." name="srch-term" type="text">
                            </div>
                        </form>
                    </div>
                </ul>
            </div>
        </div>
        <!--Topbar-->
        <!--Sticky part-->
        <div class="sticky-outer">
            <div class="sticky-head">
                <!--Navbar-->
                <nav class="navbar">
                    <div class="basic-container bg-light b-radius-10 clearfix">
                        <div class="navbar-inner">
                            <!--Overlay Menu Switch-->
                            <ul class="nav navbar-items pull-left">
                                <li class="list-item">
                                    <a href="index.html" class="logo-general"><img src="{{ asset('guest/images/logo-dark.png') }}" class="img-fluid" width="166" height="50" alt="Logo" /></a>
                                    <a href="index.html" class="logo-sticky"><img src="{{ asset('guest/images/logo-dark.png') }}" class="img-fluid" width="166" height="50" alt="Logo" /></a>
                                </li>
                            </ul>
                            <!-- Menu -->
                            <ul class="nav navbar-items pull-right">
                                <!--List Item-->
                                <li class="list-item">
                                    <ul class="nav navbar-main menu-dark">
                                        <li class="@yield('home')"><a href="{{ route('welcome')}}">Home</a></li>
                                        <li class="@yield('about')"><a href="{{ route('about')}}">About Us</a></li>
                                        <li class="@yield('services')"><a href="{{ route('services')}}">Services</a></li>
                                        <li class="@yield('programs')"><a href="{{ route('programs')}}">Program</a></li>
                                        <li class="@yield('events')"><a href="{{ route('events')}}">Events</a></li>
                                        <li class="@yield('contacts')"><a href="{{ route('contact')}}">Contact</a></li>
                                    </ul>
                                </li>
                                <!--List Item End-->
                                <!--List Item-->
                                <li class="list-item">
                                    <div class="header-navbar-text-1"><a href="donate-now.html" class="h-donate-btn">Sign up</a></div>
                                </li>
                                <!--List Item End-->
                            </ul>
                            <!-- Menu -->
                        </div>
                    </div>
                    <!--Search-->
                </nav>
            </div>
            <!--sticky-head-->
        </div>
        <!--sticky-outer-->
    </div>
</header>
