<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request){

        // cek email di database
        $user = User::where('email', $request->email)->first();

        // mengecek password
        // jika passowrs tidak sesuai
        if (!$user || !\Hash::check($request->password, $user->password)) {
            // return response()->json([
            //     'message' => 'Password Salah'
            // ], 401);
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // jika berhasil
        $token = $user->createToken('token-name')->plainTextToken;
        return response()->json([
            'message' => 'Success',
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    public function logout(Request $request){
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout Success'
        ],200);
    }
}
