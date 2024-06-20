<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\alert;

class AuthController extends Controller
{
    //

    public function login(LoginRequest $request)
    {
        $data = $request->validate();

        if (!Auth::attempt($data)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $user = Auth::user();
        $token = $user->creatToken('main')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }


    public function register(RegisterRequest $request)
    {
        echo  $request;
        alert("Hello World");

        $data = $request->validate(
            [
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:6'
            ]
        );

        $user = User::create(
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password'])
            ]
        );

        $token = $user->createToken('main')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }


    public function logout(Request $request)
    {
        $user = $request->user();

        $user->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out'
        ], 204);
    }
}
