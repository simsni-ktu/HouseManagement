<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Residence;
use Illuminate\Http\Request;

class ResidenceListingController extends Controller
{

    public function index(Residence $residence)
    {
        return response()->json($residence->listings()->get());
    }

    public function show(Residence $residence, Listing $listing)
    {
        if ($listing->residence_id !== $residence->id) {
            return response()->json(['error' => 'Listing does not belong to the specified residence'], 404);
        }

        return response()->json($listing);
    }

    public function store(Residence $residence, Request $request)
    {
        $validatedData = $request->validate([
            'residence_id' => 'prohibited',
            'price' => 'required|string',
            'fix_deadline' => 'required|date',
            'issue_type' => 'required|in:water leakage,electrical,window repair,other',
            'description' => 'required|string',
        ]);
        $validatedData['residence_id'] = $residence->id;

        return response()->json(Listing::create($validatedData), 201);
    }

    public function update(Request $request,Residence $residence, Listing $listing)
    {
        $validatedData = $request->validate([
            'residence_id' => 'prohibited',
            'price' => 'required|string',
            'fix_deadline' => 'required|date',
            'issue_type' => 'required|in:water leakage,electrical,window repair,other',
            'description' => 'required|string',
        ]);

        $validatedData['residence_id'] = $residence->id;

        $listing->update($validatedData);

        return response()->json($listing);
    }

    public function destroy(Residence $residence, Listing $listing)
    {
        $listing->delete();

        return response()->json(['message' => 'Listing deleted successfully']);
    }
}
