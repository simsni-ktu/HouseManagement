<?php

namespace App\Http\Controllers;

use App\Models\Residence;
use Illuminate\Http\Request;

class ResidenceController extends Controller
{
    public function index()
    {
        $residences = Residence::all();
        return response()->json($residences);
    }

    public function show($id)
    {
        $residence = Residence::findOrFail($id);
        return response()->json($residence);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'city' => 'required|string',
            'street' => 'required|string',
            'rooms_number' => 'required|string',
            'square_meters' => 'required|string',
            'description' => 'required|string',
        ]);

        $residence = Residence::create($validatedData);

        return response()->json($residence);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'city' => 'required|string',
            'street' => 'required|string',
            'rooms_number' => 'required|string',
            'square_meters' => 'required|string',
            'description' => 'required|string',
        ]);

        $residence = Residence::findOrFail($id);
        $residence->update($validatedData);

        return response()->json($residence);
    }

    public function destroy($id)
    {
        $residence = Residence::findOrFail($id);
        $residence->delete();

        return response()->json(['message' => 'Residence deleted successfully']);
    }

}
