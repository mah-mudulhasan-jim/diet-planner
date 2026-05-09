<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Messages') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/70 backdrop-blur-md shadow-xl rounded-2xl overflow-hidden border border-white/40">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900">Your Conversations</h3>
                </div>

                <div class="divide-y divide-gray-50">
                    @forelse($conversations as $otherUserId => $msgs)
                        @php $otherUser = $msgs->first()->sender_id === Auth::id() ? $msgs->first()->receiver : $msgs->first()->sender; @endphp
                        <a href="{{ route('messages.show', $otherUser->id) }}" class="flex items-center gap-4 p-6 hover:bg-indigo-50/50 transition-colors">
                            <div class="h-12 w-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">
                                {{ substr($otherUser->name, 0, 1) }}
                            </div>
                            <div class="flex-grow">
                                <div class="flex justify-between items-center mb-1">
                                    <h4 class="font-bold text-gray-900">{{ $otherUser->name }}</h4>
                                    <span class="text-xs text-gray-400">{{ $msgs->first()->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-sm text-gray-500 truncate">{{ $msgs->first()->content }}</p>
                            </div>
                        </a>
                    @empty
                        <div class="p-12 text-center text-gray-500">
                            <p>No messages yet. Start a conversation from the Experts or Appointments page!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>