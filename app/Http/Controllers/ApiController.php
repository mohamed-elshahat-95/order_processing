<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function register(Request $request)
    {
        $rules = array(
            'email' => 'required|email',
            'password' => 'required',
            'name' => 'required'
        );

        $message = array(
            'email.required' => "Sorry Email Required",
            'email.email' => "Sorry please check email format",
            'password.required' => "Sorry Password Required",
            'name.required' => "Sorry name Required"
        );

        $validate = Validator::make($request->all(), $rules,$message);

        if($validate->fails()){
            return response()->json([
                'message' => $validate->messages()->first()
            ], 400);
        }

        $user = new User;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->name = $request->name;
        $user->save();

        return response()->json([
            'status' => true,
            'msg' => 'You register done successfully, now you can use login route to get the token.'
        ]);
    }

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
}
