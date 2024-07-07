<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    public function admin_login(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Retrieve admin by email
        $admin = Admin::where('email', $request->email)->first();

        // Check if admin exists and password matches
        if ($admin && Hash::check($request->password, $admin->password)) {
            // Generate token
            $token = $admin->createToken('API Token')->plainTextToken;

            return response()->json(['message' => 'Login successful!', 'token' => $token], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function admin_logout(Request $request)
    {
        \Log::info('Admin logout initiated');

        try {
            $request->user()->currentAccessToken()->delete();
            \Log::info('Token deleted successfully');
        } catch (\Exception $e) {
            \Log::error('Error during logout: ' . $e->getMessage());
            return response()->json(['message' => 'Logout failed'], 500);
        }

        return response()->json(['message' => 'Logged out successfully']);
    }

    public function admin_signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:tbl_admin,email',
            'admin_profile' => 'required|string',
            'password' => 'required|string',
            'password_confirmation' => 'required|string|same:password',
            'email_verified_at' => 'date',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'admin_profile' => $request->admin_profile,
            'password' => Hash::make($request->password),
            'email_verified_at' => $request->email_verified_at,
            'user_type_id' => 1,
        ]);

        return response()->json([
            'message' => 'Admin created successfully',
            'token' => $admin->createToken('auth_token')->plainTextToken
        ]);
    }
}
