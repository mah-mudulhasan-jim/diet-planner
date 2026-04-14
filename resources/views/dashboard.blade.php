<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
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
                    <h3 class="text-lg font-bold mb-4">Recent Logs</h3>
                    @if($weightLogs->isEmpty())
                        <p class="text-gray-500">No weight logs yet. Start tracking today!</p>
                    @else
                        <ul class="space-y-3">
                            @foreach($weightLogs as $log)
                                <li class="flex justify-between border-b pb-2">
                                    <span class="text-gray-600">{{ \Carbon\Carbon::parse($log->date)->format('M d, Y') }}</span>
                                    <span class="font-bold">{{ $log->weight_kg }} kg</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
