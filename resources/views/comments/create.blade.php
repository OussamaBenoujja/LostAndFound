@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Category</h1>
    <form action="{{ route('comments.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Comments</label>
            <input type="number" class="form-control" id="user_id" name="user_id" required>
            <input type="number" class="form-control" id="listing_id" name="listing_id" required>
            <input type="text" class="form-control" id="content" name="content" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mt-3">Create Comment</button>
    </form>
</div>
@endsection