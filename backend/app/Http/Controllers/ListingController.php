<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index()
    {
        $listings = Listing::all();
        return response()->json($listings);
    }

    public function show($id)
    {
        $listing = Listing::findOrFail($id);
        return response()->json($listing);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'residence_id' => 'required|exists:residences,id',
            'price' => 'required|string',
            'fix_deadline' => 'required|date',
            'issue_type' => 'required|in:water leakage,electrical,window repair,other',
            'description' => 'required|string',
        ]);

        $listing = Listing::create($validatedData);

        return response()->json($listing);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'residence_id' => 'required|exists:residences,id',
            'price' => 'required|string',
            'fix_deadline' => 'required|date',
            'issue_type' => 'required|in:water leakage,electrical,window repair,other',
            'description' => 'required|string',
        ]);

        $listing = Listing::findOrFail($id);
        $listing->update($validatedData);

        return response()->json($listing);
    }

    public function destroy($id)
    {
        $listing = Listing::findOrFail($id);
        $listing->delete();

        return response()->json(['message' => 'Listing deleted successfully']);
    }
}
