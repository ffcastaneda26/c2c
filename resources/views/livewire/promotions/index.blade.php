<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{__('Manage Promotions')}}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            <button wire:click="create()"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">
                {{__('Create Promotion')}}
            </button>
            <input type="text"
                    wire:model="search"
                    placeholder="{{__('Name')}}"
                    class="w-200 shadow appearance-none border rounded  py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            >
            @if($isOpen)
                @include('livewire.promotions.form')
            @endif

            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2"> {{__('Name')}}</th>
                        <th class="px-4 py-2"> {{__('Description')}}</th>
                        <th class="px-4 py-2"> {{__('Image')}}</th>
                        <th class="px-4 py-2"> {{__('Language')}}</th>
                        <th colspan="2" class="px-4 py-2 text-center">{{__('Actions')}}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($records as $record)
                    <tr>
                        <td class="border px-4 py-2 W-20">{{ $record->name }}</td>
                        <td class="border px-4 py-2 w-52">{{ $record->description }}</td>
                        <td class="border px-2 py-1 w-20">
                            <img class="h-12 w-12 rounded-full object-cover" src="{{Storage::url($record->image)}}" alt="logo" />
                        </td>
                        <td class="border px-4 py-2 w-20">
                            @if ( $record->language == "en")
                                {{__('English')}}
                            @else
                                {{__('Spanish')}}
                            @endif
                        </td>

                        <td colspan="2" class="border px-4 py-2 text-center">
                            <button wire:click="edit({{ $record->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{__('Edit')}}
                            </button>
                            <button wire:click="delete({{ $record->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                {{__('Delete')}}
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $records->links() }}
        </div>
    </div>
</div>
