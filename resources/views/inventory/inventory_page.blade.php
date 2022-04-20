@include('inventory.inventory_head')
    <body class="archive tax-inventory term-texas-inventory term-4 translatepress-en_US material wpb-js-composer js-comp-ver-6.6.0 vc_responsive" data-footer-reveal="false" data-footer-reveal-shadow="none" data-header-format="default" data-body-border="off" data-boxed-style="" data-header-breakpoint="1000" data-dropdown-style="minimal" data-cae="easeOutCubic" data-cad="750" data-megamenu-width="contained" data-aie="none" data-ls="fancybox" data-apte="standard" data-hhun="0" data-fancy-form-rcs="default" data-form-style="default" data-form-submit="regular" data-is="minimal" data-button-style="slightly_rounded_shadow" data-user-account-button="false" data-flex-cols="true" data-col-gap="default" data-header-inherit-rc="false" data-header-search="true" data-animated-anchors="true" data-ajax-transitions="false" data-full-width-header="true" data-slide-out-widget-area="true" data-slide-out-widget-area-style="slide-out-from-right" data-user-set-ocm="off" data-loading-animation="none" data-bg-header="false" data-responsive="1" data-ext-responsive="true" data-ext-padding="90" data-header-resize="1" data-header-color="custom" data-transparent-header="false" data-cart="false" data-remove-m-parallax="" data-remove-m-video-bgs="" data-m-animate="0" data-force-header-trans-color="light" data-smooth-scrolling="0" data-permanent-transparent="false" >
        @include('inventory.inventory_scripts_menu_top')
        <div class="bg-white flex">
            <img class="stnd skip-lazy mb-2 h-16 w-20 sm:h-8 sm:w-16 2xl:h-32 2xl:w-56 ml-2"  alt="CTC Auto Group" src="https://149646797.v2.pressablecdn.com/wp-content/uploads/2021/05/brand-logo.png"/>
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
                        <div class="custom-sidebar">
                            <div class="filters">
                                @include('inventory.real_search_form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
</html>
