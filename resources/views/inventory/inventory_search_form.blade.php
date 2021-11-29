<form action="{{ route('inventory') }}" method="GET">
    @csrf

<!-- Marca -->
        <div class="p-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <label>{{ __('Make') }}</label>
            <div>
                <select id="make-dropdown" class="drop-multiple" multiple name="make[]">
                    @foreach($makesList as $make)
                        <option value="{{$make}}" @if(in_array($make,$search_make)) selected @endif>{{ $make }}</option>
                    @endforeach
                </select>
        </div>



<!-- Tipo o estructura -->
        <div class="p-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <label>{{ __('Body') }}</label>
            <div>
                <select id="body-dropdown" class="drop-multiple" multiple name="body[]">
                    @foreach($bodiesList as $body)
                        <option value="{{$body}}" @if(in_array($body,$search_body)) selected @endif>{{ $body }}</option>
                    @endforeach
                </select>
            </div>
        </div>

<!--Año -->
        <div class="p-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <label>{{ __('Year') }}</label>
            <div>
                <select id="year-dropdown" class="drop-multiple" multiple name="year[]">
                    @foreach($yearsList as $year)
                        {{-- <option value="{{$year}}">{{ $year }}</option> --}}
                        <option value="{{$year}}" @if(in_array($year,$search_year)) selected @endif>{{ $year }}</option>
                    @endforeach
                </select>
            </div>
        </div>

<!-- Millas -->
        <div class="p-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <label>{{ __('Mileage') }}</label>
            <div class="box_filter">
                    <div class="ml-10">
                        <label>{{ __('From') }}</label>
                        <select name="mileage_from">
                            <option value="">All</option>
                            @for ($mileage =10000 ; $mileage <=180000 ; $mileage=$mileage+10000)
                                <option value="{{ $mileage }}">{{ number_format($mileage, 0, '.', ',') }}</option>
                            @endfor
                        </select>

                    </div>
                    <div class="ml-10">
                        <label>{{ __('To') }}</label>
                        <select name="mileage_to">
                            <option value="">All</option>
                            @for ($mileage =20000 ; $mileage <=200000 ; $mileage=$mileage+10000)
                                <option value="{{ $mileage }}">{{ number_format($mileage, 0, '.', ',') }}</option>
                            @endfor
                        </select>

                    </div>
            </div>
        </div>
        <div class="shadow mt-2 w-4/5 appearance-none border  py-1 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <x-jet-button class="ml-4">
                {{ __('Query') }}
            </x-jet-button>
        </div>

    </div>
</form>
