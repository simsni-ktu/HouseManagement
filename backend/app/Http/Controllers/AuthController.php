<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {


        // Validate the request data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $user->assignRole('User');

        return response()->json($user, 201);
    }

    public function login(Request $request)
    {
        $requestData = $request->only(['name', 'password']);

        $data = [
            'grant_type' => 'password',
            'client_id' => config('oauth.client_id'),
            'client_secret' => config('oauth.client_secret'),
            'username' => $requestData['name'],
            'password' => $requestData['password'],
            'scope' => '*',
        ];

        $request = app('request')->create('/oauth/token', 'POST', $data);
        $response = app('router')->prepareResponse($request, app()->handle($request));

        if ($response->getStatusCode() == 200) {
            //$user = Auth::user();
            //$role = $user->getRoleNames()->first();
            $role = "User";
            $responseData = json_decode($response->getContent(), true);
            $responseData['user_role'] = $role;
            return response()->json($responseData);
        } else {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh(Request $request)
    {

        $refreshToken = $request->input('refresh_token');

        $data = [
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
            'client_id' => config('oauth.client_id'),
            'client_secret' => config('oauth.client_secret'),
            'scope' => '*',
        ];

        $request = app('request')->create('/oauth/token/', 'POST', $data);
        $response = app('router')->prepareResponse($request, app()->handle($request));

        if ($response->getStatusCode() == 200) {
            return $response;
        } else {
            return response()->json(['error' => 'Invalid refresh token!'], 401);
        }
    }
}
