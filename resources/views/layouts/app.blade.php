<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen md:flex">
        @include('layouts.sidebar')
        <div class="flex-1 flex-col flex">
            @include('layouts.navebar')
            <main class="bg-[#f3f3f9] mb-auto flex-grow">
                <div class="border-b bg-white border-gray-300 pl-6 py-2 shadow-sm  text-xl font-bold">
                    @if (isset($header))
                        {{ $header }}
                    @endif
                    <span class="block text-xs font-normal text-gray-300 mt-2">
                        <a href="#">Home</a> &raquo;
                        <a href="#">Projects</a> &raquo;
                        <a href="#">Active</a> &raquo;
                        <a href="#">Test</a>
                    </span>
                </div>
                {{ $slot }}
            </main>
            @include('layouts.footer')
        </div>
    </div>
</body>

</html>
