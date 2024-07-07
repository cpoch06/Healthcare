<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // This should return the view for your login page
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }

        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'admin_profile' => 'required|string',
            'password' => 'required|string',
            'password_confirmation' => 'required|string|same:password',
            'email_verified_at' => 'date',
        ]);

        // create the admin profile in public asset profile_pics folder
        $profilePicName = null;
        if ($request->hasFile('admin_profile')) {
            $profilePicName = time() . '_' . $request->file('admin_profile')->getClientOriginalName();
            $request->file('admin_profile')->move(public_path('profile_pics'), $profilePicName);
        }

        // Create the patient record
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'admin_profile' => $request->$profilePicName,
            'password' => Hash::make($request->password),
            'email_verified_at' => $request->email_verified_at,
            'user_type_id' => 1,
            'remember_token' => $request->remember_token,
            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at,
        ]);

        // return response()->json($admin, 201);

        return redirect('/home');
    }

    

}
