<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-600 leading-tight">
            {{ __('Admin Control Center') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white shadow-sm sm:rounded-lg p-6 border-l-4 border-red-500">
                <h3 class="text-lg font-bold mb-4">Add Food to Global Directory</h3>

                @if(session('success'))
                    <div class="mb-4 text-green-600 font-bold">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="mb-4 text-red-600">Please check the form for errors (Food might already exist).</div>
                @endif

                <form method="POST" action="{{ route('admin.food.store') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                        
                        <div class="md:col-span-2">
                            <x-input-label for="name" :value="__('Food Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" placeholder="e.g., Sweet Potato (Boiled)" required />
                        </div>

                        <div>
                            <x-input-label for="calories_per_100g" :value="__('Calories (per 100g)')" />
                            <x-text-input id="calories_per_100g" class="block mt-1 w-full" type="number" name="calories_per_100g" required />
                        </div>

                        <div>
                            <x-input-label for="protein_g" :value="__('Protein (g)')" />
                            <x-text-input id="protein_g" class="block mt-1 w-full" type="number" step="0.1" name="protein_g" required />
                        </div>

                        <div>
                            <x-input-label for="carbs_g" :value="__('Carbs (g)')" />
                            <x-text-input id="carbs_g" class="block mt-1 w-full" type="number" step="0.1" name="carbs_g" required />
                        </div>
                        
                        <div>
                            <x-input-label for="fat_g" :value="__('Fat (g)')" />
                            <x-text-input id="fat_g" class="block mt-1 w-full" type="number" step="0.1" name="fat_g" required />
                        </div>
                    </div>

                    <div class="mt-4">
                        <x-primary-button class="bg-red-600 hover:bg-red-700">Add to Database</x-primary-button>
                    </div>
                </form>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Current Database</h3>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b text-gray-500 text-sm">
                                <th class="py-2">ID</th>
                                <th class="py-2">Food Name</th>
                                <th class="py-2">Calories</th>
                                <th class="py-2">Macros (P / C / F)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($foods as $food)
                                <tr class="border-b">
                                    <td class="py-3 text-gray-400">#{{ $food->id }}</td>
                                    <td class="py-3 font-bold">{{ $food->name }}</td>
                                    <td class="py-3">{{ $food->calories_per_100g }} kcal</td>
                                    <td class="py-3 text-sm text-gray-600">
                                        {{ $food->protein_g }}g / {{ $food->carbs_g }}g / {{ $food->fat_g }}g
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>