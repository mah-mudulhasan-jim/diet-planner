<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smart Diet Planner</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-slate-50 text-gray-900 font-sans min-h-screen flex flex-col">

    <nav class="relative w-full shadow-md py-4 px-6 sm:px-12 flex justify-between items-center min-h-[160px] overflow-hidden">
        
        <img src="{{ asset('images/banner.png') }}" alt="Diet Planner Banner" class="absolute inset-0 w-full h-full object-cover object-center z-0 pointer-events-none">

        <div class="relative z-10 flex items-center">
            <a href="/" class="hover:opacity-80 transition">
                <img src="{{ asset('images/logo.png') }}" alt="Icon" class="h-16 sm:h-20 w-auto drop-shadow-md">
            </a>
        </div>
        
        <div class="relative z-10 flex items-center gap-6 bg-white/70 backdrop-blur-sm px-5 py-3 rounded-xl shadow-sm border border-white/50">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-gray-900 hover:text-indigo-700 font-bold transition">Go to Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-900 hover:text-indigo-700 font-bold transition">Sign In</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-5 py-2.5 rounded-lg font-bold hover:bg-indigo-700 shadow-md transition">Get Started</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <main class="relative flex-grow flex flex-col justify-center items-center text-center pt-32 pb-20 overflow-hidden">
        
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/banner1.png') }}" alt="Hero Background" class="w-full h-full object-cover object-center pointer-events-none">
            <div class="absolute inset-0 bg-slate-50/40 backdrop-blur-[2px]"></div>
        </div>

        <div class="relative z-10 max-w-3xl px-6">
            <h1 class="text-5xl sm:text-6xl font-extrabold tracking-tight text-gray-900 mb-6 leading-tight">
                Master Your Macros. <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500">Hit Your Goals.</span>
            </h1>
            
            <p class="text-lg sm:text-xl text-gray-700 mb-10 max-w-2xl mx-auto font-medium">
                A smart, minimalist tracker that adapts to your body. Log your meals, monitor your weight trends, and let our algorithm calculate your perfect daily targets.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="bg-indigo-600 text-white px-8 py-3.5 rounded-xl text-lg font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all duration-200">
                        Access Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-8 py-3.5 rounded-xl text-lg font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all duration-200">
                        Start Planning Now
                    </a>
                    <a href="{{ route('login') }}" class="bg-white text-indigo-600 border-2 border-indigo-100 px-8 py-3.5 rounded-xl text-lg font-bold shadow-sm hover:bg-indigo-50 hover:-translate-y-0.5 transition-all duration-200">
                        Sign In
                    </a>
                @endauth
            </div>
        </div>

        <div class="relative z-10 grid grid-cols-1 sm:grid-cols-3 gap-8 mt-24 max-w-5xl mx-auto text-left px-6">
            <div class="bg-white/80 backdrop-blur-md p-6 rounded-2xl shadow-sm border border-white hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center text-indigo-600 mb-4 font-bold text-xl">1</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Smart Targets</h3>
                <p class="text-gray-600 text-sm">Dynamic caloric goals that automatically adjust based on your current weight and fitness objectives.</p>
            </div>
            <div class="bg-white/80 backdrop-blur-md p-6 rounded-2xl shadow-sm border border-white hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 mb-4 font-bold text-xl">2</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Macro Analytics</h3>
                <p class="text-gray-600 text-sm">Visualize your daily protein, carbohydrate, and fat intake with beautiful interactive charts.</p>
            </div>
            <div class="bg-white/80 backdrop-blur-md p-6 rounded-2xl shadow-sm border border-white hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center text-green-600 mb-4 font-bold text-xl">3</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Progress History</h3>
                <p class="text-gray-600 text-sm">Look back at your journey with a comprehensive calendar view of your past meals and weight logs.</p>
            </div>
        </div>
    </main>

    <footer class="w-full text-center py-6 text-gray-400 text-sm">
        &copy; {{ date('Y') }} Diet Planner. Built for CSE470.
    </footer>

</body>
</html>