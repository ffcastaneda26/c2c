 <div class="body_container">

    <div class="container">
        <div class="row">
            @foreach ($vehicles as $vehicle)
                <div class="card">
                    @if(explode(",", $vehicle->images)[0])
                        <div class="box_to_image">
                            <img src="{{explode(",", $vehicle->images)[0] }}" alt="{{ __('Not Image') }}">
                        </div>
                    @else
                        <img src="{{ asset('css/images/default.jpeg') }}" alt="">
                    @endif


                    @if($vehicle->year || $vehicle->make || $vehicle->model )
                        <h3>{{  $vehicle->year }} {{ $vehicle->make  }} {{  $vehicle->model   }}</h3>
                    @else
                        <h3>{{ __('No data available') }}</h3>
                    @endif

                    @if($vehicle->mileage)
                        <p>{{ number_format($vehicle->mileage, 0, '.', ',') }} {{ __('MILES') }}</p>
                    @else
                        <p>{{__('No data available') }} {{ __('MILES') }}</p>

                    @endif
                    <a  class="own_a_tag btn" href="https://ctcautogroup.com/cars/2016-ford-expedition-1692/">{{ __('Call for Info') }}</a>
                </div>
            @endforeach
            <div class="text-center">
                {{ $vehicles->links() }}
            </div>
        </div>
    </div>
</div>
