<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'status' => false,
                'msg' => 'Credentials are missing or not valid!'
            ]);
        }

        $user = Auth::user();
        $token = $user->createToken('token');
        return ['token' => $token->plainTextToken];
    }

    public function getUsers()
    {
        return response()->json([
            'data' => User::all()
        ]);
    } 
}
