<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="flex flex-wrap justify-evenly items-start gap-3 p-2">
        @foreach ($vehicles as $vehicle)
            <article class="mb-4 bg-gray-100 border border-gray-300 rounded shadow-md">

                    @if(explode(",", $vehicle->images)[0])
                        <img src="{{explode(",", $vehicle->images)[0] }}" alt="{{ __('Not Image') }}" class="object-none object-center p-1 h-36 w-30">
                    @else
                        <img src="{{asset('images/default.jpeg') }}" alt="{{ __('Not Image') }}" class="object-none object-center p-1 h-36 w-30">
                    @endif

                    <div class="flex flex-wrap justify-center items-start gap-3 p-2">
                        <div class="p-3 text-center">
                            <div class="flex wrap">
                                @if($vehicle->year || $vehicle->make || $vehicle->model )
                                    <h3 class="mb-1 text-xl font-bold text-justify">{{  $vehicle->year }} {{ $vehicle->make  }} {{  $vehicle->model   }}</h3>
                                @else
                                    <h3>{{ __('No data available') }}</h3>
                                @endif
                            </div>


                            @if($vehicle->mileage)
                                <p class="mb-4 uppercase" >{{ number_format($vehicle->mileage, 0, '.', ',') }} {{ __('MILES') }}</p>
                            @else
                                <p class="mb-4 uppercase" >{{__('No data available') }} {{ __('MILES') }}</p>

                            @endif

                            @if($vehicle->stock)
                                <p class="mb-4 uppercase"> STOCK #{{ $vehicle->stock }}</p>

                            @endif
                        </div>
                    </div>



                <div class="self-end p-1 mt-1 mb-2">
                    <a class="bg-green-700 text-white px-4 py-2 font-bold text-xs  rounded-xl tracking-wider" href="https://ctcautogroup.com/cars/2016-ford-expedition-1692/">{{ __('Call for Info') }}</a>
                </div>
            </article>
        @endforeach

    </div>
    <div class="text-center">
        {{ $vehicles->links() }}
    </div>
</div>
