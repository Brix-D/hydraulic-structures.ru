<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('page-title')</title>
        @vite('resources/css/app.css')
        @vite('resources/css/icons.css')
        @stack('styles')
    </head>
    <body>
        <div id="app" class="flex flex-col min-h-screen">
            @section('header')
                <x-header />
            @show

            <main class="bg-light flex-grow">
                <!-- @auth -->
                    @section('menu')
                        <x-menu />
                    @show
                <!-- @endauth -->
                
                <div class="container px-6 mx-auto">
                @yield('content')
                </div>
            </main>
        </div>

    @stack('scripts')
    </body>
</html>
