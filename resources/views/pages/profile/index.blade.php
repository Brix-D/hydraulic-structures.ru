@extends('layouts.app')

@section('page-title', 'Профиль')

@section('content')
<div class="flex flex-col h-full py-6">
    <h2 class="text-primary text-3xl font-bold mb-6">Профиль</h2>
    <div class="flex flex-col gap-y-4">
        <p>
            <span class="text-primary text-base font-medium">Имя:</span>
            <span class="text-secondary text-base">{{ $name }}</span>
        </p>
        <div class="flex">
            <div class="flex flex-col  gap-y-4">
                @can('register-worker')
                    <p class="text-primary text-base font-medium">Действия:</p>
                    <x-ui.u-button link :href="route('auth.registerWorker')" color="info">
                        Регистрация сотрудника
                    </x-ui.u-button>
                @endcan
            </div>
        </div>
    </div>
</div>

@endsection
