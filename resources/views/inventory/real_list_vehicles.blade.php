
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
                <a href="{{url('inventory/show/'. App::currentLocale() . '/' . $vehicle->id) }}">
                    @if(explode(",", $vehicle->images)[0])
                        <img  src="{{explode(",", $vehicle->images)[0] }}" onerror=this.src="{{ asset('images/default.jpeg') }}">
                    @else
                        <img src="{{ asset('images/default.jpeg') }}" alt="">
                    @endif
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