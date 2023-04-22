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
                <!-- <input type="email" name="email" placeholder="Email"/> -->
                <x-ui.u-input type="email" name="email"/>
            </div>
            <div class="flex flex-col gap-y-2">
                <p class="text-primary text-lg font-medium">Пароль:</p>
                <!-- <input type="password" name="password" placeholder="Пароль"/> -->
                <x-ui.u-input type="password" name="password"/>
            </div>
            <!-- <button type="submit">Войти</button> -->
            <x-ui.u-button type="submit">Войти</x-ui.u-button>
        </form>
    </div>
</div>
{{--    <h2>Регистрация</h2>--}}
{{--    <form action="{{ route('auth.register') }}" method="POST">--}}
{{--        @csrf--}}
{{--        <input type="text" name="name" placeholder="Имя пользователя"/>--}}
{{--        <input type="email" name="email" placeholder="Email"/>--}}
{{--        <input type="password" name="password" placeholder="Пароль"/>--}}
{{--        <button type="submit">Регистрация</button>--}}
{{--    </form>--}}
@endsection

{{--@push('styles')--}}
{{--    @vite('resources/css/background.css')--}}
{{--@endpush--}}
