<div>
    <div>
        <x-slot name="title">User Authentitcation</x-slot>
        @section('contact') active @endsection

        {{-- <div class="page-title-wrap typo-white" wire:ignore>
            <div class="page-title-wrap-inner section-bg-img" data-bg="{{ asset('guest/images/contact/contact_bg1.jpg') }}">
                <span class="theme-overlay"></span>
                <div class="container">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <div class="page-title-inner">
                                <div id="breadcrumb" class="breadcrumb margin-bottom-10">
                                    <a href="{{ route('welcome')}}" class="theme-color">Home</a>
                                    <span class="current">Contact</span>
                                </div>
                                <h1 class="page-title mb-0">Contact Us</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- page-header --> --}}

        <!-- Page Content -->
        <div class="content-wrapper pad-none">
            <div class="content-inner">
                <!-- Contact Section -->
                <section class="contact-form-section form-with-img">
                    <div class="container">
                        <div class="row">
                            <!-- col -->
                            <div class="col-lg-6 pad-none">
                                <img src="{{ asset('uploads/login.png')}}" width="80%" />
                            </div>
                            <div class="col-lg-6 pe-0">
                                <!-- Contact Form -->
                                <div class="contact-form-4 bg-white">
                                    <!-- Form -->
                                    <div class="contact-form-wrap">
                                    <h4 class="title">Account Creation</h4><hr>

                                        <!-- form inputs -->
                                        <form class="contact-form" wire:submit.prevent="signup" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <!-- form group -->
                                                    <div class="form-group">
                                                        <input class="form-control" wire:model.defer="surname" placeholder="Surname"  type="text" />
                                                        @error('surname') <p class="text-danger">{{$message}}</p>@enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <!-- form group -->
                                                    <div class="form-group">
                                                        <input class="form-control" wire:model.defer="othernames"  placeholder="Othername"  type="text" />
                                                        @error('othernames') <p class="text-danger">{{$message}}</p>@enderror
                                                    </div>
                                                </div>
                                                {{-- <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input class="form-control" wire:model.defer="company_name"  placeholder="Company Name"  type="text" />
                                                        @error('company_name') <p class="text-danger">{{$message}}</p>@enderror
                                                    </div>
                                                </div> --}}
                                                <div class="col-md-12">
                                                    <!-- form group -->
                                                    <div class="form-group">
                                                        <input id="email" class="form-control" wire:model.defer="email" placeholder="Email"  type="email">
                                                        @error('email') <p class="text-danger">{{$message}}</p>@enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <!-- form group -->
                                                    <div class="form-group">
                                                        <input id="phone" class="form-control" wire:model="phoneno" placeholder="Phone Number"  type="text">
                                                        @error('phoneno') <p class="text-danger">{{$message}}</p>@enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <!-- form group -->
                                                    <div class="form-group">
                                                        <input id="phone" class="form-control" wire:model="password" placeholder="password"  type="password">
                                                        @error('password') <p class="text-danger">{{$message}}</p>@enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <!-- form group -->
                                                    <div class="form-group">
                                                        <input id="phone" class="form-control" wire:model="password_confirmation" name="password_confirmation" placeholder="Confirm Password"  type="password">
                                                        @error('password_confirmation') <p class="text-danger">{{$message}}</p>@enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                        <!-- form button -->
                                                        <button  type="submit" class="btn btn-default mt-0 theme-btn">Register <div wire:loading wire:target="signup"><x-guest-loader/></div></button> Arleady have an account ? <a href="{{ route('contractor.login')}}"> Login</a>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- form inputs end -->
                                    </div>
                                    <!-- Form End-->
                                </div>
                                <!-- contact-form-1 -->
                            </div>
                            <!-- .col -->

                             <!-- Col -->
                        </div>
                    </div>
                </section>
                <!-- Contact Form Section End -->
            </div>
        </div>
    </div>
    <!-- .page-wrapper-inner -->

</div>
