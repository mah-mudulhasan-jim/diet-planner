<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('messages.index') }}" class="text-gray-400 hover:text-indigo-600">&larr; Back</a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Chat with {{ $user->name }}</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-2xl flex flex-col h-[600px]">
                
                <div class="flex-grow p-6 overflow-y-auto space-y-4 bg-slate-50/50">
                    @foreach($messages as $message)
                        <div class="flex {{ $message->sender_id === Auth::id() ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-[75%] px-4 py-2 rounded-2xl text-sm shadow-sm
                                {{ $message->sender_id === Auth::id() ? 'bg-indigo-600 text-white rounded-tr-none' : 'bg-white text-gray-800 border border-gray-100 rounded-tl-none' }}">
                                {{ $message->content }}
                                <div class="text-[10px] mt-1 opacity-70 text-right">
                                    {{ $message->created_at->format('h:i A') }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="p-4 border-t border-gray-100">
                    <form action="{{ route('messages.store', $user->id) }}" method="POST" class="flex gap-4">
                        @csrf
                        <input type="text" name="content" required placeholder="Type your message..." 
                            class="flex-grow border-gray-200 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-xl font-bold hover:bg-indigo-700 transition-colors">
                            Send
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>