<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //

    public function register(Request $request)
    {

        // 1. 
        // $data = $request->validate();
        // $user = User::create(
        //     [
        //         'name' => $request->input('name'),
        //         'email' => $request->input('email'),
        //         'password' => bcrypt($request->input('password'))
        //     ]
        // );

        // $token = $user->createToken('API TOKEN')->plainTextToken;

        // return response()->json([
        //     'user' => $user,
        //     'token' => $token
        // ], 201);

        // 2.
        try {
            $validateUser = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6'
            ]);

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation Error',
                    'errors' => $validateUser->errors()
                ], 400);
            }

            $user = User::create(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password)
                ]
            );

            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
                'token' => $user->createToken("API Token")->plainTextToken
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
    {
        // 1.
        // $data = $request->validate();

        // if (!Auth::attempt($data)) {
        //     return response()->json([
        //         'message' => 'Invalid credentials'
        //     ], 401);
        // }

        // $user = Auth::user();
        // $token = $user->createToken('API TOKEN')->plainTextToken;

        // return response()->json([
        //     'user' => $user,
        //     'token' => $token
        // ], 200);

        // 2.
        try {

            $validateUser = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string'
            ]);

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation Error',
                    'errors' => $validateUser->errors()
                ], 400);
            }

            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid credentials'
                ], 401);
            }

            // 1.1.
            // $user = Auth::user();
            // 1.2.
            $user = User::where('email', $request->email)->first();
            return response()->json([
                'message' => 'Login successful',
                'status' => 'success',
                'token' => $user->createToken('API Token')->plainTextToken
            ], 200);
        } catch (\Throwable $th) {

            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function profile()
    {
        $userData = auth()->user();

        return response()->json([
            'status' => true,
            'message' => 'User profile',
            'data' => $userData,
            'id' => auth()->user()->id
        ], 200);
    }

    // 1. 
    // public function logout(Request $request)
    // {
    //     $user = $request->user();
    //     $user->currentAccessToken()->delete();
    //     return response()->json([
    //         'message' => 'Logged out'
    //     ], 204);
    // }

    // 2.
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => true,
            'message' => 'Logged out',
            'data' => []
        ], 200);
    }
}
