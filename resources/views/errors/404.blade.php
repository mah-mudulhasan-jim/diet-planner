<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page Not Found - Diet Planner</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900 flex items-center justify-center min-h-screen">
    <div class="max-w-md w-full bg-white shadow-lg rounded-lg p-8 text-center border-t-4 border-indigo-500">
        <h1 class="text-9xl font-extrabold text-gray-200">404</h1>
        <h2 class="text-2xl font-bold mt-4 mb-2">Oops! You lost your way.</h2>
        <p class="text-gray-500 mb-6">We couldn't find the page you're looking for. It might have been moved or deleted.</p>
        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 transition duration-150">
            Take Me Home
        </a>
    </div>
</body>
</html>