<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Diet Planner') }}</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased min-h-screen flex flex-col items-center pt-10 sm:pt-0">

    <div class="fixed inset-0 -z-10">
        <img src="{{ asset('images/banner1.png') }}" alt="Background" class="w-full h-full object-cover object-center pointer-events-none">
        <div class="absolute inset-0 bg-slate-50/40 backdrop-blur-[2px]"></div>
    </div>

    <div class="relative w-full sm:max-w-md mt-6 flex flex-col items-center z-10">
        
        <a href="/" class="mb-10 drop-shadow-md hover:opacity-90 transition">
            <img src="{{ asset('images/logo.png') }}" alt="Diet Planner Logo" class="w-16 h-16 w-auto">
        </a>

        <div class="w-full px-8 py-6 bg-white/10 backdrop-blur-lg shadow-2xl overflow-hidden sm:rounded-xl border-t-4 border-indigo-600 relative">
            {{ $slot }}
        </div>

    </div>
</body>
</html>