<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Appointments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white/60 backdrop-blur-lg shadow-sm sm:rounded-xl p-8 border border-white/40">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Upcoming Consultations</h3>

                @if($appointments->isEmpty())
                    <div class="text-center py-12">
                        <p class="text-gray-500 italic">No appointments scheduled yet.</p>
                        <a href="{{ route('experts.index') }}" class="mt-4 inline-block text-indigo-600 font-bold hover:underline">Find an expert &rarr;</a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-gray-400 text-sm uppercase tracking-wider border-b border-gray-100">
                                    <th class="pb-4 px-4 font-semibold">{{ Auth::user()->role === 'nutritionist' ? 'Client' : 'Expert' }}</th>
                                    <th class="pb-4 px-4 font-semibold">Date & Time</th>
                                    <th class="pb-4 px-4 font-semibold">Status</th>
                                    <th class="pb-4 px-4 text-right font-semibold">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach($appointments as $appointment)
                                    <tr class="hover:bg-gray-50/50 transition-colors">
                                        <td class="py-5 px-4">
                                            <div class="flex items-center gap-3">
                                                <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-sm">
                                                    {{ substr(Auth::user()->role === 'nutritionist' ? $appointment->user->name : $appointment->nutritionist->name, 0, 1) }}
                                                </div>
                                                <span class="font-bold text-gray-900">
                                                    {{ Auth::user()->role === 'nutritionist' ? $appointment->user->name : $appointment->nutritionist->name }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="py-5 px-4 text-gray-600 text-sm">
                                            {{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('M d, Y @ h:i A') }}
                                        </td>
                                        <td class="py-5 px-4">
                                            <span class="px-3 py-1 rounded-full text-xs font-bold uppercase
                                                {{ $appointment->status === 'confirmed' ? 'bg-green-100 text-green-700' : 
                                                   ($appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                                {{ $appointment->status }}
                                            </span>
                                        </td>
                                        <td class="py-5 px-4 text-right">
                                            @if(Auth::user()->role === 'nutritionist' && $appointment->status === 'pending')
                                                <form action="{{ route('appointments.update', $appointment->id) }}" method="POST" class="inline">
                                                    @csrf @method('PATCH')
                                                    <button name="status" value="confirmed" class="text-green-600 hover:text-green-800 font-bold text-sm mr-4">Confirm</button>
                                                    <button name="status" value="cancelled" class="text-red-600 hover:text-red-800 font-bold text-sm">Decline</button>
                                                </form>
                                            @else
                                                <a href="{{ route('messages.show', Auth::user()->role === 'nutritionist' ? $appointment->user_id : $appointment->nutritionist_id) }}" class="text-indigo-600 hover:text-indigo-800 font-bold text-sm">Message</a>
                                            @endif
                                        </td>
                                    </tr>
                                    
                                    <!-- Display Notes if they exist -->
                                    @if($appointment->notes)
                                    <tr>
                                        <td colspan="4" class="px-4 pb-4 pt-1 border-b border-gray-100">
                                            <div class="bg-indigo-50/50 border-l-4 border-indigo-400 p-3 rounded-r-lg text-sm text-gray-700">
                                                <span class="font-bold text-indigo-900">
                                                    Goal / Note from {{ Auth::user()->role === 'nutritionist' ? 'Client' : 'You' }}:
                                                </span> 
                                                {{ $appointment->notes }}
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>