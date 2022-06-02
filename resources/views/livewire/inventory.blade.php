<div class="swiper mySwiper">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            @foreach ($vehicle_show as $vehicle )
                @if($vehicle->images)
                    @foreach ( explode(",", $vehicle->images) as $image_url)
                        @if ( $loop->iteration == 1 )
                        <div class="swiper-slide">
                            <img src="{{ $image_url }}" alt="Foto"/>
                        </div>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>
        <div class="swiper-slide">
            @foreach ($vehicle_show as $vehicle )
                @if($vehicle->images)
                    @foreach ( explode(",", $vehicle->images) as $image_url)
                        @if ( $loop->iteration == 2 )
                        <div class="swiper-slide">
                            <img src="{{ $image_url }}" alt="Foto"/>
                        </div>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>
        <div class="swiper-slide">
            @foreach ($vehicle_show as $vehicle )
                @if($vehicle->images)
                    @foreach ( explode(",", $vehicle->images) as $image_url)
                        @if ( $loop->iteration == 3 )
                    
                            <img src="{{ $image_url }}" alt="Foto"/>
                    
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>