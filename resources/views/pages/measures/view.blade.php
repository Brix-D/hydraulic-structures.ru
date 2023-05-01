@extends('layouts.app')

@section('page-title', 'Просмотр измерений')

@section('content')

<div class="flex flex-col items-center h-full py-6">
    <h2 class="text-primary text-3xl font-bold mb-2">Измерения</h2>
    <p class="text-secondary text-lg font-normal mb-2">{{ $reservoir->name }}</p>
    <p class="text-secondary text-lg font-normal mb-6">Секция №{{ $section->number }}</p>
    <div class="bg-demi p-8 rounded-lg shadow-lg flex flex-col">
        <table class="rounded-lg bg-light border-collapse border border-primary border-solid min-w-[1280px]">
            <thead class="rounded-tl-lg rounded-tr-lg">
                <tr class="rounded-tl-lg rounded-tr-lg">
                    <th class="text-left rounded-tl-lg text-primary font-medium w-1/4 py-3 px-4">Дата и время</th>
                    <th class="text-left text-primary font-medium w-1/4 py-3 px-4">Сотрудник</th>
                    <th class="text-left text-primary font-medium w-1/4 py-3 px-4 d">Значение уровня</th>
                    <th class="text-left rounded-tr-lg text-primary font-medium w-1/4 py-3 px-4 ">Насосы</th>
                </tr>
            </thead>
            <tbody>
                @foreach($measures as $measure)
                    <tr class="border-t border-solid border-primary">
                        <td class="text-primary font-medium w-1/4 py-3 px-4">
                            {{ $measure->createdAt->format('H:i d.m.Y') }}
                        </td>
                        <td class="text-primary font-medium w-1/4 py-3 px-4">
                            {{ $measure->user->name }}
                        </td>
                        <td class=" font-medium w-1/4 py-3 px-4 {{ $measure->color }}">
                            {{ $measure->value }}
                        </td>
                        <td class="text-primary font-medium w-1/4 py-3 px-4">
                            <div class="flex flex-col">
                                @if(count($measure->pump_measures) > 0)
                                    @foreach($measure->pump_measures as $pumpMeasure)
                                        <p>
                                            №{{ $pumpMeasure->pump->number }}:
                                            <span class="{{ $pumpMeasure->color }}">
                                                {{ $pumpMeasure->stateText }}
                                            </span>
                                        </p>
                                    @endforeach
                                @else
                                    <p>
                                        —
                                    </p>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- <pre>
        {{ $section }}
    </pre>
    <pre>
        {{ $measures }}
    </pre> -->
</div>

@endsection

