<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('experts.index') }}" class="text-gray-500 hover:text-indigo-600 transition-colors">
                &larr; Back to Directory
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Book Consultation') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- Left Column: Expert Details -->
                <div class="md:col-span-1 space-y-6">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center">
                        <div class="h-24 w-24 mx-auto rounded-full bg-indigo-100 flex items-center justify-center text-indigo-500 font-bold text-4xl mb-4">
                            {{ substr($expert->name, 0, 1) }}
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $expert->name }}</h3>
                        <p class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 mt-2">
                            {{ $expert->nutritionistProfile->specialty }}
                        </p>
                        
                        <div class="mt-6 border-t border-gray-100 pt-6 text-left">
                            <h4 class="font-bold text-gray-900 mb-2">About Me</h4>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                {{ $expert->nutritionistProfile->bio }}
                            </p>
                        </div>

                        <div class="mt-6 bg-slate-50 rounded-xl p-4">
                            <p class="text-sm text-gray-500 uppercase tracking-wider font-semibold">Consultation Fee</p>
                            <p class="text-3xl font-extrabold text-gray-900 mt-1">${{ $expert->nutritionistProfile->consultation_fee }}</p>
                        </div>
                        <!-- Direct Message Button -->
                        <a href="{{ route('messages.show', $expert->id) }}" class="mt-4 w-full flex justify-center items-center gap-2 bg-white border-2 border-indigo-600 text-indigo-600 hover:bg-indigo-50 font-bold py-3 px-8 rounded-xl transition-colors shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                            </svg>
                            Direct Message
                        </a>
                    </div>
                </div>

                <!-- Right Column: Booking Form -->
                <div class="md:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Schedule Your Session</h3>

                    <!-- Display Success Messages -->
                    @if (session('success'))
                        <div class="mb-6 bg-green-50 text-green-700 p-4 rounded-xl border border-green-200">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('appointments.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="nutritionist_id" value="{{ $expert->id }}">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Date Selection -->
                            <div>
                                <label for="date" class="block text-sm font-medium text-gray-700">Preferred Date</label>
                                <input type="date" name="date" id="date" required min="{{ date('Y-m-d') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <!-- Time Selection -->
                            <div>
                                <label for="time" class="block text-sm font-medium text-gray-700">Preferred Time</label>
                                <select name="time" id="time" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="">Select a time...</option>
                                    <option value="09:00:00">09:00 AM</option>
                                    <option value="10:00:00">10:00 AM</option>
                                    <option value="11:00:00">11:00 AM</option>
                                    <option value="13:00:00">01:00 PM</option>
                                    <option value="14:00:00">02:00 PM</option>
                                    <option value="15:00:00">03:00 PM</option>
                                    <option value="16:00:00">04:00 PM</option>
                                </select>
                            </div>
                        </div>

                        <!-- Notes for the Expert -->
                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700">What are your main goals for this consultation?</label>
                            <textarea name="notes" id="notes" rows="4" placeholder="E.g., I want to transition to a vegan diet but I'm worried about protein..."
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end pt-4 border-t border-gray-100">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl transition-colors shadow-sm">
                                Request Appointment
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>