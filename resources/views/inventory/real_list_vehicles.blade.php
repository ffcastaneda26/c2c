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
                    onmouseover="getvehicle({{$vehicle->id}})">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img  src="{{explode(",", $vehicle->images)[0] }}">
                            </div>
                            <div class="swiper-slide">
                                <img  src="{{explode(",", $vehicle->images)[1] }}">
                            </div>
                            <div class="swiper-slide">
                                <img  src="{{explode(",", $vehicle->images)[2] }}">
                            </div>
                        </div>
                    </div>
                </a>
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
                    <a href="https://ctcautogroup.com/fastpass/#today" class="price">{{ __("Unlock Price") }}</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
<!-- Paginacion -->
<div class="pagination">
    {{ $vehicles->appends(request()->input())->links('vendor.pagination.tailwind') }}
</div>
<script>
    function getvehicle(vehicle_id) {
        Livewire.emit('mount', vehicle_id)
    }
</script>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="https://api.dealermade-next.com/v4/system-services/dm-next-hd-viewer-loader" async=""></script>