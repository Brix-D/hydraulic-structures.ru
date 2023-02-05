<header class="header bg-demi p-6">
    <x-ui.u-button link :href="route('welcome')">
        <span class="material-icons-outlined">home</span>
    </x-ui.u-button>
</header>

@push('styles')
    @vite('resources/css/components/header.css')
@endpush
