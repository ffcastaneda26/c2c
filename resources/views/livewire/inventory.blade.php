<div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="container mt-5">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8 mt-5">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h4>Laravel Livewire Select2 Multiple Example - NiceSnippets.com</h4>
                    </div>
                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        <div wire:ignore>
                            <select id="make-dropdown" class="form-control" multiple>
                                @foreach($makes as $make_list)
                                    <option value="{{$make_list->make}}">{{ $make_list->make . '(' .  $make_list->total .')' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--
    <table class="table-fixed w-auto">
        <thead>
            <tr class="bg-gray-100">
            <th class="px-2">{{__("Make")}}</th>
            <th class="px-2">{{__("Avaialable")}}</th>
            </tr>
        </thead>

        @forelse ($makes as $make)
            <tr>
                <td class="border px-2 py-1 text-left leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ $make->make }}</td>
                <td class="border px-4 py-1 text-right leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">{{ number_format($make->total, 0, '.', ',') }}</td>
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
    @endif --}}
</div>
@push('scripts')
    <script>
        $(document).ready(function () {
            $('#make-dropdown').select2();
            $('#make-dropdown').on('change', function (e) {
                let data = $(this).val();
                 @this.set('make', data);
            });
            window.livewire.on('productStore', () => {
                $('#make-dropdown').select2();
            });
        });
    </script>
@endpush
