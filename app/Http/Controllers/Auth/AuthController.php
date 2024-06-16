<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|'
        ]);

        $user_exist = User::where('email', $request->email)->first();
        if ($user_exist) {
            return response()->json([
                'message'   => 'User already exists',
                'success'    => false,
            ]);
        }

        $password = Hash::make($request->password);
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => $password,
        ]);

        return response()->json([
            'message'   => 'New user registered successfully',
            'success'    => true,
        ]);
    }

    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required|string|email|max:255',
            'password'  => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Incorrect username or password'
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'       => 'Login successfully',
            'access_token'  => $token,
            'token_type'    => 'Bearer',
            'user' => $user
        ]);
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $permissions = $user->getAllPermissions();
        $roles = $user->getRoleNames();
        return response()->json([
            'message' => 'Login successful',
            'data' => $user,
        ]);
    }
}
