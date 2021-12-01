<div class="vehicle-listings">
    @foreach ($vehicles as $vehicle )
        <div class="vehicle">
            <div class="listing-thumbnail">

                <a href="{{ url('inventory/show/' . $vehicle->id) }}">
                    @if(explode(",", $vehicle->images)[0])
                        <img src="{{explode(",", $vehicle->images)[0] }}" alt="{{ __('Not Image') }}">

                    @else
                        <img src="{{ asset('images/default.jpeg') }}" alt="">
                    @endif

                </a>

            </div>

            <div class="listing-details">
                <a class="vehicle-name" href="https://ctcautogroup.com/cars/2016-ford-expedition-1692/">
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
                    <div class="vehicle-stocks">STOCK #PF29747</div>
                    <a href="https://ctcautogroup.com/cars/2016-ford-expedition-1692/" class="price">Call for Info</a>
                </div>
            </div>
        </div>

    @endforeach
</div>
<!-- Paginacion -->
<div class="pagination">
    {{ $vehicles->links('vendor.pagination.tailwind') }}
</div>
