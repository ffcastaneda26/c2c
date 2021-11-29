
<style>
.cards {
    margin: 0 auto;
    max-width: 1000px;
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(225px, 1fr));
    grid-auto-rows: auto;
    gap: 20px;
    font-family: sans-serif;
    padding-top: 30px;
}

.cards * {
    box-sizing: border-box;
}

.card__image {
    width: 100%;
    height: 150px;
    object-fit: cover;
    display: block;
    border-top: 2px solid #333333;
    border-right: 2px solid #333333;
    border-left: 2px solid #333333;
}

.card__content {
    line-height: 1.5;
    font-size: 0.9em;
    padding: 15px;
    background: #fafafa;
    border-right: 2px solid #333333;
    border-left: 2px solid #333333;
}

.card__content > p:first-of-type {
    margin-top: 0;
}

.card__content > p:last-of-type {
    margin-bottom: 0;
}

.card__info {
    padding: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #555555;
    background: #eeeeee;
    font-size: 0.8em;
    border-bottom: 2px solid #333333;
    border-right: 2px solid #333333;
    border-left: 2px solid #333333;
}

.card__info i {
    font-size: 0.9em;
    margin-right: 8px;
}

.card__link {
    color: #64968c;
    text-decoration: none;
}

.card__link:hover {
    text-decoration: underline;
}

</style>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<div class="cards">
    @foreach ($vehicles as $vehicle)
    <div class="card">

            @if(explode(",", $vehicle->images)[0])
                <div class="box_to_image">
                    <img class="card__image" src="{{explode(",", $vehicle->images)[0] }}" alt="{{ __('Not Image') }}">
                </div>
            @else
                <img class="card__image" src="{{ asset('css/images/default.jpeg') }}" alt="">
            @endif

            <div class="card__content">
                @if($vehicle->year || $vehicle->make || $vehicle->model )
                    <h3>{{  $vehicle->year }} {{ $vehicle->make  }} {{  $vehicle->model   }}</h3>
                @else
                    <h3>{{ __('No data available') }}</h3>
                @endif

                @if($vehicle->mileage)
                    <p>{{ number_format($vehicle->mileage, 0, '.', ',') }} {{ __('MILES') }}</p>
                @else
                    <p>{{__('No data available') }} {{ __('MILES') }}</p>

                @endif
            </div>
            <div class="card__info">
                <a  class="own_a_tag btn" href="https://ctcautogroup.com/cars/2016-ford-expedition-1692/">{{ __('Call for Info') }}</a>
            </div>
        </div>
    @endforeach
    <div>
        {{ $vehicles->links() }}
    </div>
</div>
