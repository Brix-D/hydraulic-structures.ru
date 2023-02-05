<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('page-title')</title>
        @vite('resources/css/app.css')
        @stack('styles')
    </head>
    <body>

        <div id="app">
            @section('header')
                <header class="text-3xl">
                    x-header
                </header>
            @show

            <main class="container">
                @yield('content')
            </main>
        </div>

    @stack('scripts')
    </body>
</html>
