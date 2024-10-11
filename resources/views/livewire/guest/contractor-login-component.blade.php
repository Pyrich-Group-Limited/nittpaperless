<div>
    <x-slot name="title">User Authentitcation</x-slot>
    @section('contact') active @endsection

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
                                    <h4 class="title">Authorized Access</h4><hr>
                                    <!-- form inputs -->
                                    <x-feedback-alert />
                                    <form class="contact-form" wire:submit.prevent="login" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!-- form group -->
                                                <div class="form-group mt-2">
                                                    <input id="email" class="form-control" wire:model="email" name="email" placeholder="Email"  type="email">
                                                    @error('email') <p class="text-danger">{{$message}}</p>@enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-1">
                                                <!-- form group -->
                                                <div class="form-group">
                                                    <input id="password" class="form-control" wire:model="password" name="password" placeholder="password"  type="password">
                                                    @error('password') <p class="text-danger">{{$message}}</p>@enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <!-- form button -->
                                                <button  type="submit" class="btn btn-default mt-0 theme-btn">Register <div wire:loading wire:target="login"><x-guest-loader/></div></button> Arleady have an account ? <a href="{{ route('contractor.login')}}"> Login</a>
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