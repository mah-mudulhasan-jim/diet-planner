<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Meal History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="GET" action="{{ route('history.index') }}" class="flex items-end gap-4">
                    <div>
                        <x-input-label for="date" :value="__('Select a Date')" />
                        <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" value="{{ $selectedDate }}" required />
                    </div>
                    <div class="pb-1">
                        <x-primary-button>{{ __('View Log') }}</x-primary-button>
                    </div>
                </form>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white p-4 rounded-lg shadow-sm text-center border-b-4 border-orange-500">
                    <p class="text-sm text-gray-500">Total Calories</p>
                    <p class="text-2xl font-bold">{{ round($totals['calories']) }}</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm text-center border-b-4 border-blue-500">
                    <p class="text-sm text-gray-500">Protein</p>
                    <p class="text-2xl font-bold">{{ round($totals['protein'], 1) }}g</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm text-center border-b-4 border-green-500">
                    <p class="text-sm text-gray-500">Carbs</p>
                    <p class="text-2xl font-bold">{{ round($totals['carbs'], 1) }}g</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm text-center border-b-4 border-yellow-500">
                    <p class="text-sm text-gray-500">Fat</p>
                    <p class="text-2xl font-bold">{{ round($totals['fat'], 1) }}g</p>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Meals for {{ \Carbon\Carbon::parse($selectedDate)->format('F j, Y') }}</h3>
                
                @if($meals->isEmpty())
                    <p class="text-gray-500">No meals were logged on this date.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b text-gray-500 text-sm">
                                    <th class="py-2">Meal</th>
                                    <th class="py-2">Food</th>
                                    <th class="py-2">Amount</th>
                                    <th class="py-2">Calories</th>
                                    <th class="py-2">P / C / F</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($meals as $log)
                                    @php
                                        $m = $log->quantity_g / 100;
                                        $cal = round($log->food->calories_per_100g * $m);
                                        $p = round($log->food->protein_g * $m, 1);
                                        $c = round($log->food->carbs_g * $m, 1);
                                        $f = round($log->food->fat_g * $m, 1);
                                    @endphp
                                    <tr class="border-b">
                                        <td class="py-3 capitalize font-semibold">{{ $log->meal_type }}</td>
                                        <td class="py-3">{{ $log->food->name }}</td>
                                        <td class="py-3">{{ $log->quantity_g }}g</td>
                                        <td class="py-3 text-orange-600 font-bold">{{ $cal }} kcal</td>
                                        <td class="py-3 text-sm text-gray-600">{{ $p }}g / {{ $c }}g / {{ $f }}g</td>
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