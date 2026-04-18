<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                @php
                    $hour = now()->format('H');
                    if ($hour < 12) {
                        $greeting = 'Good Morning';
                    } elseif ($hour < 17) {
                        $greeting = 'Good Afternoon';
                    } else {
                        $greeting = 'Good Evening';
                    }
                @endphp
                {{ $greeting }}, {{ explode(' ', $user->name)[0] }}! 
            </h2>
            <span class="text-sm text-gray-500 bg-white px-3 py-1 rounded-full shadow-sm">
                Target: {{ $user->daily_calorie_target }} kcal
            </span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @php
                $target = $user->daily_calorie_target;
                $percentage = $target > 0 ? min(100, round(($caloriesEaten / $target) * 100)) : 0;
                
                // Color logic: green if good, red if they overate
                $barColor = $caloriesEaten > $target ? 'bg-red-500' : 'bg-green-500';
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                @php
                    $target = $user->daily_calorie_target;
                    $percentage = $target > 0 ? min(100, round(($caloriesEaten / $target) * 100)) : 0;
                    $barColor = $caloriesEaten > $target ? 'bg-red-500' : 'bg-green-500';
                @endphp
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-2">Today's Calorie Progress</h3>
                    <div class="flex justify-between text-sm mb-1 mt-4">
                        <span><strong class="text-lg">{{ $caloriesEaten }}</strong> kcal eaten</span>
                        <span><strong class="text-lg">{{ $target }}</strong> kcal target</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-4 mt-2 mb-2">
                        <div class="{{ $barColor }} h-4 rounded-full transition-all duration-500 ease-in-out" style="width: {{ $percentage }}%"></div>
                    </div>
                    <p class="text-sm text-gray-500 text-right mt-1">
                        @if($caloriesEaten > $target)
                            <span class="text-red-500 font-bold">You are {{ $caloriesEaten - $target }} kcal over!</span>
                        @else
                            <span class="text-green-600 font-bold">{{ $target - $caloriesEaten }} kcal</span> remaining.
                        @endif
                    </p>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-2">Today's Macronutrients</h3>
                    
                    @if($caloriesEaten == 0)
                        <p class="text-gray-500 mt-4">Log a meal to see your macro breakdown!</p>
                    @else
                        <div class="relative h-32 w-full flex justify-center mt-2">
                            <canvas id="macroChart"></canvas>
                        </div>
                        
                        <div class="mt-6 grid grid-cols-3 divide-x divide-gray-200 text-sm text-center">
                            <div>
                                <span class="font-bold text-blue-500 text-lg block">{{ $proteinEaten }}g</span>
                                <span class="text-gray-500 font-medium">Protein</span>
                            </div>
                            <div>
                                <span class="font-bold text-green-500 text-lg block">{{ $carbsEaten }}g</span>
                                <span class="text-gray-500 font-medium">Carbs</span>
                            </div>
                            <div>
                                <span class="font-bold text-yellow-500 text-lg block">{{ $fatEaten }}g</span>
                                <span class="text-gray-500 font-medium">Fat</span>
                            </div>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const ctxMacro = document.getElementById('macroChart').getContext('2d');
                                new Chart(ctxMacro, {
                                    type: 'doughnut',
                                    data: {
                                        labels: ['Protein', 'Carbs', 'Fat'],
                                        datasets: [{
                                            data: [{{ $proteinEaten }}, {{ $carbsEaten }}, {{ $fatEaten }}],
                                            backgroundColor: ['#3B82F6', '#22C55E', '#EAB308'], // Blue, Green, Yellow
                                            borderWidth: 0,
                                            hoverOffset: 4
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        cutout: '75%', // Makes the donut hole thinner or thicker
                                        plugins: {
                                            legend: { display: false } // Hidden because we built a custom HTML legend
                                        }
                                    }
                                });
                            });
                        </script>
                    @endif
                </div>
            </div>
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">My Profile</h3>
                <div class="grid grid-cols-3 gap-4 text-center">
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-500">Height</p>
                        <p class="text-2xl font-bold">{{ $user->height_cm }} cm</p>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-500">Current Weight</p>
                        <p class="text-2xl font-bold">{{ $user->current_weight_kg }} kg</p>
                    </div>
                    <div class="bg-purple-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-500">Goal</p>
                        <p class="text-2xl font-bold capitalize">{{ $user->goal_type }}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-4">Log Daily Weight</h3>
                    
                    @if(session('success'))
                        <div class="mb-4 text-green-600 font-bold">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('weight.store') }}">
                        @csrf
                        <div class="mb-4">
                            <x-input-label for="date" :value="__('Date')" />
                            <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" value="{{ date('Y-m-d') }}" required />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="weight_kg" :value="__('Weight (kg)')" />
                            <x-text-input id="weight_kg" class="block mt-1 w-full" type="number" step="0.1" name="weight_kg" placeholder="e.g., 75.5" required />
                        </div>
                        <x-primary-button>Save Weight</x-primary-button>
                    </form>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-4">Weight Progress</h3>
                    
                    @if($weightLogs->isEmpty())
                        <p class="text-gray-500">No weight logs yet. Start tracking today!</p>
                    @else
                        <canvas id="weightChart"></canvas>
                        
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const ctx = document.getElementById('weightChart').getContext('2d');
                                
                                // Load the JSON data we passed from the route
                                const dates = {!! $chartDates !!};
                                const weights = {!! $chartWeights !!};

                                new Chart(ctx, {
                                    type: 'line',
                                    data: {
                                        labels: dates,
                                        datasets: [{
                                            label: 'Weight (kg)',
                                            data: weights,
                                            borderColor: '#4F46E5', // Indigo color to match Tailwind
                                            backgroundColor: 'rgba(79, 70, 229, 0.1)',
                                            borderWidth: 3,
                                            tension: 0.3, // Adds a slight curve to the line
                                            fill: true,
                                            pointBackgroundColor: '#4F46E5',
                                            pointRadius: 4
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        plugins: {
                                            legend: { display: false }
                                        },
                                        scales: {
                                            y: {
                                                beginAtZero: false, // Don't start at 0 kg!
                                                suggestedMin: Math.min(...weights) - 5, // Auto-scale the bottom
                                                suggestedMax: Math.max(...weights) + 5  // Auto-scale the top
                                            }
                                        }
                                    }
                                });
                            });
                        </script>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
