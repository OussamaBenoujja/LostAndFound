@extends('layouts.app')
@section('content')
<script src="https://unpkg.com/@tailwindcss/browser@4"></script>
<!-- Display listing details -->
<div class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-8">
    <img src="{{ asset('storage/' . $listing->image) }}" class="w-full h-64 object-cover rounded-lg">
    
    <h1 class="text-3xl font-bold text-gray-900 mt-4">{{ $listing->title }}</h1>
    <p class="text-gray-700 mt-2">{{ $listing->description }}</p>

    <div class="mt-4">
        <span class="text-gray-600">📍 {{ $listing->location }}</span>
        <span class="text-gray-600 block">📅 {{ $listing->lost_found_date->format('F j, Y') }}</span>
    </div>

    <div class="mt-4">
        <a href="mailto:{{ $listing->contact_email }}" class="text-blue-500 hover:underline">📧 {{ $listing->contact_email }}</a>
        <p class="text-gray-600">📞 {{ $listing->contact_phone }}</p>
    </div>
</div>

<!-- Comments Section -->
<div class="max-w-3xl mx-auto mt-8 p-6 bg-white shadow-lg rounded-lg">
    <h3 class="text-xl font-semibold text-gray-900 mb-4">💬 Comments ({{ $listing->comments->count() }})</h3>

    @foreach($listing->comments as $comment)
        <div class="p-4 bg-gray-100 rounded-lg mb-3">
            <p class="text-gray-800">{{ $comment->content }}</p>
            <small class="text-gray-500">
                Posted {{ $comment->created_at->diffForHumans() }}
                @if($comment->user)
                    by <strong>{{ $comment->user->name }}</strong>
                @endif
            </small>

            <!-- Delete Button -->
            @if(auth()->check() && auth()->user()->id == $comment->user_id)
                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="inline-block ml-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:underline text-sm">Delete</button>
                </form>
            @endif
        </div>
    @endforeach

    <!-- Comment Submission Form -->
    <form action="{{ route('comments.store') }}" method="POST" class="mt-4">
        @csrf
        <input type="hidden" name="listing_id" value="{{ $listing->id }}">
        <textarea name="content" rows="3" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Write a comment..."></textarea>
        <button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">Post Comment</button>
    </form>
</div>
@endsection
