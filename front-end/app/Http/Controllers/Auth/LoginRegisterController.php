<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginRegisterController extends Controller
{
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_Fname' => 'required|string|max:100',
            'patient_Lname' => 'required|string|max:100',
            'patient_age' => 'required|integer',
            'gender' => 'required|string|max:10',
            'patient_email' => 'required|string|email|max:100|unique:tbl_patient,patient_email',
            'phone_number' => 'required|string|max:100|unique:tbl_patient,phone_number',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required_with:password|same:password',
            'patient_profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Handle the profile picture upload
        if ($request->hasFile('patient_profile')) {
            $profilePicName = time() . '.' . $request->patient_profile->getClientOriginalExtension();
            $request->patient_profile->move(public_path('profile_pics'), $profilePicName);
        } else {
            return response()->json(['patient_profile' => 'Profile picture is required.'], 400);
        }

        // Create the patient record
        $patient = Patient::create([
            'patient_Fname' => $request->patient_Fname,
            'patient_Lname' => $request->patient_Lname,
            'user_type_id' => 3, // user type id foreign key for patient
            'patient_age' => $request->patient_age,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
            'patient_email' => $request->patient_email,
            'password' => Hash::make($request->password),
            'patient_profile' => $profilePicName, // Save the profile picture filename
        ]);
        
        // Log the patient in
        Auth::guard('patient')->login($patient);

        return redirect()->route('home')->with('success', 'Patient registered successfully!');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'user_type' => 'required|in:patient,doctor'
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $credentials = [
            'patient_email' => $request->email,
            'password' => $request->password,
        ];
    
        if ($request->user_type === 'patient') {
            if (Auth::guard('patient')->attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('home');
            }
        } elseif ($request->user_type === 'doctor') {
            $credentials = [
                'doctor_email' => $request->email,
                'password' => $request->password,
            ];
    
            if (Auth::guard('doctor')->attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('home');
            }
        }
    
        return redirect()->back()->withErrors([
            'message' => 'Invalid credentials.',
        ])->withInput();
    }
    
    
    public function logout(Request $request)
    {
        if (Auth::guard('patient')->check()) {
            Auth::guard('patient')->logout();
        } elseif (Auth::guard('doctor')->check()) {
            Auth::guard('doctor')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
