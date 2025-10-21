<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | SIP-KBI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'sipkbi-green': '#16a34a',
                        'sipkbi-dark': '#064e3b',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-8 h-8">
                    <span class="ml-2 text-xl font-bold text-sipkbi-green">SIP-KBI Admin</span>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700 dark:text-gray-300">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-bold mb-4">Dashboard Admin</h2>
                    <p>Selamat datang di panel admin, <strong>{{ auth()->user()->name }}</strong>!</p>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Role: <span class="font-semibold">{{ strtoupper(auth()->user()->role) }}</span></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
