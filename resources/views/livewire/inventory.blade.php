<div class="swiper-slide">
    @foreach ($vehicle_show as $vehicle )
        @foreach ( explode(",", $vehicle->images) as $image_url)
            @if($loop->iteration > 1) @break @endif
                @if($image_url)
                    <img src="{{ $image_url }}"/>
                @endif
        @endforeach
    @endforeach
</div>