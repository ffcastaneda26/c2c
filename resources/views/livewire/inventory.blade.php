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
    @foreach ($vehicles as $vehicle )
        @if($vehicle->images)
            @foreach ( explode(",", $vehicle->images) as $image_url)
                @if( $loop->iteration > 3 ) @break @endif
                <div class="swiper-slide2">
                    <img src="{{ $image_url }}"/>
                    <label class="font-bold">{{$loop->iteration}}</label>
                </div>
            @endforeach
        @endif
    @endforeach
</div>