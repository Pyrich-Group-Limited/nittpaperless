<footer id="footer" class="footer footer-1 footer-bg-img" data-bg="images/bg/footer-bg.jpg') }}">
    <!--Footer Widgets Columns Posibilities 4-->
    <div class="footer-widgets">
        <div class="footer-middle-wrap footer-overlay-dark">
            <div class="color-overlay"></div>
            <div class="container">
                <div class="row">
                     <div class="col-lg-3 widget text-widget">
                        <div class="widget-title">
                            <!-- Title -->
                            <h3 class="title typo-white">About MWS </h3>
                        </div>
                        <!-- Text -->
                        <div class="widget-text margin-bottom-30">
                            <p>CASTLE EDUCATION CONSULT is a firm with a passion to re-orient the minds of students, schools, and educational administrators at all levels on progressively productive learning outcomes in Africa.</p>
                        </div>
                        <div class="social-icons">
                            <a href="#" class="social-fb"><span class="ti-facebook"></span></a>
                            <a href="#" class="social-twitter"><span class="ti-twitter"></span></a>
                            <a href="#" class="social-instagram"><span class="ti-instagram"></span></a>
                            <a href="#" class="social-pinterest"><span class="ti-pinterest"></span></a>
                            <a href="#" class="social-youtube"><span class="ti-youtube"></span></a>
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
                                <li class="menu-item"><a href="{{ route('services')}}">We we are</a></li>
                                <li class="menu-item"><a href="{{ route('about')}}">About</a></li>
                                <li class="menu-item"><a href="{{ route('contact')}}">Contact</a></li>
                                <li class="menu-item"><a href="{{ route('events')}}">Events</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Col -->
                    {{-- @if(count($events)>0)
                    <div class="col-lg-4 widget recent-posts">
                        <div class="widget-title">
                            <!-- Title -->
                            <h3 class="title typo-white">Upcoming Event</h3>
                        </div>
                        <nav>
                            <ul class="footer-list-posts">
                                <!-- List Items -->
                                @foreach($events as $event)
                                <li>
                                    <div class="side-image">
                                        <a href="{{ route('guest.events.details',[$event->event_title,$event->id])}}"><img width="80" height="80" alt="{{ $event->event_title}}"
                                                src="{{ asset('assets/images/events/'.$event->image)}}" class="img-responsive wp-post-image" alt="Blog"></a>
                                    </div>
                                    <div class="side-item-text"><a href="{{ route('guest.events.details',[$event->event_title,$event->id])}}">{{ $event->event_title}}</a>
                                        <span class="post-date d-block">{{ $event->event_date->format('d M, Y')}}</span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                    @else
                    <div class="col-lg-4 widget recent-posts">
                        <div class="widget-title">
                            <!-- Title -->
                            <h3 class="title typo-white">Grow w/ Mike Okuneye</h3>
                        </div>
                        <nav>
                            <ul class="footer-list-posts">
                                <!-- List Items -->
                                @foreach($services as $service)
                                <li>
                                    <div class="side-image">
                                        <a href="{{ route('services.show',[str_replace("/","",$service->service_title),$service->id])}}"><img width="80" height="80" alt="{{ $service->service_title}}"
                                                src="{{ asset('guest/uploads/'.$service->service_image)}}" class="img-responsive wp-post-image" alt="Blog"></a>
                                    </div>
                                    <div class="side-item-text"><a href="{{ route('services.show',[str_replace("/","",$service->service_title),$service->id])}}">{{ $service->service_title}}</a>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                    @endif --}}
                    <!-- Col -->
                    <div class="col-lg-3 widget contact-info-widget">
                        <div class="widget-title">
                            <!-- Title -->
                            <h3 class="title typo-white">Newsletter</h3>
                        </div>
                        <p>Sign up for our newsletter to stay updated on all events at Castle Education Consult, Special Promotions and More.</p>
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
                                    Copyrights  © 2024 <a href="#">Castle Education Consult</a>. </span>
                                </div>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
