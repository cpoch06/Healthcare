<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    public function appointment_create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|integer',
            'doctor_id' => 'required|integer',
            'patient_Lname' => 'required|string',
            'patient_Fname' => 'required|string',
            'patient_age' => 'required|integer',
            'gender' => 'required|string',
            'address' => 'required|string',
            'national_card' => 'string|nullable',
            'phone_number' => 'required|string',
            'passport' => 'string|nullable',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|date_format:H:i',
            'preferred_physician' => 'string|nullable',
            'symptoms' => 'string|nullable',
            'status' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $appointment = Appointment::create($request->all());

        return response()->json(['message' => 'Appointment created successfully', 'appointment' => $appointment], 201);
    }

    public function appointment_update(Request $request, $id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'patient_id' => 'integer',
            'doctor_id' => 'integer',
            'patient_Lname' => 'string',
            'patient_Fname' => 'string',
            'patient_age' => 'integer',
            'gender' => 'string',
            'address' => 'string',
            'national_card' => 'string|nullable',
            'phone_number' => 'string',
            'passport' => 'string|nullable',
            'appointment_date' => 'date',
            'appointment_time' => 'date_format:H:i',
            'preferred_physician' => 'string|nullable',
            'symptoms' => 'string|nullable',
            'status' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $appointment->update($request->all());

        return response()->json(['message' => 'Appointment updated successfully', 'appointment' => $appointment], 200);
    }

    public function appointment_show($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        return response()->json($appointment, 200);
    }

    public function appointment_index()
    {
        $appointments = Appointment::all();
        return response()->json($appointments, 200);
    }

    public function appointment_destroy($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        $appointment->delete();

        return response()->json(['message' => 'Appointment deleted successfully'], 200);
    }
}
