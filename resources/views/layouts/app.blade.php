<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('page-title')</title>
        @vite('resources/css/app.css')
        @vite('resources/css/icons.css')
        @vite('resources/css/components/menu.css')
        @stack('styles')
    </head>
    <body>
        <div id="app" class="flex flex-col min-h-screen h-full">
            @section('header')
                <x-header />
            @show

            <main class="bg-light flex-grow flex pt-24 h-full">
                @auth
                    @section('menu')
                        <x-menu />
                    @show
                @endauth 
                <div class="content flex-grow flex min-h-full overflow-auto">
                    <div class="container px-6 mx-auto">
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>

    @stack('scripts')
    </body>
</html>
