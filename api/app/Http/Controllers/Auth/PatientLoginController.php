<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PatientLoginController extends Controller
{
    public function patient_signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_Fname' => 'required|string',
            'patient_Lname' => 'required|string',
            'patient_age' => 'required|integer',
            'gender' => 'required|string',
            'patient_email' => 'required|email|unique:tbl_patient,patient_email',
            'password' => 'required|string|confirmed',
            'patient_profile' => 'string|nullable',
            'phone_number' => 'required|string',
            'user_type_id' => 'integer|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $patient = Patient::create([
            'patient_Fname' => $request->patient_Fname,
            'patient_Lname' => $request->patient_Lname,
            'patient_age' => $request->patient_age,
            'gender' => $request->gender,
            'patient_email' => $request->patient_email,
            'password' => Hash::make($request->password),
            'patient_profile' => $request->patient_profile,
            'phone_number' => $request->phone_number,
            'user_type_id' => $request->user_type_id ?? 3,
        ]);

        $token = $patient->createToken('API Token')->plainTextToken;

        return response()->json(['message' => 'Patient created successfully', 'token' => $token], 201);
    }
    public function patient_login(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'patient_email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Retrieve patient by email
        $patient = Patient::where('patient_email', $request->patient_email)->first();

        // Check if patient exists and password matches
        if ($patient && Hash::check($request->password, $patient->password)) {
            // Generate token
            $token = $patient->createToken('API Token')->plainTextToken;

            return response()->json(['message' => 'Login successful!', 'token' => $token], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function patient_logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
