@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6">My Profile</h1>

    <!-- Profile Update Form -->
    <div class="mb-8 bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Update Profile</h2>
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Username:</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="w-full p-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email:</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full p-2 border rounded">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Update Profile
            </button>
        </form>
    </div>

    <!-- Announcements Section -->
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">My Announcements</h2>
        @if($listings->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($listings as $listing)
                    <div class="border rounded-lg p-4">
                        <img src="{{ asset('storage/' . $listing->image) }}" alt="{{ $listing->title }}" class="w-full h-40 object-cover rounded mb-4">
                        <h3 class="text-lg font-bold">{{ $listing->title }}</h3>
                        <p class="text-gray-600">{{ $listing->description }}</p>
                        <p class="text-sm text-gray-500">Location: {{ $listing->location }}</p>
                        <p class="text-sm text-gray-500">Date: {{ $listing->lost_found_date->format('M d, Y') }}</p>
                        <div class="mt-2">
                        @if($listing->is_found)
                            <span class="text-green-600 font-semibold">Item Found</span>
                            @if($listing->foundUser)
                                <p class="text-sm text-gray-500">
                                    Marked as found by: {{ $listing->foundUser->name }} ({{ $listing->foundUser->email }})
                                </p>
                            @endif
                        @endif
                    </div>
                        <div class="mt-4 text-sm text-gray-500">
                            <p>Posted by: {{ $user->name }}</p>
                            <p>Email: {{ $user->email }}</p>
                        </div>
                        <!-- Delete Announcement Button -->
                        <div class="mt-4">
                            <form action="{{ route('listings.destroy', $listing->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this announcement?')" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                    Delete Announcement
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>No announcements found.</p>
        @endif
    </div>
</div>
@endsection
