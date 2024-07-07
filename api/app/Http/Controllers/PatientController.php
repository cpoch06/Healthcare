<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\Validator;
use App\Models\PatientInfo;


class PatientController extends Controller
{
    //
    
    public function index()
    {
        $patients = Patient::all();
        return response()->json($patients, 200);
    }

    public function show($id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['message' => 'Patient not found'], 404);
        }

        return response()->json($patient, 200);
    }

    public function update(Request $request, $id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['message' => 'Patient not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'patient_Fname' => 'string|max:255',
            'patient_Lname' => 'string|max:255',
            'patient_age' => 'integer',
            'gender' => 'string',
            'patient_email' => 'email|unique:tbl_patient,patient_email,' . $patient->patient_id . ',patient_id',
            'password' => 'string|confirmed',
            'patient_profile' => 'string|nullable',
            'phone_number' => 'string',
            'user_type_id' => 'integer|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $patient->update($request->all());

        return response()->json(['message' => 'Patient updated successfully', 'patient' => $patient], 200);
    }

    public function destroy($id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['message' => 'Patient not found'], 404);
        }

        $patient->delete();

        return response()->json(['message' => 'Patient deleted successfully'], 200);
    }
   
    public function patient_info_create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_nationality' => 'string',
            'patient_id' => 'required|integer',
            'blood_group' => 'string',
            'weight' => 'numeric',
            'height' => 'numeric',
            'allergies' => 'string|nullable',
            'symptoms' => 'string|nullable',
            'patient_info' => 'string|nullable',
            'patient_history' => 'string|nullable',
            'patient_plan' => 'string|nullable',
            'medications' => 'string|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $patient_info = PatientInfo::create($request->all());

        return response()->json(['message' => 'Patient info created successfully', 'patient_info' => $patient_info], 201);
    }

    public function patient_info_update(Request $request, $id)
    {
        $patient_info = PatientInfo::find($id);

        if (!$patient_info) {
            return response()->json(['message' => 'Patient info not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'patient_id' => 'integer',
            'blood_group' => 'string',
            'weight' => 'numeric',
            'height' => 'numeric',
            'allergies' => 'string|nullable',
            'symptoms' => 'string|nullable',
            'patient_info' => 'string|nullable',
            'patient_history' => 'string|nullable',
            'patient_plan' => 'string|nullable',
            'medications' => 'string|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $patient_info->update($request->all());

        return response()->json(['message' => 'Patient info updated successfully', 'patient_info' => $patient_info], 200);
    }

    public function patient_info_show($id)
    {
        $patient_info = PatientInfo::find($id);

        if (!$patient_info) {
            return response()->json(['message' => 'Patient info not found'], 404);
        }

        return response()->json($patient_info, 200);
    }

    public function patient_info_index()
    {
        $patient_info = PatientInfo::all();
        return response()->json($patient_info, 200);
    }

    public function patient_info_destroy($id)
    {
        $patient_info = PatientInfo::find($id);

        if (!$patient_info) {
            return response()->json(['message' => 'Patient info not found'], 404);
        }

        $patient_info->delete();

        return response()->json(['message' => 'Patient info deleted successfully'], 200);
    }
}
