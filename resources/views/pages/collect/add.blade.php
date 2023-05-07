@extends('layouts.app')

@section('page-title', 'Внести запись')

@section('content')

<div class="flex flex-col justify-center items-center h-full">
    <h1 class="text-primary text-3xl font-bold mb-2">Внести запись</h1>
    <p class="text-secondary text-lg font-normal mb-6">{{ $reservoirName }}</p>
    <div class="bg-demi p-8 rounded-lg shadow-lg">
        <div class="flex flex-col gap-y-6">
            @foreach($sections as $index => $section)
                <div class="flex flex-col">
                    <h3 class="text-primary text-lg font-medium mb-3">Секция №{{ $section->number }}</h3>
                    <form action="{{ route('collect.store', ['reservoirId' => $reservoirId, 'sectionId' => $section->id]) }}" method="POST" class="flex gap-x-4 items-end">
                        @csrf
                        <div class="flex flex-col gap-y-2">
                            <p class="text-secondary text-base font-medium">Уровень жидкости:</p>
                            <x-ui.u-input type="number" name="value"/>
                            @error('value', 'section' . $section->id)
                                <div class="ml-4 text-error">{{ $message }}</div>
                            @enderror
                        </div>
                        @if(count($section->pumps) > 0)
                            <div class="flex gap-x-4">
                                @foreach($section->pumps as $pump)
                                    <div class="flex flex-col gap-y-2">
                                        <p class="text-secondary text-base font-medium">Насос №{{ $pump->number }}:</p>
                                        <input type="hidden" value="{{ $pump->id }}" name="pumpId[]">
                                        <x-ui.u-select name="pumpState[]" :options="$pumpStates"/>
                                        @error('pumpState.*', 'section' . $section->id)
                                            <div class="ml-4 text-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <div class="ml-auto">
                            <x-ui.u-button type="submit">Сохранить</x-ui.u-button>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection



