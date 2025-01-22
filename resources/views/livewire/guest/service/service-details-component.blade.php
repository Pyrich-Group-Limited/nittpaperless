<div>
    @section('advert')
        active
    @endsection

    <x-slot name="title">What we do</x-slot>
    <x-slot name="logo">@if($advert->image){{ asset('guest/images/uploads/'.$advert->image) }} @else {{ asset('uploads/procurement.png')}} @endif</x-slot>
    <x-slot name="description">{!! Str::limit(strip_tags($advert->description), 100) !!}</x-slot>
    <x-slot name="title">{{ $advert->service_title }}</x-slot>

    <div class="page-title-wrap typo-white">
        <div class="page-title-wrap-inner section-bg-img" data-bg="@if($advert->image){{ asset('guest/images/uploads/'.$advert->image) }} @else {{ asset('uploads/procurement.png')}} @endif">
            <span class="theme-overlay"></span>
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-12">
                        <div class="page-title-inner">
                            <div id="breadcrumb" class="breadcrumb margin-bottom-10">
                                <a href="{{ route('welcome') }}" class="theme-color">Home</a>
                                <span class="current">Contract Advert</span>
                            </div>
                            <h1 class="page-title mb-0">{{ $advert->project->project_name }}</h1>
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
                                                <img src="@if($advert->image){{ asset('guest/images/uploads/'.$advert->image) }} @else {{ asset('uploads/procurement.png')}} @endif"
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
                                        <p class="margin-bottom-15">{!! $advert->description !!}.</p>
                                    </div>
                                        <div class="header-navbar-text-1"><a href="{{ route('contractor.register') }}" class="h-donate-btn">Proceed to Bid</a></div>
                                    <!-- Col -->
                                </div>

                            </div>
                            <!-- Col -->

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
