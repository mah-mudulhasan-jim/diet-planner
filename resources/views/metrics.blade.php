<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Health Metrics Calculator') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div x-data="{
                    weight: {{ $user->current_weight_kg }},
                    height: {{ $user->height_cm }},
                    age: 25,
                    gender: 'male',
                    get bmi() {
                        if (this.height > 0 && this.weight > 0) {
                            return (this.weight / Math.pow(this.height / 100, 2)).toFixed(1);
                        }
                        return '0.0';
                    },
                    get bmr() {
                        if (this.height > 0 && this.weight > 0 && this.age > 0) {
                            let base = (10 * this.weight) + (6.25 * this.height) - (5 * this.age);
                            return this.gender === 'male' ? Math.round(base + 5) : Math.round(base - 161);
                        }
                        return 0;
                    },
                    get bmiCategory() {
                        let b = parseFloat(this.bmi);
                        if (b === 0) return '-';
                        if (b < 18.5) return 'Underweight (Risk of nutrient deficiency)';
                        if (b >= 18.5 && b <= 24.9) return 'Normal Weight (Healthy range)';
                        if (b >= 25 && b <= 29.9) return 'Overweight (Moderate risk)';
                        return 'Obese (High risk)';
                    },
                    get categoryColor() {
                        let b = parseFloat(this.bmi);
                        if (b < 18.5) return 'text-blue-500';
                        if (b >= 18.5 && b <= 24.9) return 'text-green-500';
                        if (b >= 25 && b <= 29.9) return 'text-yellow-500';
                        return 'text-red-500';
                    }
                }" 
                class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <div class="bg-white/60 backdrop-blur-lg shadow-sm sm:rounded-xl p-6 border-t-4 border-indigo-500 flex flex-col justify-center">
                    <h3 class="text-lg font-bold text-gray-900 mb-6">Your Profile Metrics</h3>
                    
                    @php
                        $profileBmi = round($user->current_weight_kg / (($user->height_cm / 100) ** 2), 1);
                    @endphp

                    <div class="mb-6">
                        <p class="text-sm text-gray-500 uppercase tracking-wider font-semibold">Current BMI</p>
                        <div class="flex items-baseline gap-2">
                            <span class="text-4xl font-extrabold text-gray-900">{{ $profileBmi }}</span>
                        </div>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 uppercase tracking-wider font-semibold mb-1">Estimated BMR</p>
                        <p class="text-gray-700 text-sm mb-2">The baseline calories your body burns at rest.</p>
                        <span class="text-2xl font-bold text-gray-900" x-text="bmr + ' kcal'"></span>
                        <p class="text-xs text-gray-400 mt-1">*Based on calculator inputs.</p>
                    </div>
                </div>

                <div class="lg:col-span-2 bg-white/60 backdrop-blur-lg shadow-sm sm:rounded-xl p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Interactive Calculator</h3>
                    <p class="text-sm text-gray-500 mb-6">Adjust the parameters below to see how changes in weight or age affect your metrics.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Height (cm)</label>
                                <input type="number" x-model.number="height" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Weight (kg)</label>
                                <input type="number" x-model.number="weight" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Age</label>
                                    <input type="number" x-model.number="age" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Gender</label>
                                    <select x-model="gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white/80 rounded-lg p-5 flex flex-col justify-center border border-slate-100 shadow-inner">
                            <div class="text-center mb-6">
                                <p class="text-sm text-gray-500 font-medium">Calculated BMI</p>
                                <p class="text-5xl font-black mt-1" :class="categoryColor" x-text="bmi"></p>
                                <p class="text-sm font-bold mt-2" :class="categoryColor" x-text="bmiCategory"></p>
                            </div>
                            
                            <div class="text-center border-t border-gray-200 pt-4">
                                <p class="text-sm text-gray-500 font-medium">Calculated BMR</p>
                                <p class="text-2xl font-bold text-gray-900 mt-1"><span x-text="bmr"></span> <span class="text-base font-normal text-gray-500">kcal/day</span></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>