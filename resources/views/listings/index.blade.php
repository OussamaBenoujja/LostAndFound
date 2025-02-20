@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Listings</h1>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 mb-4 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Create Listing Button -->
    <div class="mb-6">
        <a href="{{ route('listings.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            + Create New Listing
        </a>
    </div>
<!-- Search and Filter Form -->
<form method="GET" action="{{ route('listings.index') }}" class="mb-6 flex gap-4">
    <input 
        type="text" 
        name="search" 
        placeholder="Search listings..." 
        value="{{ request('search') }}" 
        class="p-2 border rounded-lg w-full"
    >

    <select name="category_id" class="p-2 border rounded-lg">
        <option value="">All Categories</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
        Filter
    </button>
</form>

    <!-- Listings Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($listings as $listing)
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="{{ asset('storage/' . $listing->image) }}" alt="{{ $listing->title }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <a href='/listings/{{ $listing->id }}'>
                    <h2 class="text-xl font-semibold text-gray-800">{{ $listing->title }}</h2>
                    </a>
                    <p class="text-gray-600 mt-2">{{ $listing->description }}</p>
                    <p class="text-gray-500 mt-1 text-sm">
                        Posted by: {{ $listing->user->name ?? 'Unknown' }}
                    </p>
                    <p class="text-gray-500 mt-1 text-sm">
                        Date: {{ $listing->lost_found_date->format('M d, Y') }}
                    </p>
                    <div class="mt-4 flex space-x-2">
                        <a href="{{ route('listings.found', $listing->id) }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                            Found It
                        </a>
                        <a href="{{ route('listings.lost', $listing->id) }}" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                            Lost It
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $listings->links() }}
    </div>
</div>
@endsection
