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
                                <a href="{{ route('welcome')}}" class="img-before"><img width="60%" src="{{ asset('guest/images/logo-dark.png') }}" class="img-fluid" width="149" height="45" alt="Logo"></a>
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
                                    <a href="{{ route('welcome')}}" class="logo-general"><img src="{{ asset('guest/images/logo-dark.png') }}" class="img-fluid" width="60%" alt="Marketwell Solutions" /></a>
                                    <a href="{{ route('welcome')}}" class="logo-sticky"><img src="{{ asset('guest/images/logo-dark.png') }}" class="img-fluid" width="60%" alt="Marketwell Solutions" /></a>
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
                                            <li class="@yield('home')"><a href="{{ route('welcome')}}">Home</a></li>
                                            <li class="@yield('about')"><a href="{{ route('about')}}">About Us</a></li>
                                            <li class="@yield('services')"><a href="{{ route('services')}}">Services</a></li>
                                            <li class="@yield('programs')"><a href="{{ route('programs')}}">Programs</a></li>
                                            <li class="@yield('events')"><a href="{{ route('events')}}">Events</a></li>
                                            <li class="@yield('contacts')"><a href="{{ route('contact')}}">Contact</a></li>
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
