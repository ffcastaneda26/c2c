<div class="vehicle-listings">
    @foreach ($vehicles as $vehicle )
        <script src="//dealermade.com/assets/media-layer/v2/dm.js"
        data-dm-dealership-id="coast-to-coast-motors"
        data-dm-insert-before-element-attribute="class"
        data-dm-insert-before-element-attribute-value="vehicle-details"
        data-dm-vehicle-vin="{{ $vehicle->vin }}">
        </script>
        <div class="vehicle-details"></div>
        <div class="vehicle">
            <div class="gallery-block" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 1; display: block; transition: opacity 0.5s ease 0s; z-index: 2;">
                <a href="{{url('inventory/show/'. App::currentLocale() . '/' . $vehicle->id) }}"
                title="{{__('Slide Images')}}">
                <div class="swiper-container">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @foreach ( explode(",", $vehicle->images) as $image_url)
                                @if($loop->iteration > env('APP_QTY_VEHICLES_SLIDER',3)) @break @endif
                                @if($image_url)
                                    <div class="swiper-slide">
                                        <div class="swiper-zoom-container">
                                            <img src="{{ $image_url }}"/>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                </a>
            <span class="text-black font-mono text-xs">{{__('< Swipe >')}}</span>
            </div>

            <div class="listing-details">
                <a class="vehicle-name" href="{{url('inventory/show/'. App::currentLocale() . '/' . $vehicle->id) }}">
                    @if($vehicle->year || $vehicle->make || $vehicle->model )
                        {{  $vehicle->year }} {{ $vehicle->make  }} {{  $vehicle->model   }}
                    @else
                        {{ __('No data available') }}
                    @endif
                </a>
                <div class="listing-info">
                    <div class="vehicle-miles">
                        @if($vehicle->mileage)
                            {{ number_format($vehicle->mileage, 0, '.', ',') }} {{ __('MILES') }}
                        @else
                            {{ __('No data available') }}
                        @endif
                    </div>
                    <div class="vehicle-stocks">STOCK  {{  $vehicle->stock }}
                    </div>
                    <a href="https://ctcautogroup.com/flashpass/#today" class="price">{{ __("Unlock Price") }}</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
<!-- Paginacion -->
<div class="pagination">
    {{ $vehicles->appends(request()->input())->links('vendor.pagination.tailwind') }}
</div>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="https://api.dealermade-next.com/v4/system-services/dm-next-hd-viewer-loader" async=""></script>
<script>
    const swiper = new Swiper('.swiper', {
  // Optional parameters
  direction: 'horizontal',
  loop: false,


  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },


});
</script>
