<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Expert Directory') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-8">
                <h3 class="text-2xl font-bold text-gray-900">Find Your Nutrition Coach</h3>
                <p class="text-gray-600 mt-1">Book a 1-on-1 consultation with verified experts to accelerate your goals.</p>
            </div>

            <!-- Expert Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($experts as $expert)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
                        <div class="p-6">
                            <div class="flex items-center gap-4 mb-4">
                                <!-- Avatar Placeholder -->
                                <div class="h-14 w-14 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-500 font-bold text-xl">
                                    {{ substr($expert->name, 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="text-lg font-bold text-gray-900">{{ $expert->name }}</h4>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $expert->nutritionistProfile->specialty }}
                                    </span>
                                </div>
                            </div>
                            
                            <p class="text-sm text-gray-600 line-clamp-3 mb-6 h-12">
                                {{ $expert->nutritionistProfile->bio ?? 'No biography provided yet.' }}
                            </p>

                            <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                                <div class="text-sm">
                                    <span class="font-bold text-gray-900">${{ $expert->nutritionistProfile->consultation_fee }}</span>
                                    <span class="text-gray-500">/ session</span>
                                </div>
                                <a href="{{ route('experts.show', $expert->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold py-2 px-4 rounded-lg transition-colors">
                                    View Profile
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-xl p-8 text-center shadow-sm border border-gray-100">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No experts available</h3>
                        <p class="mt-1 text-sm text-gray-500">We are currently onboarding new verified nutritionists. Check back soon!</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>