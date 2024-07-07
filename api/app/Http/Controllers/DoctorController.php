<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\Validator;
use App\Models\DoctorInfo;


class DoctorController extends Controller
{
    //

    public function index()
    {
        $doctors = Doctor::all();
        return response()->json($doctors, 200);
    }

    public function show($id)
    {
        $doctor = Doctor::find($id);

        if (!$doctor) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }

        return response()->json($doctor, 200);
    }

    public function update(Request $request, $id)
    {
        $doctor = Doctor::find($id);

        if (!$doctor) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'doctor_Lname' => 'string',
            'doctor_Fname' => 'string',
            'doctor_age' => 'integer',
            'gender' => 'string',
            'doctor_email' => 'email|unique:tbl_doctor,doctor_email,' . $doctor->doctor_id . ',doctor_id',
            'password' => 'string|confirmed',
            'doctor_profile' => 'string|nullable',
            'phone_number' => 'string',
            'user_type_id' => 'integer|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $doctor->update($request->all());

        return response()->json(['message' => 'Doctor updated successfully', 'doctor' => $doctor], 200);
    }

    public function destroy($id)
    {
        $patient = Doctor::find($id);

        if (!$patient) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }

        $patient->delete();

        return response()->json(['message' => 'Doctor deleted successfully'], 200);
    }

    public function doctor_info_create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required|integer',
            'speciality' => 'string',
            'experience' => 'numeric',
            'edu_background' => 'string',
            'work_days' => 'array',
            'work_start_hour' => 'date_format:H:i',
            'work_end_hour' => 'date_format:H:i',
            'fellowships' => 'string|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $doctor_info = DoctorInfo::create($request->all());

        return response()->json(['message' => 'Doctor info created successfully', 'doctor_info' => $doctor_info], 201);
    }

    public function doctor_info_update(Request $request, $id)
    {
        $doctor_info = DoctorInfo::find($id);

        if (!$doctor_info) {
            return response()->json(['message' => 'Doctor info not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'doctor_id' => 'integer',
            'speciality' => 'string',
            'experience' => 'numeric',
            'edu_background' => 'string',
            'work_days' => 'array',
            'work_start_hour' => 'date_format:H:i',
            'work_end_hour' => 'date_format:H:i',
            'fellowships' => 'string|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $doctor_info->update($request->all());

        return response()->json(['message' => 'Doctor info updated successfully', 'doctor_info' => $doctor_info], 200);
    }

    public function doctor_info_show($id)
    {
        $doctor_info = DoctorInfo::find($id);

        if (!$doctor_info) {
            return response()->json(['message' => 'Doctor info not found'], 404);
        }

        return response()->json($doctor_info, 200);
    }

    public function doctor_info_index()
    {
        $doctor_info = DoctorInfo::all();
        return response()->json($doctor_info, 200);
    }

    public function doctor_info_destroy($id)
    {
        $doctor_info = DoctorInfo::find($id);

        if (!$doctor_info) {
            return response()->json(['message' => 'Doctor info not found'], 404);
        }

        $doctor_info->delete();

        return response()->json(['message' => 'Doctor info deleted successfully'], 200);
    }
}
