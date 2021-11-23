<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" required class="form-control">
                    <br>
                    <button class="btn bg-red-500"> {{ __('Import Users') }}</button>
                    <a class="btn rounded-full bg-green-600" href="{{ route('export') }}"> {{ __('Export Users') }}</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
