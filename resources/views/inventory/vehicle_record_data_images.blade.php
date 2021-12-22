<div class="single-heading-wrap">
    <div class="container">
        <h1 class="title">{{ $vehicle->year }} {{ $vehicle->make }} {{ $vehicle->model }}</h1>
        <p class="info">
            @if($vehicle->mileage)
                {{ number_format($vehicle->mileage, 0, '.', ',') }} {{ __('MILES') }}
            @else
                {{ __('Miles data not available') }}
            @endif
            @if($vehicle->stock)
                &nbsp;|&nbsp; STOCK {{ $vehicle->stock }}
            @else
                &nbsp;|&nbsp;  {{ __('Stock Code not available') }}
            @endif
        </p>


        {{-- @if( $vehicle->dealer_id == 'coast2coast')
            <a href="/inventory/texas-inventory">
        @endif

        @if( $vehicle->dealer_id == 'crossroads')
            <a href="/inventory/oklahoma-inventory">
        @endif --}}
        {{-- <a href="<?=$_SERVER["HTTP_REFERER"]?>">
            <button style="background-color:#59B44B;" class="go_back absolute right-20 top-0 flex items-center justify-center shadow-lg  px-4 py-2 text-2xl font-medium leading-5 text-white transition-colors duration-150 border border-transparent rounded-md active:bg-green-500 focus:outline-none focus:shadow-outline-green hover:bg-green-500">
                {{__('Go Back')}}
            </button>
        </a> --}}

    </div>
</div>

<script src="//dealermade.com/assets/media-layer/v2/dm.js"
    data-dm-dealership-id="coast-to-coast-motors"
    data-dm-insert-before-element-attribute="class"
    data-dm-insert-before-element-attribute-value="vehicle-details"
    data-dm-vehicle-vin="{{ $vehicle->vin }}">
</script>
<div class="vehicle-details"></div>

<div class="gallery-block">
    <div class="container">
        <div class="flex-gallery">
            <ul class="slides">
                @if($vehicle->images)
                    @foreach ( explode(",", $vehicle->images) as $image_url)
                        @if(!$loop->first)
                            <li><img src="{{ $image_url }}"/></li>
                        @endif
                    @endforeach
                    @if($promotions->count())
                        @foreach ($promotions as $promotion )
                        @if(App::isLocale('es'))
                            <li><img src="{{ Storage::url($promotion->image) }}"/></li>
                        @else
                            <li><img src="{{ Storage::url($promotion->image_en) }}"/></li>
                        @endif
                        @endforeach
                    @endif
                @endif
            </ul>
        </div>
    </div>
</div>
