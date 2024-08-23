<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $adminEmail = env('ADMIN_EMAIL');
        $adminPassword = env('ADMIN_PASSWORD');

        if ($request->email === $adminEmail && Hash::check($request->password, $adminPassword)) {
            $token = bin2hex(random_bytes(32));
            $request->session()->put('admin_token', $token); 
            
            return response()->json(['token' => $token, 'message' => 'Login successful']);
        }

        return response()->json(['message' => 'The provided credentials do not match our records.'], 401);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_token');
        return response()->json(['message' => 'Logged out successfully']);
    }
}
