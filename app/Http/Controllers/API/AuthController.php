<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\UserRepositoryInterface;

class AuthController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(RegisterRequest $request)
    {
        // Create a new user
        $user = $this->userRepository->create($request->all());
        return response()->json($user, 201);
    }
   
    public function login(LoginRequest $request)
    {
        // Attempt to authenticate the user
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = Auth::user();
            // Create a token for the authenticated user
            $token = $user->createToken('task')->plainTextToken;

            return response()->json(['user' => $user, 'token' => $token], 200);
        }

        // Return an error response if authentication fails
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout()
    {
        // Revoke the user's token
        Auth::user()->tokens()->delete();
        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}
