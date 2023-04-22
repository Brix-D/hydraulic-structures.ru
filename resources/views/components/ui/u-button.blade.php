@props([
    'link' => false,
    'color' => 'info',
    'text' => false,
    'size' => 'medium',
    ])
@if($link)
    <a
        class="px-4
        inline-flex
        items-center
        rounded-lg
        cursor-pointer
        hover:shadow-lg
        justify-center
        {{$background }} {{$textColor}} {{ $size }}"
        href="{{$attributes->get('href')}}"
    >
        {{ $slot  }}
    </a>

@else
    <button
        class="px-4
        inline-flex
        items-center
        rounded-lg
        cursor-pointer
        hover:shadow-lg
        justify-center
        {{ $background }} {{ $textColor }} {{ $size }}"
        {{$attributes}}
    >
        {{ $slot  }}
    </button>
@endif
