<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function adminLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        if ($request->email === env('ADMIN_EMAIL') && $request->password === env('ADMIN_PASSWORD')) {
            $admin = [
                'email' => env('ADMIN_EMAIL'),
                'name' => 'Admin',
            ];

            return response()->json([
                'message' => 'Admin login successful!',
                'admin' => $admin,
            ], 200);
        }

        return response()->json([
            'message' => 'Invalid admin credentials',
        ], 401);
    }
}
