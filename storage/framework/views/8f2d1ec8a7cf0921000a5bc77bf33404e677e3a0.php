<?php if (isset($component)) { $__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015 = $component; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\GuestLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

    <?php $__env->startSection('home'); ?> active <?php $__env->stopSection(); ?>
    <rs-module-wrap id="rev_slider_2_1_wrapper" data-alias="Zegen-Home-2" data-source="gallery" style="visibility:hidden;background:#000000;padding:0;margin:0px auto;margin-top:0;margin-bottom:0;">
        <rs-module id="rev_slider_2_1" style="" data-version="6.6.5">
            <rs-slides style="overflow: hidden; position: absolute;">
                <rs-slide style="position: absolute;" data-key="rs-5" data-title="Web Show" data-thumb="<?php echo e(asset('/guest/rs-plugin/assets/z2-slider-1-100x100.jpg')); ?>" data-anim="adpr:false;f:random;" data-in="o:0;r:ran(-45|45);sx:0;sy:0;row:5;col:5;" data-out="a:false;">
                    <img src="<?php echo e(asset('guest/rs-plugin/assets/dummy.png')); ?>" alt="Non Profit Wordpress Theme - Slider" title="z2-slider-1" width="1920" height="1080" class="rev-slidebg tp-rs-img rs-lazyload" data-lazyload="<?php echo e(asset('/guest/rs-plugin/assets/z2-slider-1.jpg')); ?>" data-parallax="5" data-no-retina>
<!--
                    --><h1
                        id="slider-2-slide-5-layer-2"
                        class="rs-layer Concept-Title"
                        data-type="text"
                        data-color="#ffffff||rgba(255, 255, 255, 1)||rgba(255, 255, 255, 1)||rgba(255, 255, 255, 1)"
                        data-rsp_ch="on"
                        data-xy="x:c;y:m;yo:7px,0,-10px,-48px;"
                        data-text="w:normal,nowrap,nowrap,normal;s:40,50,45,28;l:82,55,50,30;fw:800,700,700,700;a:center;"
                        data-dim="w:1098px,845px,736px,478px;h:92px,auto,auto,35px;"
                        data-padding="b:10;"
                        data-frame_0="o:1;"
                        data-frame_0_chars="d:5;x:105%;o:1;rY:45deg;rZ:90deg;"
                        data-frame_0_mask="u:t;"
                        data-frame_1="st:2110;sp:1200;sR:2110;"
                        data-frame_1_chars="e:power4.inOut;d:10;rZ:0deg;"
                        data-frame_1_mask="u:t;"
                        data-frame_999="x:left;e:power3.in;st:w;sp:1000;sR:3790;"
                        data-frame_999_reverse="x:true;"
                        style="z-index:10;font-family:'Open Sans';"
                    >Nigeria Institute of Transport Technology
                    </h1><!--

                    --><rs-layer
                        id="slider-2-slide-5-layer-4"
                        class="Concept-SubTitle"
                        data-type="text"
                        data-color="#bf0a30"
                        data-rsp_ch="on"
                        data-xy="x:c;xo:0,0,0,-1px;y:m;yo:-55px,-47px,-55px,-81px;"
                        data-text="w:normal,nowrap,nowrap,nowrap;s:23,20,20,15;l:21,25,20,20;ls:1px,0px,0px,0px;fw:700;a:center,center,left,left;"
                        data-dim="w:612px,424px,auto,auto;"
                        data-padding="b:10;"
                        data-frame_0="sX:2;sY:2;"
                        data-frame_0_mask="u:t;"
                        data-frame_1="e:power2.out;st:640;sp:1000;sR:640;"
                        data-frame_1_mask="u:t;"
                        data-frame_999="x:left;e:power3.in;st:w;sp:1000;sR:7360;"
                        data-frame_999_reverse="x:true;"
                        style="z-index:11;font-family:'Poppins';"
                    >Welcome to
                    </rs-layer><!--

                    --><rs-layer
                        id="slider-2-slide-5-layer-14"
                        data-type="text"
                        data-rsp_ch="on"
                        data-xy="x:c;xo:0,0,0,7px;y:m,t,t,t;yo:91px,312px,271px,218px;"
                        data-text="w:normal;s:18,18,16,15;l:31,30,30,27;a:center;"
                        data-dim="w:806px,805px,689px,388px;h:auto,auto,auto,89px;"
                        data-frame_0="y:100%;"
                        data-frame_0_mask="u:t;"
                        data-frame_1="st:2680;sp:1360;sR:2680;"
                        data-frame_1_mask="u:t;"
                        data-frame_999="o:0;st:w;sR:4960;"
                        style="z-index:9;font-family:'Open Sans';"
                    >The leading Transport and Logistics Development Institute in Nigeria and the entire West African sub-region, setting the standard for excellence and innovation in the industry.
                    </rs-layer><!--

                    --><a
                        id="slider-2-slide-5-layer-19"
                        class="rs-layer rev-btn"
                        href="#" target="_self"
                        data-type="button"
                        data-rsp_ch="on"
                        data-xy="x:c;xo:0,0,0,5px;yo:526px,404px,361px,323px;"
                        data-text="w:normal;s:18,14,14,12;l:50,41,36,32;fw:700;"
                        data-dim="minh:0px,none,none,none;"
                        data-padding="t:0,0,10,10;r:40,40,25,25;b:0,0,10,10;l:40,40,25,25;"
                        data-border="bor:6px,6px,6px,6px;"
                        data-frame_0="y:100%;"
                        data-frame_1="e:power4.inOut;st:3790;sp:1200;"
                        data-frame_999="o:0;st:w;sR:3460;"
                        data-frame_hover="bgc:#000;bor:6px,6px,6px,6px;sp:100;e:power1.inOut;bri:120%;"
                        style="z-index:12;background-color:#bf0a30;font-family:'Poppins';"
                    >Learn more
                    </a><!--
-->						</rs-slide>
                <rs-slide style="position: absolute;" data-key="rs-7" data-title="Web Show" data-thumb="<?php echo e(asset('/guest/rs-plugin/assets/z2-slider-2-100x100.jpg')); ?>" data-anim="adpr:false;f:random;" data-in="o:0;r:ran(-45|45);sx:0;sy:0;row:5;col:5;" data-out="a:false;">
                    <img src="<?php echo e(asset('guest/rs-plugin/assets/dummy.png')); ?>" alt="Non Profit Wordpress Theme - Slider" title="z2-slider-2" width="1920" height="1080" class="rev-slidebg tp-rs-img rs-lazyload" data-lazyload="<?php echo e(asset('/guest/rs-plugin/assets/z2-slider-2.jpg')); ?>" data-parallax="5" data-no-retina>
<!--
                    --><h1
                        id="slider-2-slide-7-layer-2"
                        class="rs-layer Concept-Title"
                        data-type="text"
                        data-color="#ffffff||rgba(255, 255, 255, 1)||rgba(255, 255, 255, 1)||rgba(255, 255, 255, 1)"
                        data-rsp_ch="on"
                        data-xy="x:c;y:m;yo:7px,0,-10px,-54px;"
                        data-text="w:normal,nowrap,nowrap,normal;s:45,50,45,28;l:82,55,50,30;fw:800,700,700,700;a:center;"
                        data-dim="w:1098px,845px,736px,478px;h:92px,auto,auto,35px;"
                        data-padding="b:10;"
                        data-frame_0="o:1;"
                        data-frame_0_chars="d:5;x:105%;o:1;rY:45deg;rZ:90deg;"
                        data-frame_0_mask="u:t;"
                        data-frame_1="st:2110;sp:1200;sR:2110;"
                        data-frame_1_chars="e:power4.inOut;d:10;rZ:0deg;"
                        data-frame_1_mask="u:t;"
                        data-frame_999="x:left;e:power3.in;st:w;sp:1000;sR:4190;"
                        data-frame_999_reverse="x:true;"
                        style="z-index:10;font-family:'Open Sans';"
                    >Nigeria Institute of Transport Technology
                    </h1><!--

                    --><rs-layer
                        id="slider-2-slide-7-layer-4"
                        class="Concept-SubTitle"
                        data-type="text"
                        data-color="#bf0a30"
                        data-rsp_ch="on"
                        data-xy="x:c;xo:0,0,0,-1px;y:m;yo:-52px,-47px,-55px,-87px;"
                        data-text="w:normal,nowrap,nowrap,nowrap;s:23,20,20,15;l:21,25,20,20;ls:1px,0px,0px,0px;fw:700;a:center,center,left,left;"
                        data-dim="w:612px,424px,auto,auto;"
                        data-padding="b:10;"
                        data-frame_0="sX:2;sY:2;"
                        data-frame_0_mask="u:t;"
                        data-frame_1="e:power2.out;st:640;sp:1000;sR:640;"
                        data-frame_1_mask="u:t;"
                        data-frame_999="x:left;e:power3.in;st:w;sp:1000;sR:7360;"
                        data-frame_999_reverse="x:true;"
                        style="z-index:11;font-family:'Poppins';"
                    >
                    </rs-layer><!--

                    --><rs-layer
                        id="slider-2-slide-7-layer-14"
                        data-type="text"
                        data-rsp_ch="on"
                        data-xy="x:c;xo:0,0,0,7px;y:m,t,t,t;yo:91px,312px,271px,212px;"
                        data-text="w:normal;s:18,18,16,15;l:31,30,30,27;a:center;"
                        data-dim="w:806px,805px,689px,388px;h:auto,auto,auto,89px;"
                        data-frame_0="y:100%;"
                        data-frame_0_mask="u:t;"
                        data-frame_1="st:2680;sp:1360;sR:2680;"
                        data-frame_1_mask="u:t;"
                        data-frame_999="o:0;st:w;sR:4960;"
                        style="z-index:9;font-family:'Open Sans';"
                    >Revolutionizing Nigeria's transportation.
                    </rs-layer><!--

                    --><a
                        id="slider-2-slide-7-layer-19"
                        class="rs-layer rev-btn"
                        href="#" target="_self"
                        data-type="button"
                        data-rsp_ch="on"
                        data-xy="x:c;xo:0,0,0,5px;yo:526px,404px,361px,317px;"
                        data-text="w:normal;s:18,14,14,12;l:50,41,36,32;fw:700;"
                        data-dim="minh:0px,none,none,none;"
                        data-padding="t:0,0,10,10;r:40,40,25,25;b:0,0,10,10;l:40,40,25,25;"
                        data-border="bor:6px,6px,6px,6px;"
                        data-frame_0="y:100%;"
                        data-frame_1="e:power4.inOut;st:3530;sp:1200;"
                        data-frame_999="o:0;st:w;sR:3720;"
                        data-frame_hover="bgc:#000;bor:6px,6px,6px,6px;sp:100;e:power1.inOut;bri:120%;"
                        style="z-index:12;background-color:#bf0a30;font-family:'Poppins';"
                    >Learn More
                    </a><!--
-->						</rs-slide>
                <rs-slide style="position: absolute;" data-key="rs-8" data-title="Web Show" data-thumb="<?php echo e(asset('/guest/rs-plugin/assets/z2-slider-3-100x100.jpg')); ?>" data-anim="adpr:false;f:random;" data-in="o:0;r:ran(-45|45);sx:0;sy:0;row:5;col:5;" data-out="a:false;">
                    <img src="<?php echo e(asset('guest/rs-plugin/assets/dummy.png')); ?>" alt="Non Profit Wordpress Theme - Slider" title="z2-slider-3" width="1920" height="1080" class="rev-slidebg tp-rs-img rs-lazyload" data-lazyload="<?php echo e(asset('/guest/rs-plugin/assets/z2-slider-3.jpg')); ?>" data-parallax="5" data-no-retina>
<!--
                    --><h1
                        id="slider-2-slide-8-layer-2"
                        class="rs-layer Concept-Title"
                        data-type="text"
                        data-color="#ffffff||rgba(255, 255, 255, 1)||rgba(255, 255, 255, 1)||rgba(255, 255, 255, 1)"
                        data-rsp_ch="on"
                        data-xy="x:c;y:m;yo:7px,0,-10px,-56px;"
                        data-text="w:normal,nowrap,nowrap,normal;s:45,50,45,28;l:82,55,50,30;fw:800,700,700,700;a:center;"
                        data-dim="w:1098px,845px,736px,478px;h:92px,auto,auto,35px;"
                        data-padding="b:10;"
                        data-frame_0="o:1;"
                        data-frame_0_chars="d:5;x:105%;o:1;rY:45deg;rZ:90deg;"
                        data-frame_0_mask="u:t;"
                        data-frame_1="st:2110;sp:1200;sR:2110;"
                        data-frame_1_chars="e:power4.inOut;d:10;rZ:0deg;"
                        data-frame_1_mask="u:t;"
                        data-frame_999="x:left;e:power3.in;st:w;sp:1000;sR:3890;"
                        data-frame_999_reverse="x:true;"
                        style="z-index:10;font-family:'Open Sans';"
                    >Nigeria Institute of Transport Technology
                    </h1><!--

                    --><rs-layer
                        id="slider-2-slide-8-layer-4"
                        class="Concept-SubTitle"
                        data-type="text"
                        data-color="#bf0a30"
                        data-rsp_ch="on"
                        data-xy="x:c;xo:0,0,0,-1px;y:m;yo:-52px,-47px,-55px,-89px;"
                        data-text="w:normal,nowrap,nowrap,nowrap;s:23,20,20,15;l:21,25,20,20;ls:1px,0px,0px,0px;fw:700;a:center,center,left,left;"
                        data-dim="w:612px,424px,auto,auto;"
                        data-padding="b:10;"
                        data-frame_0="sX:2;sY:2;"
                        data-frame_0_mask="u:t;"
                        data-frame_1="e:power2.out;st:640;sp:1000;sR:640;"
                        data-frame_1_mask="u:t;"
                        data-frame_999="x:left;e:power3.in;st:w;sp:1000;sR:7360;"
                        data-frame_999_reverse="x:true;"
                        style="z-index:11;font-family:'Poppins';"
                    >
                    </rs-layer><!--

                    --><rs-layer
                        id="slider-2-slide-8-layer-14"
                        data-type="text"
                        data-rsp_ch="on"
                        data-xy="x:c;xo:0,0,0,7px;y:m,t,t,t;yo:91px,312px,271px,210px;"
                        data-text="w:normal;s:18,18,16,15;l:31,30,30,27;a:center;"
                        data-dim="w:806px,805px,689px,388px;h:auto,auto,auto,89px;"
                        data-frame_0="y:100%;"
                        data-frame_0_mask="u:t;"
                        data-frame_1="st:2680;sp:1360;sR:2680;"
                        data-frame_1_mask="u:t;"
                        data-frame_999="o:0;st:w;sR:4960;"
                        style="z-index:9;font-family:'Open Sans';"
                    >...Revolutionizing Nigeria's transportation
                    </rs-layer><!--

                    --><a
                        id="slider-2-slide-8-layer-19"
                        class="rs-layer rev-btn"
                        href="<?php echo e(route('register')); ?>" target="_self"
                        data-type="button"
                        data-rsp_ch="on"
                        data-xy="x:c;xo:0,0,0,5px;yo:526px,404px,361px,315px;"
                        data-text="w:normal;s:18,14,14,12;l:50,41,36,32;fw:700;"
                        data-dim="minh:0px,none,none,none;"
                        data-padding="t:0,0,10,10;r:40,40,25,25;b:0,0,10,10;l:40,40,25,25;"
                        data-border="bor:6px,6px,6px,6px;"
                        data-frame_0="y:100%;"
                        data-frame_1="e:power4.inOut;st:3490;sp:1200;"
                        data-frame_999="o:0;st:w;sR:3760;"
                        data-frame_hover="bgc:#000;bor:6px,6px,6px,6px;sp:100;e:power1.inOut;bri:120%;"
                        style="z-index:12;background-color:#bf0a30;font-family:'Poppins';"
                    >Sign up
                    </a><!--
-->						</rs-slide>
            </rs-slides>
            <rs-static-layers><!--
            --></rs-static-layers>
        </rs-module>
        <script>

        </script>
<script>
if(typeof revslider_showDoubleJqueryError === "undefined") {function revslider_showDoubleJqueryError(sliderID) {console.log("You have some jquery.js library include that comes after the Slider Revolution files js inclusion.");console.log("To fix this, you can:");console.log("1. Set 'Module General Options' -> 'Advanced' -> 'jQuery & OutPut Filters' -> 'Put JS to Body' to on");console.log("2. Find the double jQuery.js inclusion and remove it");return "Double Included jQuery Library";}}
</script>
    </rs-module-wrap>
    <!-- END REVOLUTION SLIDER -->
    <!-- Page Content -->
    <div class="content-wrapper pad-none">
        <div class="content-inner">

            <!-- About Section -->
            <section id="section-about" class="section-about pad-top-none pad-bottom-none pb-5 pb-lg-0 pad-bottom-md-none">
                <div class="container">
                    <!-- Row -->
                    <div class="row d-flex align-items-center">
                        <!-- Col -->
                        <div class="col-lg-6">
                            <!-- about wrap -->
                            <div class="about-wrap relative">
                                <div class="about-wrap-inner">
                                    <!-- about details -->
                                    <div class="about-wrap-details">
                                        <!-- about button -->
                                        <div class="text-center">
                                            <div class="about-img mb-4 mb-md-0">
                                                <img src="<?php echo e(asset('guest/images/about-us/about-us-img.png')); ?>" width="60%" class="" alt="about-img">
                                            </div>
                                            <!-- .col -->
                                        </div>
                                    </div>
                                    <!-- about details End-->
                                </div>
                            </div>
                            <!-- about wrap end -->
                        </div>
                        <!-- .col -->
                        <!-- Col -->
                        <div class="col-lg-6 ps-lg-0">
                            <div class="title-wrap margin-bottom-50">
                                <div class="section-title">
                                    <span class="sub-title theme-color text-uppercase">About</span>
                                    <h2 class="section-title margin-top-5">Castle Education Consult</h2>
                                    <span class="border-bottom"></span>
                                </div>
                                <div class="pad-top-15">
                                    <p class="margin-bottom-20">Castle Education Consult is dedicated to reorienting individuals across various fields to foster progressive and productive learning outcomes in Africa. </p>
                                    <p class="margin-bottom-20">We are committed to identifying and addressing educational challenges while building capacities for future leaders through innovation and creativity. Our goal is to ensure that education encompasses all knowledge, skills, and experiences that contribute to a better life and society, regardless of the learning format.</p>
                                </div>
                            </div>

                        </div>
                        <!-- Col -->
                    </div>
                    <!-- Row -->
                </div>
                <!-- Container -->
            </section>
            <!-- About Section End -->
            <!-- Day Counter Section -->
            
            

        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015)): ?>
<?php $component = $__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015; ?>
<?php unset($__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015); ?>
<?php endif; ?>
<?php /**PATH C:\xampp-server\htdocs\nittpaperless\resources\views/livewire/guest/contract-advert.blade.php ENDPATH**/ ?>