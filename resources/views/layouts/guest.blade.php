<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <style>
            @media(max-width: 640px) {
                #pop{
                    min-height: 100vh !important;
                    margin: 0% !important;
                }

                #pop-container{
                    padding: 0% !important;
                }
            }
        </style>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div id="pop-container" class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100" style="
            background: RGB(28 90 249);
background: linear-gradient(174deg,rgba(28, 90, 249, 1) 0%, rgba(0, 0, 0, 1) 100%);
            )">
            <div id="pop" class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white overflow-hidden sm:rounded-lg shadow-md">
                <a href="/" class="flex items-center space-x-2 w-full mt-6 mb-6 justify-center">
                    <x-application-logo class="fill-current mx-auto text-gray-500" />
                </a>
        
                {{ $slot }}
            </div>
        </div>
        
    </body>
</html>
