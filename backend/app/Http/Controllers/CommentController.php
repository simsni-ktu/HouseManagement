<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return response()->json($comments);
    }

    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        return response()->json($comment);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'listing_id' => 'required|exists:listings,id',
            'user_id' => 'required|exists:users,id',
            'comment_text' => 'required|string',
        ]);

        $comment = Comment::create($validatedData);

        return response()->json($comment);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'listing_id' => 'required|exists:listings,id',
            'user_id' => 'required|exists:users,id',
            'comment_text' => 'required|string',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update($validatedData);

        return response()->json($comment);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully']);
    }
}
