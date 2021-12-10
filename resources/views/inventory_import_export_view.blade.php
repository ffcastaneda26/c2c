<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inventory') }}
        </h2>
    </x-slot>
    {{-- @php
        phpinfo();
    @endphp --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('inventory_import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" required class="form-control">
                    <br>

                    @if($records->count())
                        <div class="flex bg-green-500 text-white flex-auto p-2 mb-2">
                            <p>{{ __('Inventory has been Imported') }}</p>
                        </div>

                    @endif

                    <div class="flex items-center justify-left mt-4">
                        @if(isset($records) && !$records->count())
                            <x-jet-button class="ml-4">
                                {{ __('Import Inventory') }}
                            </x-jet-button>
                        @endif


                        @if(!$records)
                            <div class="flex bg-red-500  text-white flex-1 text-center">
                                <p>{{ __('Inventory was not Imported') }}</p>
                            </div>
                        @endif


                        @if($records->count())

                                <x-jet-button  class="ml-4 inline-flex items-center px-4 py-2 bg-red-200 border border-transparent rounded-md font-semibold text-xs text-black  tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                                    {{ __('Import Inventory') }}
                                </x-jet-button>

                                <a href="{{ url('confirm_update_inventory') }}">
                                    <label class="ml-4 inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                                        {{ __('Confirm Update Inventory') }}
                                    </label>
                                </a>


                        @endif

                    </div>
                </form>
            </div>
        </div>

        @if(isset($records) && $records->count())
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="py-2 bg-white">
                    <div class="mx-auto">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4 m-4">
                            <table class="table-fixed w-auto">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="px-4 py-2 w-auto">{{__("Stock")}}</th>
                                        <th class="px-4 py-2 w-auto">{{__("Dealer")}}</th>
                                        <th class="px-4 py-2 w-auto">{{__("Vin")}}</th>
                                        <th class="px-4 py-2 w-auto">{{__("Year")}}</th>
                                        <th class="px-4 py-2 w-auto">{{__("Make")}}</th>
                                        <th class="px-4 py-2 w-auto">{{__("Model")}}</th>
                                        <th class="px-4 py-2 w-auto">{{__("Mileage")}}</th>
                                        <th class="px-4 py-2 w-auto">{{__("Image")}}</th>
                                    </tr>
                                </thead>
                                @foreach ($records as $record )
                                    <tr>
                                        <td class="border px-4 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-justify text-gray-600">{{ $record->dealer_id }}</td>
                                        <td class="border text-justify text-gray-600">{{ $record->vin }}</td>
                                        <td class="border text-justify text-gray-600">
                                            @if($record->stock)
                                                {{ $record->stock }}
                                            @else
                                                {{ __('Stock Code not available') }}
                                            @endif

                                        </td>

                                        <td class="border text-justify text-gray-600">{{ $record->year }}</td>
                                        <td class="border text-justify text-gray-600">{{ $record->make }}</td>
                                        <td class="border text-justify text-gray-600">{{ $record->model }}</td>

                                        <td class="border text-right text-gray-600">
                                            @if($record->mileage)
                                                {{ number_format($record->mileage, 0, '.', ',') }} {{ __('MILES') }}
                                            @else
                                                {{ __('Miles data not available') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(explode(",", $record->images)[0])
                                                <div class="box_to_image">
                                                    <img  src="{{explode(",", $record->images)[0] }}"
                                                    onerror=this.src="{{ asset('images/default.jpeg') }}"
                                                    width="100px" height="100px">
                                                 </div>
                                            @else
                                                <img src="{{ asset('css/images/default.jpeg') }}" width="100px" height="100px">
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            @if(isset($records) && $records)
                                <div class="flex items-center mt-2">
                                    {{ $records->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
