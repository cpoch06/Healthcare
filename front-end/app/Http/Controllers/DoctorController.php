<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('doctorInfo')->get();
        return view('doctor.index', compact('doctors'));
    }

    public function show($id)
    {
        $doctor = Doctor::with('doctorInfo')->find($id);

        if (!$doctor) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }

        return view('doctor.show', compact('doctor'));
    }

    public function appointments()
    {
        // Get the authenticated doctor's full name
        $doctorName = Auth::guard('doctor')->user()->doctor_Fname . ' ' . Auth::guard('doctor')->user()->doctor_Lname;

        // Fetch the appointments for the authenticated doctor by name
        $appointments = Appointment::where('preferred_physician', $doctorName)->with('patient')->get();

        // Return the view with the appointments
        return view('doctor.appointments', compact('appointments'));
    }

    public function appointment($id)
    {
        $appointment = Appointment::with('patient')->findOrFail($id);
        return view('doctor.appointment', compact('appointment'));
    }

    public function cancel($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return redirect()->route('doctor.appointments');
    }

    
}
