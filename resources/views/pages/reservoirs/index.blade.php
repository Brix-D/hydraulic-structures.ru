@extends('layouts.app')

@section('page-title', 'Список ГТС')

@section('content')
    <div class="flex flex-col items-center h-full py-6">
        <h2 class="text-primary text-3xl font-bold mb-6">Список гидротехнических сооружений</h2>
        <div class="bg-demi p-8 rounded-lg shadow-lg flex flex-col gap-y-6">
            @foreach($reservoirs as $reservoir)
                <a href="" class="no-underline">
                    <article class="bg-white hover:bg-light rounded-lg p-6 border-solid border-primary border">
                        
                        <h3 class="text-lg font-medium">{{ $reservoir->name }}</h3>
                    </article>
                </a>
            @endforeach
        </div>
    </div>
@endsection