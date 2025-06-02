<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Broadcast Test</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="p-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-2xl font-bold">Broadcast Test Page</h1>
                <div class="flex items-center space-x-4">
                    @auth
                        <span class="text-gray-600">Welcome, {{ Auth::user()->name }}</span>
                        <form method="GET" action="{{ route('logout') }}" class="inline">
                            <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Login
                        </a>
                    @endauth
                </div>
            </div>

            @auth
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <p>Logged in as: <strong>{{ Auth::user()->email }}</strong></p>
                    <p>User ID: {{ Auth::id() }}</p>
                </div>
            @else
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
                    <p>You are not logged in. No login required for public channels.</p>
                    <p class="text-sm mt-2">Note: If you want to access private channels, you'll need to login first.</p>
                </div>
            @endauth

            <p class="mb-4">Visit <a href="/broadcast" class="text-blue-500 hover:underline">/broadcast</a> to trigger an event</p>


            <div id="messages" class="mt-4 p-4 bg-gray-100 rounded">
                <p>Messages will appear here and in the console...</p>
            </div>
        </div>
    </div>
</body>
</html>
