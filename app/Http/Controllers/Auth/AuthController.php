<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|string|email|exists:users,email',
            'password' => 'required|string|min:6'
        ]);

        if ($validation->failed()) {
            return response()->json([
                'status' => 400,
                'message' => $validation->errors()->first()
            ]);
        } else {
            if (Auth::attempt($request->only('email', 'password'))) {
                if (Auth::user()->hasRole('admin')) {
                    return response()->json([
                        'status' => 200,
                        'message' => 'Admin User',
                        'url' => 'admin/dashboard'
                    ]);
                } else {
                    return response()->json([
                        'status' => 200,
                        'message' => 'No User'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Wrong credentials'
                ]);
            }
        }
    }
}
