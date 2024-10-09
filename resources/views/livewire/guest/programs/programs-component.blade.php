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
                                <span class="current">Programs</span>
                            </div>
                            <h1 class="page-title mb-0">Our Programs</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page-header -->

    <section id="ministries-section" class="ministries-section pad-bottom-70">
        <div class="container">
             <!-- Sermon Main Wrap -->
            <div class="ministries-main-wrap ministries-grid">
                <!-- Row -->
                <div class="row">
                    <!-- Col -->
                    <div class="col-md-12">
                        <!-- Row -->
                        <div class="row">
                            @foreach($programs as $program)
                            <div class="col-md-4">
                                <div class="ministries-box-style-2">
                                    <!-- Ministries Inner -->
                                    <div class="ministries-inner">
                                        <div class="ministries-thumb">
                                            <img class="img-fluid squared w-100" src="{{ asset('guest/images/uploads/'.$program->program_image)}}" width="360" height="240" alt="Agricultural Processing">
                                        </div>

                                        <!-- Ministries Content -->
                                        <div class="ministries-content pad-lr-30 pad-top-20">
                                            <div class="ministries-title margin-bottom-15">
                                                <h4 class="text-center"><a href="{{ route('programs.show',[str_replace("/","",$program->program_title),$program->id])}}" class="ministries-link">{{ $program->program_title}}</a></h4>
                                            </div>
                                            <div class="ministries-desc">
                                                <p>{!! Str::limit(strip_tags($program->program_description),70) !!}</p>
                                            </div>
                                            <div class="ministries-link margin-top-15 margin-bottom-30">
                                                <a  href="{{ route('programs.show',[str_replace("/","",$program->program_title),$program->id])}}" class="link">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Ministries Inner Ends -->
                                </div>
                            </div>
                            @endforeach
                            <!-- Col -->
                        </div>
                        <!-- row -->
                    </div>
                </div>
                <!-- Row -->
            </div>
            <!-- Sermon Main Wrap -->
        </div>
        <!-- Container -->
    </section>
</div>
<!-- .page-wrapper-inner -->
