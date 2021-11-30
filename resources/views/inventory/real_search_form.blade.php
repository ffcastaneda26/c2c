<form class="filters-wrap" action="{{ url('inventory/' . $dealer_id) }}" method="get" id="filterForm">
    <div class="heading">{{ __('Filter your Search') }}</div>
    <div class="filter-group pd15">
        <input class="filter-input" type="text" name="search" placeholder="{{ __('Search Make, Model Or Stock...') }}" value=""/>
    </div>
{{-- Marca --}}
    <div class="filter-group">
        <div class="filter-item" data-target="#makes">
            <span class="filter-title">{{ __('Make') }}</span>
            <span class="icon fa fa-angle-down" aria-hidden="true"></span>
        </div>
        <ul id="makes" class="filter-item-wrap">
            <li class="cl-allfilter">
                <input id="makeAll" class="allChackBtn" type="checkbox" name="make[]" value="">
                <label for="makeAll">{{ __('All Makes') }}/label>
            </li>
            @foreach($makesList as $make)
                <li class="cl-filter">
                    <input id="make0" type="checkbox" name="make[]" value="{{$make}}" @if(in_array($make,$search_make)) checked @endif>
                    <label for="make0">{{$make}}</label>
                </li>
            @endforeach

        </ul>


    </div>

{{-- Tipo --}}
    <div class="filter-group">
        <div class="filter-item" data-target="#bodys">
            <span class="filter-title">{{ __('Body Type') }}</span>
            <span class="icon fa fa-angle-down" aria-hidden="true"></span>
        </div>

        <ul id="bodys" class="filter-item-wrap">
            <li class="cl-allfilter">
                <input id="bodyAll" class="allChackBtn" type="checkbox" name="body[]" value="">
                <label for="bodyAll">{{ __('All Body Types') }}</label>
            </li>
            @foreach($bodiesList as $body)
                <li class="cl-filter">
                    <input type="checkbox" name="body[]" value="{{$body}}" @if(in_array($body,$search_body)) checked @endif >
                    <label>{{$body}}</label>
                </li>
            @endforeach
        </ul>

    </div>

{{-- Año --}}
    <div class="filter-group">
        <div class="filter-item" data-target="#years">
            <span class="filter-title">{{ __('Year') }}</span>
            <span class="icon fa fa-angle-down" aria-hidden="true"></span>
        </div>
        <ul id="years" class="filter-item-wrap">
            <li class="cl-allfilter">
                <input id="yearAll" class="allChackBtn" type="checkbox" name="year[]" value="">
                <label for="yearAll">{{ ('All Years') }}</label>
            </li>
            @foreach($yearsList as $year)
                <li class="cl-filter">
                    <input id="year0" type="checkbox" name="year[]" value="{{ $year }}"  @if(in_array($year,$search_year)) checked @endif>
                    <label for="year0">{{ $year }}</label>
                </li>
            @endforeach
        </ul>

    </div>

{{-- Millas --}}
    <div class="filter-group">
        <div class="filter-item" data-target="#miles">
            <span class="filter-title">{{ __('Mileage') }}</span>
            <span class="icon fa fa-angle-down" aria-hidden="true"></span>
        </div>
        <ul id="miles" class="filter-item-wrap">
            <div class="filter-select-row">
                <div class="selectlabel uppercase">{{ __('From') }}</div>
                <div class="selectWrap">
                    <select class="form-control" name="mileage_from">
                        <option class="uppercase"  value="">{{ __('All') }}</option>
                        @for ($mileage =10000 ; $mileage <=180000 ; $mileage=$mileage+10000)
                            <option value="{{ $mileage }}">{{ number_format($mileage, 0, '.', ',') }}</option>
                        @endfor>
                    </select>
                </div>
            </div>
            <div class="filter-select-row">
                <div class="selectlabel uppercase">{{ __('To') }}</div>
                <div class="selectWrap">
                    <select class="form-control" name="mileage_to">
                        <option class="uppercase"  value="">{{ __('All') }}</option>
                        @for ($mileage =20000 ; $mileage <=200000 ; $mileage=$mileage+10000)
                            <option value="{{ $mileage }}">{{ number_format($mileage, 0, '.', ',') }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </ul>
    </div>
    <div class="hidden">{{ $dealer_id }}</div>
    <button class="btn" type="submit">{{ __('Filter') }}</button>
</form>
