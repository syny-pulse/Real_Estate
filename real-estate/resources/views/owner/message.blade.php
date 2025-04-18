@extends('layouts.owner')

@section('content')
    <main class="flex flex-col lg:flex-row min-h-screen bg-gray-50">
        @include('owner.partials.sidebar')

        <div class="flex-1 md:ml-64">
            <div class="max-w-6xl mx-auto p-6">
                <h1 class="text-3xl font-bold text-blue-900 mb-6">Messages</h1>

                @if (session('success'))
                    <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-800 p-4 mb-6" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="flex flex-col md:flex-row">
                        <!-- Conversations Sidebar -->
                        <div class="w-full md:w-1/3 border-r border-gray-200">
                            <div class="p-4 border-b border-gray-200 bg-gray-50">
                                <div class="flex justify-between items-center">
                                    <h2 class="text-lg font-semibold text-blue-800">Conversations</h2>
                                    <button id="new-message-btn"
                                        class="text-sm bg-blue-800 text-white px-3 py-1 rounded hover:bg-blue-900">
                                        <i class="fas fa-plus mr-1"></i> New
                                    </button>
                                </div>

                                <!-- Filters -->
                                <div class="mt-3 flex space-x-2">
                                    <a href="{{ route('messages.index') }}"
                                        class="text-sm px-3 py-1 rounded {{ request()->routeIs('owner.messages.index') && !request('filter') ? 'bg-blue-800 text-white' : 'bg-gray-200 hover:bg-gray-300' }}">
                                        All
                                    </a>
                                    <a href="{{ route('messages.index', ['filter' => 'sent']) }}"
                                        class="text-sm px-3 py-1 rounded {{ request('filter') == 'sent' ? 'bg-blue-800 text-white' : 'bg-gray-200 hover:bg-gray-300' }}">
                                        Sent
                                    </a>
                                    <a href="{{ route('messages.index', ['filter' => 'received']) }}"
                                        class="text-sm px-3 py-1 rounded {{ request('filter') == 'received' ? 'bg-blue-800 text-white' : 'bg-gray-200 hover:bg-gray-300' }}">
                                        Received
                                    </a>
                                </div>
                            </div>

                            <div class="divide-y divide-gray-200 max-h-screen overflow-y-auto">
                                @forelse($conversations as $conversation)
                                    <a href="{{ route('messages.show', $conversation['user']->id) }}"
                                        class="block p-4 hover:bg-gray-50 {{ $selectedUserId == $conversation['user']->id ? 'bg-blue-50' : '' }}">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 rounded-full bg-blue-200 flex items-center justify-center text-blue-800 font-bold">
                                                {{ substr($conversation['user']->name, 0, 1) }}
                                            </div>
                                            <div class="ml-3 flex-1">
                                                <div class="flex justify-between items-start">
                                                    <p class="font-medium text-gray-900 truncate">
                                                        {{ $conversation['user']->name }}</p>
                                                    <span class="text-xs text-gray-500">
                                                        @if ($conversation['last_message'] && $conversation['last_message']->created_at)
                                                            {{ $conversation['last_message']->created_at->diffForHumans() }}
                                                        @else
                                                            No messages yet
                                                        @endif
                                                    </span>
                                                </div>
                                                <p class="text-sm text-gray-600 truncate">
                                                    @if ($conversation['last_message'])
                                                        {{ $conversation['last_message']->content }}
                                                    @else
                                                        No messages yet
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="p-6 text-center text-gray-500">
                                        <p>No conversations found</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Message Content -->
                        <div class="w-full md:w-2/3 flex flex-col h-screen">
                            @if (isset($selectedUserId))
                                <div class="p-4 border-b border-gray-200 bg-gray-50">
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 rounded-full bg-blue-200 flex items-center justify-center text-blue-800 font-bold">
                                            {{ substr($selectedUser->name, 0, 1) }}
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="font-medium text-gray-900">{{ $selectedUser->name }}</h3>
                                            <p class="text-sm text-gray-500">
                                                {{ ucfirst($selectedUser->role ?? 'User') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-1 overflow-y-auto p-4 space-y-4" id="messages-container">
                                    @foreach ($messages as $message)
                                        <div
                                            class="flex {{ $message->sender_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                                            <div
                                                class="{{ $message->sender_id == auth()->id() ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }} rounded-lg p-3 max-w-3/4">
                                                @if ($message->property_id)
                                                    <div class="mb-1 p-2 bg-white rounded border border-gray-200">
                                                        <p class="text-xs text-gray-500">Property:
                                                            {{ $message->property->title }}</p>
                                                    </div>
                                                @endif
                                                @if ($message->subject)
                                                    <p class="font-medium">{{ $message->subject }}</p>
                                                @endif
                                                <p class="text-sm whitespace-pre-wrap">{{ $message->content }}</p>
                                                <p class="text-xs text-gray-500 text-right mt-1">
                                                    {{ $message->created_at ? $message->created_at->format('M d, Y h:i A') : 'N/A' }}
                                                </p>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="p-4 border-t border-gray-200">
                                    <form action="{{ route('messages.reply', $selectedUserId) }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <select name="property_id"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <option value="">No property reference</option>
                                                @foreach ($properties as $property)
                                                    <option value="{{ $property->id }}">{{ $property->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" name="subject" placeholder="Subject (optional)"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        </div>
                                        <div class="mb-3">
                                            <textarea name="content" rows="3" placeholder="Type your message here..."
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                required></textarea>
                                        </div>
                                        <div class="flex justify-end">
                                            <button type="submit"
                                                class="bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-900">
                                                <i class="fas fa-paper-plane mr-1"></i> Send
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @else
                                <div class="flex-1 flex items-center justify-center text-gray-500">
                                    <div class="text-center p-6">
                                        <i class="fas fa-comments text-5xl mb-3"></i>
                                        <p>Select a conversation or start a new message</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- New Message Modal -->
    <div id="new-message-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg p-6 max-w-lg w-full mx-auto">
            <h3 class="text-xl font-bold text-blue-900 mb-4">New Message</h3>
            <form action="{{ route('messages.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 mb-1">Recipient</label>
                    <input type="email" id="email" name="email" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="property_id" class="block text-gray-700 mb-1">Related Property</label>
                    <select id="property_id" name="property_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">No property reference</option>
                        @foreach ($properties as $property)
                            <option value="{{ $property->id }}">{{ $property->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="subject" class="block text-gray-700 mb-1">Subject (Optional)</label>
                    <input type="text" id="subject" name="subject"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="content" class="block text-gray-700 mb-1">Message</label>
                    <textarea id="content" name="content" rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required></textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-900">
                        <i class="fas fa-paper-plane mr-1"></i> Send
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Toggle Script -->
    <script>
        document.getElementById('new-message-btn').addEventListener('click', () => {
            document.getElementById('new-message-modal').classList.remove('hidden');
        });

        window.addEventListener('click', (e) => {
            if (e.target.id === 'new-message-modal') {
                document.getElementById('new-message-modal').classList.add('hidden');
            }
        });
    </script>
@endsection
