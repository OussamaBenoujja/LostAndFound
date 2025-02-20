@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-10">
    <h1 class="text-2xl font-bold mb-6 text-gray-700">Create New Listing</h1>
    <form action="{{ route('listings.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block text-gray-600 font-medium">Title</label>
            <input type="text" name="title" class="w-full p-3 border border-gray-300 rounded-lg focus:ring focus:ring-blue-300" required>
        </div>

        <div>
            <label class="block text-gray-600 font-medium">Category</label>
            <select name="category_id" class="w-full p-3 border border-gray-300 rounded-lg focus:ring focus:ring-blue-300" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-gray-600 font-medium">Description</label>
            <textarea name="description" class="w-full p-3 border border-gray-300 rounded-lg focus:ring focus:ring-blue-300" rows="4" required></textarea>
        </div>

        <div>
            <label class="block text-gray-600 font-medium">Image</label>
            <input type="file" name="image" class="w-full p-3 border border-gray-300 rounded-lg">
        </div>

        <div>
            <label class="block text-gray-600 font-medium">Lost/Found Date</label>
            <input type="date" name="lost_found_date" class="w-full p-3 border border-gray-300 rounded-lg focus:ring focus:ring-blue-300" required>
        </div>

        <div>
            <label class="block text-gray-600 font-medium">Location</label>
            <input type="text" name="location" class="w-full p-3 border border-gray-300 rounded-lg focus:ring focus:ring-blue-300" required>
        </div>

        <div>
            <label class="block text-gray-600 font-medium">Contact Email</label>
            <input type="email" name="contact_email" class="w-full p-3 border border-gray-300 rounded-lg focus:ring focus:ring-blue-300" required>
        </div>

        <div>
            <label class="block text-gray-600 font-medium">Contact Phone</label>
            <input type="text" name="contact_phone" class="w-full p-3 border border-gray-300 rounded-lg focus:ring focus:ring-blue-300" required>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white p-3 rounded-lg hover:bg-blue-700 transition duration-200">
            Create Listing
        </button>
    </form>
</div>
@endsection
