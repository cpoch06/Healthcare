<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;

class FormController extends Controller
{
    public function appointment_post(Request $request)
    {
        $rules = [
            'id_type' => 'required|string|in:national_card,passport',
            'id_number' => 'required|string|max:255',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|date_format:H:i',
            'preferred_physician' => 'required|string', // Use the doctor name for validation
            'address' => 'nullable|string|max:500',
            'symptoms' => 'nullable|string|max:500',
            'agree' => 'accepted',
        ];

        if (!Auth::guard('patient')->check()) {
            $rules = array_merge($rules, [
                'patient_Fname' => 'required|string|max:255',
                'patient_Lname' => 'required|string|max:255',
                'patient_age' => 'required|integer|min:0',
                'phone_number' => 'nullable|string|max:20',
                'gender' => 'required|string|in:Male,Female',
            ]);
        }

        $validatedData = $request->validate($rules);

        // Find the doctor_id from the preferred physician name
        $doctor = Doctor::whereRaw("CONCAT(doctor_Fname, ' ', doctor_Lname) = ?", [$request->input('preferred_physician')])->firstOrFail();

        $national_card = $request->input('id_type') === 'national_card' ? $request->input('id_number') : null;
        $passport = $request->input('id_type') === 'passport' ? $request->input('id_number') : null;

        $appointment = Appointment::create([
            'patient_id' => Auth::guard('patient')->check() ? Auth::guard('patient')->user()->patient_id : null,
            'doctor_id' => $doctor->doctor_id, // Set doctor_id to the found doctor_id
            'patient_Lname' => Auth::guard('patient')->check() ? Auth::guard('patient')->user()->patient_Lname : $request->input('patient_Lname'),
            'patient_Fname' => Auth::guard('patient')->check() ? Auth::guard('patient')->user()->patient_Fname : $request->input('patient_Fname'),
            'patient_age' => Auth::guard('patient')->check() ? Auth::guard('patient')->user()->patient_age : $request->input('patient_age'),
            'gender' => Auth::guard('patient')->check() ? Auth::guard('patient')->user()->gender : $request->input('gender'),
            'address' => $request->input('address'),
            'national_card' => $national_card,
            'passport' => $passport,
            'appointment_date' => $request->input('appointment_date'),
            'appointment_time' => $request->input('appointment_time'),
            'preferred_physician' => $request->input('preferred_physician'), // Store the doctor's name
            'phone_number' => Auth::guard('patient')->check() ? Auth::guard('patient')->user()->phone_number : $request->input('phone_number'),
            'symptoms' => $request->input('symptoms'),
            'status' => 1
        ]);

        if (Auth::guard('patient')->check()) {
            return redirect()->route('appointment.show', $appointment->appointment_id)->with('success', 'Appointment created successfully');
        } else {
            return redirect()->route('appointment_confirm', $appointment->appointment_id)->with('success', 'Appointment created successfully');
        }
    }
    

    public function review_post(Request $request) 
    {  
        try {
            // Ensure the user is authenticated and retrieve the patient_id
            $patient_id = auth()->user()->patient_id;
    
            // Validate the incoming request data
            $validatedData = $request->validate([
                'last_name' => 'required|string|max:255',
                'first_name' => 'required|string|max:255',
                'gender' => 'required|string|max:10',
                'email' => 'required|email|max:255',
                'phone_number' => 'required|string|max:15',
                'rating' => 'required|integer|min:1|max:5',
                'message' => 'required|string'
            ]);
            
            // Create a new Review instance and fill it with validated data
            $review = new Review();
            $review->patient_id = $patient_id; // Assign the authenticated user's patient_id
            $review->last_name = $validatedData['last_name'];
            $review->first_name = $validatedData['first_name'];
            $review->gender = $validatedData['gender'];
            $review->phone_number = $validatedData['phone_number'];
            $review->email = $validatedData['email'];
            $review->rating = $validatedData['rating'];
            $review->message = $validatedData['message'];
            
            // Save the review to the database
            $review->save();
            
            // Return a success response
            // return response()->json(['message' => 'Review submitted successfully'], 200);
            
            return redirect()->route('testiminal')->with('success', 'Review submitted successfully');

        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to submit review', 'error' => $e->getMessage()], 500);
        }
    }
}
