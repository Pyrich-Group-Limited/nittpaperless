<div>
    <x-slot name="title">Upcoming Events</x-slot>
    @section('events')
        active
    @endsection

    <x-slot name="title">{{ $event->event_title }}</x-slot>
    <x-slot name="logo">{{ asset('guest/images/uploads/'.$event->image)}}</x-slot>
    <x-slot name="description">{!! Str::limit(strip_tags($event->description),100) !!}</x-slot>

    <div class="page-title-wrap typo-white" wire:ignore>
        <div class="page-title-wrap-inner section-bg-img" data-bg="{{ asset('guest/images/uploads/'.$event->image)}}">
            <span class="theme-overlay"></span>
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-12">
                        <div class="page-title-inner">
                            <div id="breadcrumb" class="breadcrumb margin-bottom-10">
                                <a href="{{ route('welcome') }}" class="theme-color">Home</a>
                                <a href="{{ route('events') }}" class="theme-color">Events</a>
                                <span class="current">Events Details</span>
                            </div>
                            <h1 class="page-title mb-0">Event Details</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-wrapper pad-none">
        <div class="content-inner">
            <!-- Event Single Section -->
            <section id="single-event" class="single-event">
                <div class="container">
                    <div class="single-event-wrap">
                        <!-- Row -->
                        <div class="row">
                            <!-- Col -->
                            <div class="col-md-8">
                                <!-- event img -->
                                <div class="zoom-gallery margin-bottom-35">
                                    <div class="events-thumb relative">
                                        <a class="popup-img" href="#" title="Single Portfolio">
                                            <img src="{{ asset('guest/images/uploads/'.$event->image)}}" width="70%" class="img-fluid single-event-img b-radius-10" alt="events-img" />
                                        </a>
                                    </div>
                                </div>
                                <div class="events-title-wrap pt-1 margin-bottom-35">
                                    <div class="events-content">
                                        <div class="events-title pad-none margin-none">
                                            <h3 class="margin-bottom-15"> <span class="theme-color">{{ $event->event_title }}</span></h3>
                                        </div>
                                        <p>{!! $event->description !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="event-details-wrap">

                                    <div class="event-venue pad-bottom-30">
                                        <h4>Event Details</h4>

                                        <p class="event-address"><span class="event-subtitle"><strong>Address : </strong></span>
                                            {{ $event->event_location}} <a class="zegen-popup-gmaps theme-color" href="https://maps.google.com/maps?q=12%2C+Victoria+Street%2C+Australia&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed"><span class="ti-location-pin"></span></a>
                                        </p>
                                        <p class="event-email"><span class="event-subtitle"><strong>Type of Event : </strong></span>
                                            {{ $event->type_of_event}}
                                        </p>
                                        <p class="event-phone"><span class="event-subtitle"><strong>Date : </strong></span>
                                            {{ $event->event_date->format('d M, Y')}}
                                        </p>
                                        <p class="event-website">
                                            <span class="event-subtitle"><strong>Time : </strong></span>
                                            {{ $event->event_time->format('h:m A')}}
                                        </p>
                                    </div>
                                    <div class="event-contact-wrap">
                                        <div class="event-contact-title">
                                            <h4 class="event-form-title">Event Registration</h4>
                                        </div>
                                        <x-feedback-alert />
                                         <!-- Form -->
                                        <div class="contact-form-wrap">
                                            <!-- form inputs -->
                                            <form wire:submit.prevent="registerEvent" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <!-- form group -->
                                                        <div class="form-group">
                                                            <input id="name" wire:model="name" class="form-control" name="name" placeholder="Name" data-bv-field="name" type="text">
                                                             @error('name') <p class="text-danger">{{$message}}</p>@enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <!-- form group -->
                                                        <div class="form-group">
                                                            <input id="email" wire:model="email" class="form-control" name="email" placeholder="Email" data-bv-field="email" type="email">
                                                            @error('email') <p class="text-danger">{{$message}}</p>@enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <!-- form group -->
                                                        <div class="form-group">
                                                            <input id="phone" wire:model="phoneno" maxlength="11" class="form-control" name="phoneno" placeholder="phoneno" data-bv-field="phoneno" type="text">
                                                            @error('phoneno') <p class="text-danger">{{$message}}</p>@enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <select class="form-control" aria-label="Default select example" wire:model.live="type_of_event">
                                                                <option selected="">How do you attending the event?</option>
                                                                <option value="Virtual">Virtual</option>
                                                                <option value="Physical">Physical</option>
                                                            </select>
                                                            @error('type_of_event')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <!-- form button -->
                                                        <button type="submit" id="contact-submit" class="btn btn-default mt-0 theme-btn">Register</button>
                                                        {{-- <button wire:loading wire:target="registerEvent" class="btn btn-default" type="submit"><x-guest-loader /></i></button> --}}
                                                    </div>
                                                </div>
                                                <span class="clearfix"></span>
                                            </form>
                                        </div>
                                        <!-- Form End-->
                                    </div>
                                    <!-- contact-form-7 -->
                                </div>
                            </div>
                            <!-- Col -->
                        </div>
                        <!-- Row -->
                        <!-- Row 2 -->
                        <div class="row">
                        </div>
                    </div>
                </div>
            </section>
            <!-- Portfolios Section End -->
        </div>
    </div>
</div>
<!-- .page-wrapper-inner -->
<!--page-wrapper-->
