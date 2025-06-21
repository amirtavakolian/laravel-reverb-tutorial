<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Global Chat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
<div class="min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold text-gray-900">Global Chat</h1>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Messages Container -->
            <div id="messages" class="h-[600px] overflow-y-auto p-4 space-y-4">
                <!-- Messages will be dynamically inserted here -->
            </div>

            <!-- Message Input Form -->
            <div class="border-t border-gray-200 p-4">
                <form id="message-form" class="flex space-x-4">
                    <input type="text"
                           id="message-input"
                           class="flex-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           placeholder="Type your message..."
                           required>
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Send
                    </button>
                </form>
            </div>
        </div>
    </main>
</div>

<script defer>
    window.addEventListener('load', function () {

        const messagesContainer = document.getElementById('messages');
        const messageForm = document.getElementById('message-form');
        const messageInput = document.getElementById('message-input');

        //  🔴 2-
        // now we want to connect to that private channel
        // let channel = window.Echo.private('users.2');

        let channel = window.Echo.private('users.{{ auth()->user()->id }}');

        // if the current authenticated user's id is 1
        // so he/she can connect to this channel

        /*
        what echo does to connect to a channel?
        when we open a veiw which contains echo codes,
        it sends a request to broadcasting/auth route
        with the channel name in payload of that request :D
        =>
        this route (broadcasting/auth) maps the channel_name in the
        post request's payload, to the channel we want to connect

        public function broadcastOn(): array
        {
            return [
            new PrivateChannel('users.{id}'),
            ];
        }

        then it runs the clouser which is defined in channels.php file
        for authorizing and returns true or false

        if it returns true, user get connected - subscribed to that channel
        and now he/she can braodcast to that channel 😂

        */

        channel.listen('.App\\Events\\Chat\\DirectSent', (e) => {
            console.log(e);
            const messageDiv = document.createElement('div');
            messageDiv.className = 'flex items-start space-x-3';
            messageDiv.innerHTML = `
                    <div class="flex-1 bg-gray-100 rounded-lg px-4 py-2">
                        <div class="font-medium text-gray-900">${e.username || 'Anonymous'}</div>
                        <div class="text-gray-700">${e.message}</div>
                        <div class="text-xs text-gray-500">${new Date().toLocaleTimeString()}</div>
                    </div>
                `;
            messagesContainer.appendChild(messageDiv);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        });

        // Handle form submission
        messageForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const message = messageInput.value.trim();

            if (!message) return;

            try {
                const response = await fetch('/chat/send', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({message})
                });

                if (response.ok) {
                    messageInput.value = '';
                }
            } catch (error) {
                console.error('Error sending message:', error);
            }
        });
    });
</script>
</body>
</html>


