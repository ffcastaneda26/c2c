<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <table class="table-fixed w-auto">
                <thead>
                    <tr class="bg-gray-100">
                    <th class="px-2">{{__("Make")}}</th>
                    <th class="px-2">{{__("Model")}}</th>
                    <th class="px-2">{{__("Mileage")}}</th>
                    <th class="px-2">{{__("Retail Price")}}</th>

                    </tr>
                </thead>
                @forelse ($inventario_general as $inventario)
                    <tr>
                        <td class="border px-2 py-1 text-left leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $inventario->make }}</td>
                        <td class="border px-2 py-1 text-left leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $inventario->model }}</td>
                        <td class="border px-2 py-1 text-left leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $inventario->mileage }}</td>
                        <td class="border px-4 py-1 text-right leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ number_format($inventario->retail_price, 0, '.', ',') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td>
                            <label class="mx-auto text-2xl text-white text-bold  justify-center h-50  w-50  rounded-full bg-red-600 sm:mx-0 sm:h-10 sm:w-10">
                                {{__('No Records Found')}}
                            </label>
                        </td>
                    </tr>
                @endforelse

            </table>
            @if(isset($marks) && $marks)
                <div class="flex items-center mt-2">
                    {{ $marks->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
