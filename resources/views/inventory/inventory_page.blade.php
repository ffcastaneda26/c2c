@include('inventory.inventory_head')
<body class="archive tax-inventory term-texas-inventory term-4 translatepress-en_US material wpb-js-composer js-comp-ver-6.6.0 vc_responsive" data-footer-reveal="false" data-footer-reveal-shadow="none" data-header-format="default" data-body-border="off" data-boxed-style="" data-header-breakpoint="1000" data-dropdown-style="minimal" data-cae="easeOutCubic" data-cad="750" data-megamenu-width="contained" data-aie="none" data-ls="fancybox" data-apte="standard" data-hhun="0" data-fancy-form-rcs="default" data-form-style="default" data-form-submit="regular" data-is="minimal" data-button-style="slightly_rounded_shadow" data-user-account-button="false" data-flex-cols="true" data-col-gap="default" data-header-inherit-rc="false" data-header-search="true" data-animated-anchors="true" data-ajax-transitions="false" data-full-width-header="true" data-slide-out-widget-area="true" data-slide-out-widget-area-style="slide-out-from-right" data-user-set-ocm="off" data-loading-animation="none" data-bg-header="false" data-responsive="1" data-ext-responsive="true" data-ext-padding="90" data-header-resize="1" data-header-color="custom" data-transparent-header="false" data-cart="false" data-remove-m-parallax="" data-remove-m-video-bgs="" data-m-animate="0" data-force-header-trans-color="light" data-smooth-scrolling="0" data-permanent-transparent="false" >

@include('inventory.inventory_scripts_menu_top')
<div class="ocm-effect-wrap">
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
                    @include('inventory.real_list_vehicles')
                </div>
            </div>
        </div>
    </div>
@include('inventory.inventory_footer_tag')

    </body>
</html>
