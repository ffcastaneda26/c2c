<div>
    <div class="slideshow-container" id="slide_image">
        @foreach ($vehicles as $vehicle )
            @if($vehicle->images)
                @foreach ( explode(",", $vehicle->images) as $image_url)
                    @if( $loop->first or $loop->iteration  <= 3 )
                        <div class="mySlides fade">
                            <img src="{{ $image_url }}"/>
                            <div class="text">{{$loop->iteration}}</div>
                        </div>
                    @endif
                @endforeach
            @endif
        @endforeach
        <a class="prev">&#10094;</a>
        <a class="next">&#10095;</a>
    </div>
</div>