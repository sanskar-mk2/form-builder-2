<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="cupcake">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        @vite('resources/css/app.css')
        @vite('resources/js/app.js')

    </head>
    <body class="antialiased">
        <div class="relative bg-base-200 flex flex-col items-top min-h-screen sm:items-center py-4 sm:pt-0">
            @include('layouts.nav')
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
