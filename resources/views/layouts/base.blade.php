<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="cupcake">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <title>Laravel</title>

        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        @livewireStyles
    </head>
    <body class="antialiased">
        <div class="relative bg-base-100 flex flex-col items-top min-h-screen sm:items-center sm:pt-0">
            @include('layouts.nav')
            <div  class="container flex flex-col grow bg-base-100">
                {{ $slot }}
            </div>
        </div>
        @livewireScripts
    </body>
</html>
