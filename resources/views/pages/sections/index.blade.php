@extends('layouts.app')

@section('page-title', 'Список секций ГТС')

@section('content')

<div class="flex flex-col items-center h-full py-6">
        <h2 class="text-primary text-3xl font-bold mb-2">Список секций</h2>
        <p class="text-secondary text-lg font-normal mb-6">{{ $resevoirName }}</p>
        <div class="bg-demi p-8 rounded-lg shadow-lg flex flex-col gap-y-6 min-w-[384px]">
            @foreach($sections as $section)
                <a href="{{ route($forwardRoute, ['reservoirId' => $resevoirId, 'sectionId' => $section->id]) }}" class="no-underline">
                    <article class="bg-white hover:bg-light rounded-lg p-6 border-solid border-primary border">
                        <h3 class="text-lg font-medium">Секция №{{ $section->number }}</h3>
                    </article>
                </a>
            @endforeach
        </div>

        <p class="text-primary text-base mt-6">
            <a href="{{ route($back) }}" class="text-info hover:underline">
                Назад
            </a>
        </p>
    </div>

@endsection
