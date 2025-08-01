<?php

namespace App\Http\Controllers\Api;

use App\Enums\HttpStatusCode;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Helpers\HttpResponses;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create($data);
        $token = $user->createToken('api_token')->plainTextToken;

        return HttpResponses::success(['user' => $user, 'token' => $token],'registered',HttpStatusCode::Created);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['email'])->first();
        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return HttpResponses::error(null,'Invalid credentials',HttpStatusCode::AuthenticationFailure,HttpStatusCode::AuthenticationFailure);
        }

        $user->tokens()->delete();
        $token = $user->createToken('api_token')->plainTextToken;

        return HttpResponses::success(['user' => $user, 'token' => $token]);
    }

    public function profile(Request $request)
    {
        return HttpResponses::success([
            'user' => $request->user()->only(['id', 'name', 'email', 'email_verified_at', 'created_at', 'updated_at']),
            'wallet' => [
                'balance' => $request->user()->wallet->balance,
                'name' => $request->user()->wallet->name,
                'slug' => $request->user()->wallet->slug
            ],
            'goals' => $request->user()->goals()->count(),
            'store_items' => $request->user()->stores()->count(),
            'arias' => $request->user()->goals()
                ->join('challenges', 'goals.challenge_id', '=', 'challenges.id')
                ->distinct()
                ->count(DB::raw('challenges.area_id'))
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return HttpResponses::success(null, 'Logged out');
    }
}
