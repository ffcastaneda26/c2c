<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Leads Import') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('leads_import_file') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file"
                            name="file"
                            size="100"
                            required class="form-control"
                        >
                    <br>

                    @if($records->count())
                        <div class="flex bg-green-500 text-white flex-auto p-2 mb-2">
                            <p>{{ __('Leads have been Imported') }}</p>
                        </div>
                    @endif

                    <div class="flex items-center justify-left mt-4">
                        @if(isset($records) && !$records->count())
                            <x-jet-button class="ml-4">
                                {{ __('Leads Import') }}
                            </x-jet-button>
                        @endif


                        @if(!$records)
                            <div class="flex bg-red-500  text-white flex-1 text-center">
                                <p>{{ __('There are no leads to export to Neo') }}</p>
                            </div>
                        @endif


                        @if($records->count())
                                <x-jet-button  class="ml-4 inline-flex items-center px-4 py-2 bg-red-200 border border-transparent rounded-md font-semibold text-xs text-black  tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                                    {{ __('Import More Leads') }}
                                </x-jet-button>

                                <a href="{{ route('send_to_neo_pending_records') }}">
                                    <label class="ml-4 inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                                        {{ __('Confirm Send To Neo') }}
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
                                        <th class="px-4 py-2 w-auto">{{__("Campaign Name")}}</th>
                                        <th class="px-4 py-2 w-auto">{{__("First Name")}}</th>
                                        <th class="px-4 py-2 w-auto">{{__("Last Name")}}</th>
                                        <th class="px-4 py-2 w-auto">{{__("Phone")}}</th>
                                        <th class="px-4 py-2 w-auto">{{__("Email")}}</th>
                                        <th class="px-4 py-2 w-auto">{{__("Created At")}}</th>
                                    </tr>
                                </thead>
                                @foreach ($records as $record )
                                    <tr>
                                        <td class="border px-4 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-justify text-gray-600">{{ $record->campaign_name }}</td>
                                        <td class="border text-justify text-gray-600">{{ $record->name }}</td>
                                        <td class="border text-justify text-gray-600">{{ $record->last_name }}</td>
                                        <td class="border text-justify text-gray-600">{{ $record->phone }}</td>
                                        <td class="border text-justify text-gray-600">{{ $record->email }}</td>
                                        <td class="border text-justify text-gray-600">{{ $record->created_at }}</td>

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
