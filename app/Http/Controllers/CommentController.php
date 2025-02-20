<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return view('comments.index', compact('comments'));
    }

    public function create()
    {
        return view('comments.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'content'    => 'required|string|max:255',
            'listing_id' => 'required|exists:listings,id',
        ]);
    
        $data['user_id'] = auth()->id();
    
        \App\Models\Comment::create($data);
    
        return redirect()->route('listings.show', $data['listing_id'])
                     ->with('success', 'Comment created successfully.');

        
    }
    
    

    public function edit(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment->update($request->all());
        return redirect()->route('comments.index')->with('success', 'comment updated successfully.');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}
