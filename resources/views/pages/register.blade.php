@extends('layouts.app')

@section('page-title', 'Войти')

@section('content')
<div class="flex flex-col justify-center items-center h-full">
    <h2 class="text-primary text-3xl font-bold mb-6">Регистрация сотрудника</h2>
    <div class="bg-demi p-8 rounded-lg shadow-lg">
        <form action="{{ route('auth.register') }}" method="POST" class="flex flex-col gap-y-4 w-80">
            @csrf
            <div class="flex flex-col gap-y-2">
                <p class="text-primary text-lg font-medium">Полное имя:</p>
                <x-ui.u-input type="text" name="name"/>
                @error('name')
                    <div class="ml-4 text-error">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex flex-col gap-y-2">
                <p class="text-primary text-lg font-medium">Электронная почта:</p>
                <x-ui.u-input type="email" name="email"/>
                @error('email')
                    <div class="ml-4 text-error">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex flex-col gap-y-2">
                <p class="text-primary text-lg font-medium">Табельный номер:</p>
                <x-ui.u-input type="text" name="personnel_number"/>
                @error('personnel_number')
                    <div class="ml-4 text-error">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex flex-col gap-y-2">
                <p class="text-primary text-lg font-medium">Должность:</p>
                <x-ui.u-select name="role" :options="$roles"/>
                @error('role')
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
            <div class="flex flex-col gap-y-2">
                <p class="text-primary text-lg font-medium">Повторите пароль:</p>
                <x-ui.u-input type="password" name="repeatPassword"/>
                @error('repeatPassword')
                    <div class="ml-4 text-error">{{ $message }}</div>
                @enderror
            </div>
            <x-ui.u-button type="submit">Регистрация</x-ui.u-button>
        </form>
    </div>
</div>
@endsection

{{--@push('styles')--}}
{{--    @vite('resources/css/background.css')--}}
{{--@endpush--}}
