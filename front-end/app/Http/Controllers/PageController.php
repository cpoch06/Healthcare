<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;
use App\Models\Review;


class PageController extends Controller
{   
    public function home()
    {
        $doctors = Doctor::join('tbl_doctor_info', 'tbl_doctor.doctor_id', '=', 'tbl_doctor_info.doctor_id')
                        ->orderBy('tbl_doctor_info.experience', 'desc')
                        ->select('tbl_doctor.*', 'tbl_doctor_info.experience', 'tbl_doctor_info.speciality')
                        ->take(3)
                        ->get();
    
        if ($doctors->isEmpty()) {
            return view('home')->with('message', 'No doctors found');
        }
    
        $reviews = Review::with('patient')
                    ->where('rating', 5)
                    ->orderBy('created_at', 'desc')
                    ->take(4)
                    ->get();
    
        return view('home', ['doctors' => $doctors, 'reviews' => $reviews]);
    }
    
    
    public function about()
    {
        return view('about');
    }

    public function doctor()
    {
        return view('doctor');
    }

    public function chat()
    {
        return view('chat');
    }

    public function login()
    {
        return view('login');
    }

    public function signup()
    {
        return view('signup');
    }

    public function testiminal()
{
    $reviews = Review::with('patient')->take(8)->get();
    return view('testiminal', ['reviews' => $reviews]);
}

    public function review()
    {
        return view('review');
    }

    public function doctor_profile()
    {
        return view('doctor-profile');
    }

    public function booking_form()
    {
        $doctors = Doctor::all();
        return view('booking-form', ['doctors' => $doctors]);
    }

    public function index()
    {
        $patientId = Auth::guard('patient')->user()->patient_id;
        $appointments = Appointment::where('patient_id', $patientId)->get();
        return view('appointments.index', compact('appointments', 'patientId'));
    }
    
    public function show($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('appointments.show', compact('appointment'));
    }

    public function cancel($id)
    {
        $appointment = Appointment::findOrFail($id);

        // Ensure the user is authorized to cancel this appointment
        if ($appointment->patient_id !== Auth::guard('patient')->user()->patient_id) {
            // return redirect()->route('appointment.index')->with('error', 'You are not authorized to cancel this appointment.');
            return response()->json(['error' => 'You are not authorized to cancel this appointment.']);
        }

        $appointment->delete();

        return redirect()->route('appointment.index')->with('success', 'Appointment cancelled successfully.');
        // return response()->json(['success' => 'Appointment cancelled successfully.']);
    }

    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
    
        $doctors = Doctor::all();
        
        return view('appointments.edit', compact('appointment', 'doctors'));
    }

    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        $request->validate([
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'preferred_physician' => 'required|string|max:255',
            'symptoms' => 'nullable|string|max:1000',
        ]);
    
        $appointment->update([
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'preferred_physician' => $request->preferred_physician,
            'symptoms' => $request->symptoms,
        ]);
    
        return redirect()->route('appointment.index')->with('success', 'Appointment updated successfully.');
    }

    public function appointment_confirm($appointment_id)
    {
        $appointment = Appointment::findOrFail($appointment_id);

        return view('appointment_confirm', ['appointment' => $appointment]);
    }
}
