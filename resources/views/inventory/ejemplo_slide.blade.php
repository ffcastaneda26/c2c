<link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
<style>
    .swiper {
        width: 20%;
        height: 20%;
      }
    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;
        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
      }
      .swiper-slide img {
        display: block;
        width: 50%;
        height: 50%;
        object-fit: cover;
      }
    </style>
</style>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="https://api.dealermade-next.com/v4/system-services/dm-next-hd-viewer-loader" async=""></script>

<!-- Initialize Swiper -->
<script>
  var swiper = new Swiper(".mySwiper", {
    spaceBetween: 30,
    centeredSlides: true,
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
</script>

inventory_page

<div class="justify-left items-end mt-20 w-96 h-96">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @livewire('inventories')
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div> 

inventories.blade.php
<div>
    @foreach ($vehicles as $vehicle )
        @if($vehicle->images)
            @foreach ( explode(",", $vehicle->images) as $image_url)
                <div class="swiper-slide">
                    <img src="{{ $image_url }}"/>
                    <label class="font-bold">{{$loop->iteration}}</label>
                </div>
            @endforeach
        @endif
    @endforeach
</div>