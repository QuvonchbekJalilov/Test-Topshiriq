<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('phone_number', $request->phone_number)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'phone_number' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->currentAccessToken() ? $user->currentAccessToken() :  $user->createToken('auth_token',['*'], now()->addHours(24));

        return response()->json(['token' => $token->plainTextToken]);
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'phone_number' => $validated['phone_number'],
            'password' => Hash::make($validated['password']),
        ]);

        $token = $user->createToken('auth_token', ['*'], now()->addHours(24));

        return response()->json(['token' => $token->plainTextToken]);
    }
    
    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'User logged out successfully']);
    }
}
