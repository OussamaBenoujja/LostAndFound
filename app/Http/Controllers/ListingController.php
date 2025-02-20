<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ListingController extends Controller
{
    public function index(Request $request)
    {
        $query = Listing::with('category');
    
        
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }
    
        
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
    
        $listings = $query->latest()->paginate(10);
        $categories = Category::all();
    
        return view('listings.index', compact('listings', 'categories'));
    }
    


    public function show($id)
    {
        $listing = Listing::with('comments')->findOrFail($id);
        return view('listings.show', compact('listing'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('listings.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'lost_found_date' => 'required|date',
            'location' => 'required',
            'contact_email' => 'required|email',
            'contact_phone' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('listings', 'public');
        }

        Listing::create($validated + ['user_id' => auth()->id()]);

        return redirect()->route('listings.index')->with('success', 'Listing created!');
    }

    public function edit(Listing $listing)
    {
        $categories = Category::all();
        return view('listings.edit', compact('listing', 'categories'));
    }

    public function update(Request $request, Listing $listing)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'lost_found_date' => 'required|date',
            'location' => 'required',
            'contact_email' => 'required|email',
            'contact_phone' => 'required',
        ]);

        if ($request->hasFile('image')) {
            if ($listing->image) {
                Storage::disk('public')->delete($listing->image);
            }
            $validated['image'] = $request->file('image')->store('listings', 'public');
        }

        $listing->update($validated);

        return redirect()->route('listings.index')->with('success', 'Listing updated!');
    }

    public function destroy(Listing $listing)
    {
        if ($listing->image) {
            Storage::disk('public')->delete($listing->image);
        }
        $listing->delete();
        return redirect()->route('listings.index')->with('success', 'Listing deleted!');
    }



public function lost(\App\Models\Listing $listing)
{
    // Mark the listing as lost or perform any other action
    // For example:
    $listing->update(['is_found' => false]);
    return back()->with('success', 'Listing marked as lost!');
}

public function found(\App\Models\Listing $listing)
{
    $listing->update([
        'is_found' => true,
        'found_by' => auth()->id(),
    ]);

    return back()->with('success', 'Listing marked as found!');
}



}