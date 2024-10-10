<div>
    @section('service')
        active
    @endsection

    <x-slot name="title">What we do</x-slot>
    <x-slot name="logo">{{ asset('guest/images/uploads/'.$service->service_image)}}</x-slot>
    <x-slot name="description">{!! Str::limit(strip_tags($service->service_description), 100) !!}</x-slot>
    <x-slot name="title">{{ $service->service_title }}</x-slot>

    <div class="page-title-wrap typo-white">
        <div class="page-title-wrap-inner section-bg-img" data-bg="{{ asset('guest/images/uploads/'.$service->service_image)}}">
            <span class="theme-overlay"></span>
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-12">
                        <div class="page-title-inner">
                            <div id="breadcrumb" class="breadcrumb margin-bottom-10">
                                <a href="{{ route('welcome') }}" class="theme-color">Home</a>
                                <span class="current">What we do</span>
                            </div>
                            <h1 class="page-title mb-0">{{ $service->service_title }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page-header -->
    <!-- Page Content -->
    <div class="content-wrapper pad-none">
        <div class="content-inner">
            <section id="ministries-section" class="ministries-section pad-bottom-70">
                <div class="container">
                    <!-- Sermon Main Wrap -->
                    <div class="ministries-main-wrap ministries-grid">
                        <!-- Row -->
                        <div class="row">
                            <!-- Col -->
                            <div class="col-lg-8">
                                <!-- Row -->
                                <div class="row">
                                    <!-- Col -->
                                    <div class="col-md-12">
                                        <!-- sermon img -->
                                        <div class="zoom-gallery">
                                            <div class="ministries-thumb relative margin-bottom-35">
                                                <img src="{{ asset('guest/images/uploads/'.$service->service_image)}}"
                                                    class="img-fluid single-sermon-img b-radius-10" width="1170"
                                                    height="694" alt="ministries-img">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Col -->
                                </div>
                                <!-- Row -->
                                <!-- Row 2 -->
                                <div class="row">
                                    <!-- Col -->
                                    <div class="col-md-12">
                                        <p class="margin-bottom-15">{!! $service->service_description !!}.</p>
                                    </div>
                                    <!-- Col -->
                                </div>

                            </div>
                            <!-- Col -->
                            <div class="col-lg-4 ps-5 px-sm-15">
                                <!-- Sidebar -->
                                <div class="sidebar right-sidebar">
                                    <!-- Search -->
                                    <div class="widget search-widget">
                                        <div class="search-form-wrapper">
                                            <form class="search-form" role="search">
                                                <div class="input-group add-on">
                                                    <input class="form-control" placeholder="Search for.."
                                                        name="srch-term" type="text">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-default search-btn" type="submit"><i
                                                                class="ti-arrow-right"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Search -->
                                    <!-- Popular Post -->
                                    <div class="widget popular-posts">
                                        <div class="widget-title">
                                            <!-- Title -->
                                            <h3 class="title">What we do</h3>
                                        </div>
                                        <ul class="list-post-content">
                                            @foreach ($services as $service)
                                                <li>
                                                    <!--Media-->
                                                    <div class="media list-post">
                                                        <span class="popular-thumb me-3">
                                                            <img width="70" height="70" class="rounded"
                                                                src="{{ asset('guest/images/uploads/'.$service->service_image)}}"
                                                                alt="">
                                                        </span>
                                                        <div class="media-body">
                                                            <a
                                                                href="{{ route('services.show',[str_replace("/","",$service->service_title),$service->id])}}">{{ $service->service_title }}</a>
                                                        </div>
                                                    </div>
                                                    <!-- Media End -->
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                </div>
                                <!-- Sidebar -->
                            </div>
                            <!-- Col -->
                        </div>
                        <!-- Row -->
                    </div>
                    <!-- Sermon Main Wrap -->
                </div>
                <!-- Container -->
            </section>
        </div>
    </div>
</div>
<!-- .page-wrapper-inner -->
<!--page-wrapper-->
