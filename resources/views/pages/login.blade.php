@extends('layouts.app')

@section('page-title', 'Войти')

@section('content')
<div class="flex flex-col justify-center items-center h-full">
    <h2 class="text-primary text-3xl font-bold mb-6">Войти</h2>
    <div class="bg-demi p-8 rounded-lg shadow-lg">
        <form action="{{ route('auth.login') }}" method="POST" class="flex flex-col gap-y-6 w-80">
            @csrf
            <div class="flex flex-col gap-y-2">
                <p class="text-primary text-lg font-medium">Электронная почта:</p>
                <x-ui.u-input type="email" name="email"/>
                @error('email')
                    <div class="ml-4 text-error">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex flex-col gap-y-2">
                <p class="text-primary text-lg font-medium">Пароль:</p>
                <x-ui.u-input type="password" name="password"/>
                @error('password')
                    <div class="ml-4 text-error">{{ $message }}</div>
                @enderror
            </div>
            <x-ui.u-button type="submit">Войти</x-ui.u-button>
        </form>
    </div>
</div>
@endsection

{{--@push('styles')--}}
{{--    @vite('resources/css/background.css')--}}
{{--@endpush--}}
