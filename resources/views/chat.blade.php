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
</body>
</html>
