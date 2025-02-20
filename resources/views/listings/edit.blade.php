@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Listing</h1>
    <form action="{{ route('listings.update', $listing->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Repeat similar fields as create.blade.php with existing values -->
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $listing->title }}" required>
        </div>

        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $listing->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Add other fields with existing values -->
        @if($listing->image)
            <div class="mb-3">
                <img src="{{ asset('storage/'.$listing->image) }}" alt="Listing Image" style="max-width: 200px;">
            </div>
        @endif

        <button type="submit" class="btn btn-primary">Update Listing</button>
    </form>
</div>
@endsection