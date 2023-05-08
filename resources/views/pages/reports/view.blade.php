@extends('layouts.app')

@section('page-title', 'Отчет')

@section('content')

<div class="absolute top-6">
    <p class="text-primary text-base">
        <a href="{{ $backRoute }}" class="text-info hover:underline">
            Назад
        </a>
    </p>
</div>

<div class="flex flex-col justify-center items-center min-h-full">
    <h1 class="text-primary text-3xl font-bold mb-2">Отчет</h1>
    <p class="text-secondary text-lg font-normal mb-6">{{ $reservoirName }}</p>
    <div class="bg-demi p-8 rounded-lg shadow-lg">
        <div class="flex flex-col gap-y-6">
            <div class="relative min-w-[60vw]">
                <canvas id="reportValue" />
            </div>
        </div>
    </div>
</div>

@endsection


@push('scripts')
    @vite('resources/js/report.js')
@endpush