<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\DoctorInfo;


class DoctorLoginController extends Controller
{
    public function createDoctor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_type_id' => 'integer|nullable',
            'doctor_Lname' => 'string|required',
            'doctor_Fname' => 'string|required',
            'doctor_email' => 'email|required|unique:tbl_doctor,doctor_email',
            'password' => 'string|required|confirmed',
            'doctor_age' => 'integer|required',
            'gender' => 'string|required',
            'doctor_profile' => 'string|nullable',
            'phone_number' => 'string|required',
            'speciality' => 'string|required',
            'experience' => 'numeric|required',
            'edu_background' => 'string|required',
            'work_days' => 'array|required',
            'work_days.*' => 'string',
            'work_start_hour' => 'date_format:H:i|required',
            'work_end_hour' => 'date_format:H:i|required|after:work_start_hour',
            'fellowships' => 'string|nullable',
            'doctor_id' => 'integer|nullable'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $doctor = Doctor::create([
            'user_type_id' => $request->user_type_id ?? 2,
            'doctor_Lname' => $request->doctor_Lname,
            'doctor_Fname' => $request->doctor_Fname,
            'doctor_email' => $request->doctor_email,
            'password' => Hash::make($request->password),
            'doctor_age' => $request->doctor_age,
            'gender' => $request->gender,
            'doctor_profile' => $request->doctor_profile,
            'phone_number' => $request->phone_number
        ]);
        
        $doctorInfo = DoctorInfo::create([
            'speciality' => $request->speciality,
            'experience' => $request->experience,
            'edu_background' => $request->edu_background,
            'work_days' => json_encode($request->work_days),
            'work_start_hour' => $request->work_start_hour,
            'work_end_hour' => $request->work_end_hour,
            'fellowships' => $request->fellowships,
            'doctor_id' => $doctor->doctor_id
        ]);

        if (!$doctor) {
            return response()->json(['message' => 'Doctor not created'], 400);
        } else if(!$doctorInfo) {
            return response()->json(['message' => 'Doctor info not created'], 400);
        }
        

        $token = $doctor->createToken('API Token')->plainTextToken;

        return response()->json(['message' => 'Doctor created successfully', 'token' => $token], 201);
    }

    public function doctor_login(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'doctor_email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Retrieve doctor by email
        $doctor = Doctor::where('doctor_email', $request->doctor_email)->first();

        // Check if doctor exists and password matches
        if ($doctor && Hash::check($request->password, $doctor->password)) {
            // Generate token
            $token = $doctor->createToken('API Token')->plainTextToken;

            return response()->json(['message' => 'Login successful!', 'token' => $token], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function doctor_logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }

}
