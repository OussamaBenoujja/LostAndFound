@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Comments</h1>
    <a href="{{ route('comments.create') }}" class="btn btn-primary mb-3">Create New Comment</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>postID</th>
                <th>userID</th>
                <th>Content</th>
            </tr>
        </thead>
        <tbody>
            @foreach($comments as $comment)
            <tr>
                <td>{{ $comment->listing_id }}</td>
                <td>{{ $comment->user_id }}</td>
                <td>{{ $comment->content }}</td>
                <td>
                    <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection