<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Listing;
use App\Models\Residence;
use Illuminate\Http\Request;

class ResidenceListingCommentController extends Controller
{
    public function index(Residence $residence, Listing $listing)
    {
        if($listing->residence_id != $residence->id){
            return response()->json(['error' => 'Bad request'], 400);
        }
        return response()->json($listing->comments()->get());
    }

    public function show(Residence $residence, Listing $listing, Comment $comment)
    {

        return response()->json($comment);
    }

    public function store(Request $request, Residence $residence, Listing $listing)
    {
        $validatedData = $request->validate([
            'listing_id' => 'prohibited',
            'user_id' => 'required|exists:users,id',
            'comment_text' => 'required|string',
        ]);

        $validatedData['listing_id'] = $listing->id;

        $comment = Comment::create($validatedData);

        return response()->json($comment, 201);
    }

    public function update(Request $request,  Residence $residence, Listing $listing, Comment $comment)
    {
        $validatedData = $request->validate([
            'listing_id' => 'prohibited',
            'user_id' => 'required|exists:users,id',
            'comment_text' => 'required|string',
        ]);

        $validatedData['listing_id'] = $listing->id;

        $comment->update($validatedData);

        return response()->json($comment);
    }

    public function destroy(Residence $residence, Listing $listing, Comment $comment)
    {
        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully']);
    }
}
