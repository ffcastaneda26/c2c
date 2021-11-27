<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inventory') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
               @dd($vehicles)
            </div>
        </div>


    </div>

</x-app-layout>

<x-app-layout>
    <div>
        @if($vehicles)
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
