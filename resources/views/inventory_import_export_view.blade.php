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
            @if(Session::has('message'))
                <p>{{ Session::get('message') }}</p>
            @endif
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('inventory_import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" required class="form-control">
                    <br>


                    <div class="flex items-center justify-left mt-4">
                        <x-jet-button class="ml-4">
                            {{ __('Import Inventory') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
