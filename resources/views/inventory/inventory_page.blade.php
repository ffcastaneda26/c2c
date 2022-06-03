@include('inventory.inventory_head')
    <body class="archive tax-inventory term-texas-inventory term-4 translatepress-en_US material wpb-js-composer js-comp-ver-6.6.0 vc_responsive" data-footer-reveal="false" data-footer-reveal-shadow="none" data-header-format="default" data-body-border="off" data-boxed-style="" data-header-breakpoint="1000" data-dropdown-style="minimal" data-cae="easeOutCubic" data-cad="750" data-megamenu-width="contained" data-aie="none" data-ls="fancybox" data-apte="standard" data-hhun="0" data-fancy-form-rcs="default" data-form-style="default" data-form-submit="regular" data-is="minimal" data-button-style="slightly_rounded_shadow" data-user-account-button="false" data-flex-cols="true" data-col-gap="default" data-header-inherit-rc="false" data-header-search="true" data-animated-anchors="true" data-ajax-transitions="false" data-full-width-header="true" data-slide-out-widget-area="true" data-slide-out-widget-area-style="slide-out-from-right" data-user-set-ocm="off" data-loading-animation="none" data-bg-header="false" data-responsive="1" data-ext-responsive="true" data-ext-padding="90" data-header-resize="1" data-header-color="custom" data-transparent-header="false" data-cart="false" data-remove-m-parallax="" data-remove-m-video-bgs="" data-m-animate="0" data-force-header-trans-color="light" data-smooth-scrolling="0" data-permanent-transparent="false" >
        @include('inventory.inventory_scripts_menu_top')
        <div class="bg-white flex">
            <a href="https://ctcautogroup.com">
                <img class="stnd skip-lazy mb-2 h-16 w-20 sm:h-8 sm:w-16 2xl:h-32 2xl:w-56 ml-2"  alt="CTC Auto Group" src="https://149646797.v2.pressablecdn.com/wp-content/uploads/2021/05/brand-logo.png"/>
            </a>
            <div class="mt-4">
                <a style="background-color:#edc628; margin-top:1%"  href="https://ctcautogroup.com/approval-new/"
                    class="block right-10 absolute top-4 text-black 2xl:px-4 2xl:py-2  sm:px-2 sm:mt-2 font-bold rounded-lg hover:text-white">
                    <span class="menu-title-text">{{__('GET APPROVED')}}</span>
                </a>
            </div>
        </div>

        <div class="ocm-effect-wrap mt-4">
            <div class="ocm-effect-wrap-inner">
                <div id="ajax-content-wrap">
                    <h1 class="cl-page-title"><span>{{ __($title_dealer) }}</span></h1>
                    <div class="vehicle-content paddlb40 container">
                        <div class="custom-inventory-wrap">
                            <div class="custom-sidebar">
                                <div class="filters">
                                    @include('inventory.real_search_form')
                                    <br><br>
                                    <iframe src="https://ctcautogroup.neoverify.com/quick_lead" width="100%" height="700" style="border:none;"></iframe>
                                </div>
                            </div>
                            <div class="custom-vehicle-details">
                                @if ($errors->any())
                                    <div class="alert alert-danger bg-red-500">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li class="text-lg text-black">{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if($vehicles->count())
                                    @include('inventory.real_list_vehicles')
                                @else
                                <h1 class="cl-page-title"><span>{{ __('No Records Found') }}</span></h1>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Content -->
        <main>
            @if (isset($slot))
                {{ $slot }}
            @endif
        </main>
        @stack('modals')

        @livewireScripts
        @stack('scripts')
    </body>
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
    <style>
        .swiper {
            width: 200px;
            height: 120px;
        }
        .swiper-slide {
            text-align: center;
            font-size: 15px;
            background: #fff;
            /* Center slide text vertically */
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
        }
        .swiper-slide img {
            display: block;
            width: 90%;
            height: 90%;
            object-fit: cover;
        }
    </style>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></scrip>
    <script src="https://api.dealermade-next.com/v4/system-services/dm-next-hd-viewer-loader" async=""></script>

    <!-- Initialize Swiper -->
    <script>
    var swiper = new Swiper(".mySwiper", {
        centeredSlides: true,
        slidesPerView: 'auto',
        longSwipesMs: 0,
        loopPreventsSlide:false,
        longSwipes: true,
        longSwipesRatio: 0,
        threshold: 0,
        slideToClickedSlide:true,
        speed: 900,
        loop: true,
        loopedSlides:2,
        spaceBetween: 20,
        keyboard: {
            enabled: true,
            onlyInViewport: true,
        },
        grabCursor: true,
        pagination: {
            el: '.swiper-pagination',
            type: 'fraction',
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
    </script>
</html>