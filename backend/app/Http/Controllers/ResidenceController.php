<?php

namespace App\Http\Controllers;

use App\Models\Residence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResidenceController extends Controller
{
    public function index()
    {

//        if (Auth::user()->can('users_delete')) {
            $residences = Residence::all();
            return response()->json($residences);
//        } else {
//            return response()->json(['message' => 'Permission denied'], 401);
//        }

    }

    public function show(Residence $residence)
    {
        return response()->json($residence);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'city' => 'required|string',
            'street' => 'required|string',
            'rooms_number' => 'required|string',
            'square_meters' => 'required|string',
            'description' => 'required|string',
        ]);

        $residence = Residence::create($validatedData);

        return response()->json($residence, 201);
    }

    public function update(Request $request, Residence $residence)
    {
        $validatedData = $request->validate([
            'city' => 'required|string',
            'street' => 'required|string',
            'rooms_number' => 'required|string',
            'square_meters' => 'required|string',
            'description' => 'required|string',
        ]);

        $residence->update($validatedData);

        return response()->json($residence);
    }

    public function destroy(Residence $residence)
    {
        $residence->delete();

        return response()->json(['message' => 'Residence deleted successfully']);
    }

}
