<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UnauthenticatedAccessMiddleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        if (!Auth::check()) {
            // Allow access only to specific routes for unauthenticated users
            $allowedRoutes = [
                'residences.index',
                'residences.show',
                'residences.listings.index',
                'residences.listings.show',
                'residences.listings.comments.index',
                'residences.listings.comments.show',
            ];

            if (!in_array($request->route()->getName(), $allowedRoutes)) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
        } elseif (Auth::user()->hasRole('user')) {
            // Check if the route is a delete route for residence listings comments
            if ($request->route()->getName() === 'residences.listings.comments.destroy') {
                // Check if the authenticated user is the owner of the residence listing comment
                $commentId = $request->route('residences_listing_comment');
                $comment = \App\Models\ResidenceListingComment::find($commentId);

                if (!$comment || $comment->user_id !== Auth::user()->id) {
                    return response()->json(['error' => 'Unauthorized'], 403);
                }
            }

            // Add a check for deleting residences
            if ($request->route()->getName() === 'residences.destroy') {
                $residenceId = $request->route('residence');
                $residence = \App\Models\Residence::find($residenceId);

                // Check if the authenticated user is the owner of the residence
                if (!$residence || $residence->user_id !== Auth::user()->id) {
                    return response()->json(['error' => 'Unauthorized'], 403);
                }
            }
        }

        return $next($request);
    }
}
