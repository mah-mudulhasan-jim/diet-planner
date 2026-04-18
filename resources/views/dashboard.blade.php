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

            <div x-data="{ 
                    question: '', 
                    answer: '', 
                    isLoading: false, 
                    askAi() {
                        if(this.question.trim() === '') return;
                        this.isLoading = true;
                        this.answer = '';
                        
                        fetch('{{ route('ai.ask') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').getAttribute('content'),
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ question: this.question })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if(data.answer) {
                                this.answer = data.answer;
                            } else {
                                this.answer = data.error || 'An error occurred.';
                            }
                            this.isLoading = false;
                        })
                        .catch(error => {
                            this.answer = 'Network error. Please try again.';
                            this.isLoading = false;
                        });
                    }
                }"
    class="mt-8 bg-gradient-to-r from-indigo-900 to-slate-800 rounded-2xl shadow-xl overflow-hidden border border-indigo-700/50">

    <div class="p-6 sm:p-8">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-12 h-12 rounded-full bg-indigo-500/20 flex items-center justify-center text-indigo-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                </svg>
            </div>
            <div>
                <h3 class="text-xl font-bold text-white">Personal Health Assistant</h3>
                <p class="text-indigo-200 text-sm">Powered by AI. Personalized to your exact biometric goals.</p>
            </div>
        </div>

        <div class="relative flex items-center">
            <input type="text" x-model="question" @keydown.enter="askAi"
                placeholder="Ask me anything... e.g., 'What are some high-protein snacks I can eat to gain weight?'"
                class="w-full bg-white/10 border border-white/20 text-white placeholder-indigo-300 rounded-xl px-5 py-4 pr-32 focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition-all"
                :disabled="isLoading">
            <button @click="askAi" :disabled="isLoading"
                class="absolute right-2 top-2 bottom-2 bg-indigo-500 hover:bg-indigo-600 text-white font-bold rounded-lg px-6 transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex items-center">
                <span x-show="!isLoading">Ask AI</span>
                <span x-show="isLoading" class="flex items-center gap-2">
                    <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    Thinking...
                </span>
            </button>
        </div>

        <div x-show="answer !== ''" x-transition.opacity class="mt-6 bg-white/5 border border-white/10 rounded-xl p-6">
            <div class="flex items-start gap-4">
                <div class="min-w-[32px] mt-1">
                    <div
                        class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center text-white text-xs font-bold">
                        AI</div>
                </div>
                <div class="text-indigo-50 leading-relaxed text-sm whitespace-pre-wrap" x-text="answer"></div>
            </div>
        </div>
    </div>
</div>
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
