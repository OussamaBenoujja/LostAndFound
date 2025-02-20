<!DOCTYPE html>
<html lang="en">
<head>
    <title>LostAndFound</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>
<body class="flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="bg-gray-800 p-4">
        <div class="container mx-auto flex items-center justify-between">
            <!-- Logo and Site Name -->
            <div class="flex items-center space-x-4">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10">
                </a>
                <span class="text-white text-xl font-bold">LostAndFound</span>
            </div>
            <!-- Navigation Links -->
            <div class="space-x-4">
                <a href="{{ route('profile') }}" class="text-white hover:text-gray-300">Profile</a>
                <a href="{{ route('listings.index') }}" class="text-white hover:text-gray-300">Listings</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto mt-4 flex-grow">
        @yield('content')
    </div>

    <!-- Footer with Statistics -->
    <footer class="bg-gray-900 text-white text-center p-4 mt-10">
        <div class="container mx-auto">
            <p class="text-lg font-semibold">Application Stats</p>
            <div class="flex justify-center space-x-6 mt-2">
                <div class="p-2 bg-gray-800 rounded-lg shadow-lg">
                    <p class="text-xl font-bold">{{ $totalListings }}</p>
                    <p class="text-sm">Total Listings</p>
                </div>
                <div class="p-2 bg-gray-800 rounded-lg shadow-lg">
                    <p class="text-xl font-bold">{{ $totalFoundItems }}</p>
                    <p class="text-sm">Items Found</p>
                </div>
            </div>
            <p class="mt-3 text-gray-400">&copy; {{ date('Y') }} LostAndFound. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
