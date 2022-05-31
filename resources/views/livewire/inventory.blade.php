{{--  <div>
    <div class="gallery-block">
        <div class="container">
            <div class="flex-gallery">
                <ul class="slides">
                    @foreach ($vehicles as $vehicle )
                        @if($vehicle->images)
                            @foreach ( explode(",", $vehicle->images) as $image_url)
                                @if( $loop->iteration > 3 ) @break @endif
                                    <li><img src="{{ $image_url }}"/></li>
                                    <label class="text">{{$loop->iteration}}</label>
                            @endforeach
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>  --}}
<div>
    <div class="swiper2 mySwiper">
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
                                <div class="swiper-slide">
                                    <img src="{{ $image_url }}" alt="Foto"/>
                                </div>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>