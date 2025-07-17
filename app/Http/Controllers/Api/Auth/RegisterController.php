<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed', // gunakan password_confirmation di input
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Registrasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Simpan user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // hashing manual
        ]);

        // Buat token
        $token = $user->createToken('Token Register')->accessToken;

        return response()->json([
            'status' => true,
            'message' => 'Registrasi berhasil',
            'token' => $token,
            'user' => $user
        ], 201);
    }
}
