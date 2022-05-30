<div>
    <div class="slideshow-container" id="slide_image">

            @if($vehicle_show && $vehicle_show->images)
                @foreach ( explode(",", $vehicle_show->images) as $image_url)
                    @if( $loop->first or $loop->iteration  <= 3 )
                        <div class="mySlides fade">
                            <img src="{{ $image_url }}"/>
                            <div class="text">{{$loop->iteration}}</div>
                        </div>
                    @endif
                @endforeach
            @endif

        <a class="prev">&#10094;</a>
        <a class="next">&#10095;</a>
    </div>
</div>
