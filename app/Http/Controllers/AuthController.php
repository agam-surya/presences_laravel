<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        // check if user exist and valid
        if (!$user || !Hash::check($request->password, $user->password)) {
            return \response()->json([
                'message' => 'unauthorized',
                'request' => $request->password,
                'user' => $user->password,
            ], 401);
        }
        $token = $user->createToken('token-name')->plainTextToken;

        return response()->json([
            'message' => 'success',
            'user' => $token,
        ], 200);
    }
}
