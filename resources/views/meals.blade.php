<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Meal Tracker') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Log a Meal</h3>

                @if(session('success'))
                    <div class="mb-4 text-green-600 font-bold">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('meals.store') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        
                        <div>
                            <x-input-label for="date" :value="__('Date')" />
                            <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" value="{{ date('Y-m-d') }}" required />
                        </div>

                        <div>
                            <x-input-label for="meal_type" :value="__('Meal Type')" />
                            <select id="meal_type" name="meal_type" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="breakfast">Breakfast</option>
                                <option value="lunch">Lunch</option>
                                <option value="dinner">Dinner</option>
                                <option value="snack">Snack</option>
                            </select>
                        </div>

                        <div>
                            <x-input-label for="food_id" :value="__('Food')" />
                            <select id="food_id" name="food_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="" disabled selected>Select a food...</option>
                                @foreach($foods as $food)
                                    <option value="{{ $food->id }}">{{ $food->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label for="quantity_g" :value="__('Amount (grams)')" />
                            <x-text-input id="quantity_g" class="block mt-1 w-full" type="number" name="quantity_g" placeholder="e.g., 150" required />
                        </div>
                    </div>

                    <div class="mt-4">
                        <x-primary-button>Save Meal</x-primary-button>
                    </div>
                </form>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Today's Log</h3>
                
                @if($todaysMeals->isEmpty())
                    <p class="text-gray-500">No meals logged for today yet. Go eat something!</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b text-gray-500 text-sm">
                                    <th class="py-2">Meal</th>
                                    <th class="py-2">Food</th>
                                    <th class="py-2">Amount</th>
                                    <th class="py-2">Calories</th>
                                    <th class="py-2">Protein</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($todaysMeals as $log)
                                    @php
                                        // The Math: (Calories per 100g / 100) * Grams Eaten
                                        $multiplier = $log->quantity_g / 100;
                                        $calories = round($log->food->calories_per_100g * $multiplier);
                                        $protein = round($log->food->protein_g * $multiplier, 1);
                                    @endphp
                                    <tr class="border-b">
                                        <td class="py-3 capitalize">{{ $log->meal_type }}</td>
                                        <td class="py-3">{{ $log->food->name }}</td>
                                        <td class="py-3">{{ $log->quantity_g }}g</td>
                                        <td class="py-3 font-bold text-orange-600">{{ $calories }} kcal</td>
                                        <td class="py-3 text-blue-600">{{ $protein }}g</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>