<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }

        $user = new User();

        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $token = $user->createToken('api_token')->plainTextToken;

        return ['api_token' => $token];
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails() || !Auth::attempt($request->toArray())) {
            return response()->json(['error' => 'Invalid credentials. Please try again.'])->setStatusCode(401);
        }

        return response()->json(['api_token' => $request->user()->createToken('api_token')->plainTextToken]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

        return [
            'message' => 'tokens_removed'
        ];
    }
}
