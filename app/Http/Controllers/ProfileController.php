<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        
        $listings = $user->listings()->latest()->get();

        return view('profile.edit', compact('user', 'listings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        auth()->user()->update($data);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function show()
    {
        $user = auth()->user();
        $listings = $user->listings()->latest()->get();

        return view('profile.edit', compact('user', 'listings'));
    }
}
