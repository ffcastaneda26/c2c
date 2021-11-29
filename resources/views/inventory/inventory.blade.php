<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inventory') }}
        </h2>
    </x-slot>

    <div class = "flex_container">
        <div class = "flex_col_left">
            @include('inventory.inventory_search_form')
        </div>
        <div class = "flex_col_right">
            @include('inventory.inventory_list')
        </div>
    <div>

</x-app-layout>

<script>
    $(document).ready(function () {
        $('.drop-multiple').select2();
    });
</script>
