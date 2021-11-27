<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inventory') }}
        </h2>
    </x-slot>

    <div class="mt-2">

       @include('inventory.inventory_search_form')

    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-2">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="container mx-auto px-4">
                <div class="grid grid-columns-5">
                    <div class="bg-orange-500">1</div>
                    <div>2</div>
                    <div>3</div>
                    <div>4</div>
                </div>
              </div>
        </div>
    </div>


</x-app-layout>

<x-app-layout>
    <div>
        @if(isset($vehicles))
            {{ $vehicles->count() }}
        @else
            NO HAY VEHICULOS
        @endif
    </div>
</x-app-layout>

<script>
    $(document).ready(function () {
        $('.drop-multiple').select2();
    });
</script>
