<div>
    <x-slot name="title">What we do</x-slot>
    @section('services') active @endsection

    <div class="page-title-wrap typo-white" wire:ignore>
        <div class="page-title-wrap-inner section-bg-img" data-bg="{{ asset('/guest/rs-plugin/assets/z2-slider-1.jpg') }}">
            <span class="theme-overlay"></span>
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-12">
                        <div class="page-title-inner">
                            <div id="breadcrumb" class="breadcrumb margin-bottom-10">
                                <a href="{{ route('welcome')}}" class="theme-color">Home</a>
                                <span class="current">Services</span>
                            </div>
                            <h1 class="page-title mb-0">What we do</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page-header -->

    <section id="events-section" class="events-section pad-bottom-70">
        <!-- Screan Reader Text -->
        <h2 class="screen-reader-text">What we do</h2>
        <div class="container">
            <!-- Row -->
            <div class="row">
                <!-- Col -->
                <div class="col-md-12">
                    <!--events Main wrap-->
                    <div class="events-main-wrapper events-grid events-style-4">
                        <div class="row">
                            <div class="offset-md-2 col-md-8">
                                <div class="title-wrap text-center">
                                    <div class="section-title">
                                        <span class="sub-title theme-color text-uppercase">Services</span>
                                        <h2 class="section-title margin-top-5">What we do</h2>
                                        <span class="border-bottom center"></span>
                                    </div>
                                </div>
                            </div>
                            <!-- Col-md -->
                            @foreach($services as $service)
                            <div class="col-lg-4 col-md-6">
                                <!--events Inner-->
                                <div class="events-inner margin-bottom-30">
                                    <!--events Thumb-->
                                    <div class="events-thumb mb-0 relative">
                                        <img src="{{ asset('guest/images/uploads/'.$service->service_image)}}" class="img-fluid thumb w-100" width="768" height="456" alt="{{ $service->title }}">
                                    </div>
                                    <!--events details-->
                                    <div class="events-details pad-30">

                                        <div class="event-title mb-3">
                                            <h5><a href="{{ route('services.show',[str_replace("/","",$service->service_title),$service->id])}}">{{ $service->service_title }}</a></h5>
                                        </div>
                                        <div class="event-excerpt mb-3">
                                            <p>{!! Str::limit(strip_tags($service->service_description),70) !!}</p>
                                        </div>
                                        <div class="read-more">
                                            <a href="{{ route('services.show',[str_replace("/","",$service->service_title),$service->id])}}">Learn more</a>
                                        </div>
                                    </div>
                                    <!--events details-->
                                </div>
                                <!--events Inner Ends-->
                            </div>
                            <!--Col-md Ends-->
                            @endforeach
                        </div>
                        <!-- events Row -->
                    </div>
                    <!-- events Main wrap Ends -->
                </div>
                <!-- Col -->
            </div>
            <!-- Row -->
        </div>
    </section>
</div>
<!-- .page-wrapper-inner -->
