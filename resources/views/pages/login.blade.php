@extends('layouts.app')

@section('page-title', 'Войти')

@section('content')
    <h2>Войти</h2>
    <form action="{{ route('auth.login') }}" method="POST">
        @csrf
        <input type="email" name="email" placeholder="Email"/>
        <input type="password" name="password" placeholder="Пароль"/>
        <button type="submit">Войти</button>
    </form>

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
