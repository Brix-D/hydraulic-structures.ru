@props([
    'type' => 'text',
    'name' => '',
    'value' => '',
    ])
<input type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" class="px-4 py-2 border-solid border-primary border bg-white text-primary rounded-lg outline-none" id="datepicker"/>


@push('scripts')
    @vite('resources/js/datepicker.js')
@endpush