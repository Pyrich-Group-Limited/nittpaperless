<div>
    <x-slot name="title">Upcoming Events</x-slot>
    @section('events')
        active
    @endsection


    <div class="page-title-wrap typo-white" wire:ignore>
        <div class="page-title-wrap-inner section-bg-img" data-bg="{{ asset('/guest/rs-plugin/assets/z2-slider-1.jpg') }}">
            <span class="theme-overlay"></span>
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-12">
                        <div class="page-title-inner">
                            <div id="breadcrumb" class="breadcrumb margin-bottom-10">
                                <a href="{{ route('welcome') }}" class="theme-color">Home</a>
                                <span class="current">events</span>
                            </div>
                            <h1 class="page-title mb-0">Our Events</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page-header -->
    <div class="content-wrapper pad-none">
        <div class="content-inner">
            <!-- Events Section -->
            @if($nextEvent!=null)
            <section class="day-counter-section typo-white section-bg-img o-visible pad-top-150 pad-bottom-180" data-bg="images/bg/bg-4.jpg">
                <span class="theme-overlay"></span>
                <div class="shape-top" data-negative="false">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 283.5 27.8" preserveAspectRatio="xMidYMax slice">
    <path class="shape-fill" d="M0 0v6.7c1.9-.8 4.7-1.4 8.5-1 9.5 1.1 11.1 6 11.1 6s2.1-.7 4.3-.2c2.1.5 2.8 2.6 2.8 2.6s.2-.5 1.4-.7c1.2-.2 1.7.2 1.7.2s0-2.1 1.9-2.8c1.9-.7 3.6.7 3.6.7s.7-2.9 3.1-4.1 4.7 0 4.7 0 1.2-.5 2.4 0 1.7 1.4 1.7 1.4h1.4c.7 0 1.2.7 1.2.7s.8-1.8 4-2.2c3.5-.4 5.3 2.4 6.2 4.4.4-.4 1-.7 1.8-.9 2.8-.7 4 .7 4 .7s1.7-5 11.1-6c9.5-1.1 12.3 3.9 12.3 3.9s1.2-4.8 5.7-5.7c4.5-.9 6.8 1.8 6.8 1.8s.6-.6 1.5-.9c.9-.2 1.9-.2 1.9-.2s5.2-6.4 12.6-3.3c7.3 3.1 4.7 9 4.7 9s1.9-.9 4 0 2.8 2.4 2.8 2.4 1.9-1.2 4.5-1.2 4.3 1.2 4.3 1.2.2-1 1.4-1.7 2.1-.7 2.1-.7-.5-3.1 2.1-5.5 5.7-1.4 5.7-1.4 1.5-2.3 4.2-1.1c2.7 1.2 1.7 5.2 1.7 5.2s.3-.1 1.3.5c.5.4.8.8.9 1.1.5-1.4 2.4-5.8 8.4-4 7.1 2.1 3.5 8.9 3.5 8.9s.8-.4 2 0 1.1 1.1 1.1 1.1 1.1-1.1 2.3-1.1 2.1.5 2.1.5 1.9-3.6 6.2-1.2 1.9 6.4 1.9 6.4 2.6-2.4 7.4 0c3.4 1.7 3.9 4.9 3.9 4.9s3.3-6.9 10.4-7.9 11.5 2.6 11.5 2.6.8 0 1.2.2c.4.2.9.9.9.9s4.4-3.1 8.3.2c1.9 1.7 1.5 5 1.5 5s.3-1.1 1.6-1.4c1.3-.3 2.3.2 2.3.2s-.1-1.2.5-1.9 1.9-.9 1.9-.9-4.7-9.3 4.4-13.4c5.6-2.5 9.2.9 9.2.9s5-6.2 15.9-6.2 16.1 8.1 16.1 8.1.7-.2 1.6-.4V0H0z"></path>
    </svg>		</div>
                <div class="container">
                    <div class="row">
                        <div class="offset-md-2 col-md-8">
                            <div class="title-wrap text-center mb-5">
                                <div class="section-title">
                                    <span class="sub-title theme-color text-uppercase">Upcomming Event</span>
                                    <h2 class="section-title margin-top-5">{{ $nextEvent->event_title }}</h2>
                                    <span class="border-bottom center"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <!-- Day Counter -->
                            <div class="day-counter-wrapper pt-3 day-counter-1 day-counter-transparent text-center">
                                <div class="day-counter day-counter-progress" data-date="{{ $nextEvent->event_date->format('Y/m/d') }}" data-size="140">
                                        <div class="counter-elements counter-day rounded">
                                            <div class="counter-item">
                                                <div class="day-count-details">
                                                    <h3 class="count-view theme-color mt-2 mb-2">Number</h3>
                                                    <span>Days</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- .counter-day -->
                                        <div class="counter-elements counter-hour rounded">
                                            <div class="counter-item">
                                                <div class="day-count-details">
                                                    <h3 class="count-view theme-color mt-2 mb-2">Number</h3>
                                                    <span>Hours</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- .counter-hour -->
                                        <div class="counter-elements counter-min rounded">
                                            <div class="counter-item">
                                                <div class="day-count-details">
                                                    <h3 class="count-view theme-color mt-2 mb-2">Number</h3>
                                                    <span>Minutes</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- .counter-min -->
                                        <div class="counter-elements counter-sec rounded">
                                            <div class="counter-item">
                                                <div class="day-count-details">
                                                    <h3 class="count-view theme-color mt-2 mb-2">Number</h3>
                                                    <span>Seconds</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- .counter-sec -->
                                    </div>
                                    <!-- .day-counter -->
                                <span class="custom-heading-title relative">{{ $nextEvent->event_date->format('d M Y') }} | {{ $nextEvent->event_time->format('h:i A') }}</span>
                            </div>
                            <!-- .day-counter-wrapper -->
                        </div>
                    </div>
                </div>
                <div class="shape-bottom" data-negative="false">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 283.5 27.8" preserveAspectRatio="xMidYMax slice">
                      <path class="shape-fill" d="M0 0v6.7c1.9-.8 4.7-1.4 8.5-1 9.5 1.1 11.1 6 11.1 6s2.1-.7 4.3-.2c2.1.5 2.8 2.6 2.8 2.6s.2-.5 1.4-.7c1.2-.2 1.7.2 1.7.2s0-2.1 1.9-2.8c1.9-.7 3.6.7 3.6.7s.7-2.9 3.1-4.1 4.7 0 4.7 0 1.2-.5 2.4 0 1.7 1.4 1.7 1.4h1.4c.7 0 1.2.7 1.2.7s.8-1.8 4-2.2c3.5-.4 5.3 2.4 6.2 4.4.4-.4 1-.7 1.8-.9 2.8-.7 4 .7 4 .7s1.7-5 11.1-6c9.5-1.1 12.3 3.9 12.3 3.9s1.2-4.8 5.7-5.7c4.5-.9 6.8 1.8 6.8 1.8s.6-.6 1.5-.9c.9-.2 1.9-.2 1.9-.2s5.2-6.4 12.6-3.3c7.3 3.1 4.7 9 4.7 9s1.9-.9 4 0 2.8 2.4 2.8 2.4 1.9-1.2 4.5-1.2 4.3 1.2 4.3 1.2.2-1 1.4-1.7 2.1-.7 2.1-.7-.5-3.1 2.1-5.5 5.7-1.4 5.7-1.4 1.5-2.3 4.2-1.1c2.7 1.2 1.7 5.2 1.7 5.2s.3-.1 1.3.5c.5.4.8.8.9 1.1.5-1.4 2.4-5.8 8.4-4 7.1 2.1 3.5 8.9 3.5 8.9s.8-.4 2 0 1.1 1.1 1.1 1.1 1.1-1.1 2.3-1.1 2.1.5 2.1.5 1.9-3.6 6.2-1.2 1.9 6.4 1.9 6.4 2.6-2.4 7.4 0c3.4 1.7 3.9 4.9 3.9 4.9s3.3-6.9 10.4-7.9 11.5 2.6 11.5 2.6.8 0 1.2.2c.4.2.9.9.9.9s4.4-3.1 8.3.2c1.9 1.7 1.5 5 1.5 5s.3-1.1 1.6-1.4c1.3-.3 2.3.2 2.3.2s-.1-1.2.5-1.9 1.9-.9 1.9-.9-4.7-9.3 4.4-13.4c5.6-2.5 9.2.9 9.2.9s5-6.2 15.9-6.2 16.1 8.1 16.1 8.1.7-.2 1.6-.4V0H0z"></path>
                    </svg>
                </div>
            </section>
            @endif
            <section id="events-section" class="events-section pad-top-120 pad-bottom-70">
                <!-- Screan Reader Text -->
                <h2 class="screen-reader-text">Events</h2>
                <div class="container">
                    <!-- Row -->
                    <div class="row">
                        <!-- Col -->
                        <div class="col-md-12">
                            <!--events Main wrap-->
                            <div class="events-main-wrapper events-grid events-style-2">
                                <div class="row">
                                    @if($searchBar)<x-search-bar wire:model.live="searchTerm" placeholder="Search event by title or description" />@endif

                                    @if(count($events)>0)
                                        @foreach($events as $event)
                                        <div class="col-lg-4 col-md-6">
                                            <!--events Inner-->
                                            <div class="events-inner margin-bottom-30">
                                                <!--events Thumb-->
                                                <div class="events-thumb mb-0 relative">
                                                    <img src="{{ asset('guest/images/uploads/'.$event->image)}}" class="img-fluid thumb w-100" width="768" height="650" alt="events-img" />
                                                </div>
                                                <!--events details-->
                                                <div class="events-details pad-lr-30 pad-bottom-35">
                                                    <div class="event-date margin-bottom-30">{{ $event->event_date->format('M Y')}}<span class="event-time">{{ $event->event_time->format('h:i A')}}</span>
                                                    </div>
                                                    <div class="event-title mb-3">
                                                        <h5><a href="{{ route('events.show',[$event->id])}}">{{ $event->event_title }}</a></h5>
                                                    </div>
                                                    <div class="read-more">
                                                        <a href="{{ route('events.show',[$event->id])}}">Event Details</a>
                                                    </div>
                                                </div>
                                                <!--events details-->
                                            </div>
                                            <!--events Inner Ends-->
                                        </div>
                                        @endforeach
                                    @else
                                    <div class="example-alert">
                                        <div class="alert alert-danger alert-icon" align="center">
                                            <em class="icon ni ni-cross-circle" ></em> <strong>Sorry</strong>! No any upcoming event.
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <!-- events Row -->
                                <div class="col-lg-12">
                                    <div class="post-pagination-wrap margin-top-30">
                                        <ul class="nav pagination post-pagination justify-content-center test-pagination">
                                            {{ $events->links() }}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- events Main wrap Ends -->
                        </div>
                        <!-- Col -->
                    </div>
                    <!-- Row -->
                </div>
            </section>

            <!-- events Section Ends -->
        </div>
    </div>
</div>
<!-- .page-wrapper-inner -->
<!--page-wrapper-->
