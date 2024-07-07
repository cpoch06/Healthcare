<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\DoctorInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class DoctorController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_Lname' => 'required|string|max:255',
            'doctor_Fname' => 'required|string|max:255',
            'doctor_email' => 'required|string|email|max:255|unique:tbl_doctor,doctor_email',
            'password' => 'required|string|min:8|confirmed',
            'doctor_age' => 'required|integer',
            'gender' => 'required|string|max:10',
            'doctor_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone_number' => 'required|string|max:20',
            'speciality' => 'required|string|max:100',
            'experience' => 'required|numeric',
            'edu_background' => 'required|string',
            'work_days' => 'required|array',
            'work_days.*' => 'string',
            'work_start_hour' => 'required|date_format:H:i',
            'work_end_hour' => 'required|date_format:H:i|after:work_start_hour',
            'fellowships' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $profilePath = null;
            if ($request->hasFile('doctor_profile')) {
                $file = $request->file('doctor_profile');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('profile_pics'), $fileName);
                $profilePath = 'profile_pics/' . $fileName;
            }

            $doctor = Doctor::create([
                'doctor_Lname' => $request->doctor_Lname,
                'doctor_Fname' => $request->doctor_Fname,
                'doctor_age' => $request->doctor_age,
                'gender' => $request->gender,
                'doctor_email' => $request->doctor_email,
                'doctor_profile' => $profilePath,
                'password' => Hash::make($request->password),
                'phone_number' => $request->phone_number,
                'user_type_id' => 2,
            ]);

            Log::info('Doctor record created', ['doctor_id' => $doctor->doctor_id]);

            $doctorInfo = DoctorInfo::create([
                'doctor_id' => $doctor->doctor_id,
                'speciality' => $request->speciality,
                'experience' => $request->experience,
                'edu_background' => $request->edu_background,
                'work_days' => implode(',', $request->work_days),
                'work_start_hour' => $request->work_start_hour,
                'work_end_hour' => $request->work_end_hour,
                'fellowships' => $request->fellowships,
            ]);

            Log::info('Doctor info record created', ['doctor_info_id' => $doctorInfo->doctor_info_id]);

            return redirect()->route('doctor.index')->with('success', 'Doctor added successfully');


        } catch (QueryException $e) {
            Log::error('Database Query Exception: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['message' => 'There was an error adding the doctor information. Please try again.'], 500);
        } catch (\Exception $e) {
            Log::error('General Exception: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['message' => 'There was an error adding the doctor information. Please try again.'], 500);
        }
    }

    public function index(Request $request)
    {
        $query = $request->input('query');
    
        if ($query) {
            $doctors = Doctor::with('doctorInfo')
                ->where('doctor_Fname', 'LIKE', "%$query%")
                ->orWhere('doctor_Lname', 'LIKE', "%$query%")
                ->orWhereHas('doctorInfo', function ($q) use ($query) {
                    $q->where('speciality', 'LIKE', "%$query%");
                })
                ->get();
        } else {
            $doctors = Doctor::with('doctorInfo')->get();
        }
    
        if ($request->ajax()) {
            return response()->json($doctors);
        }
    
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

    public function edit($id)
    {
        $doctor = Doctor::with('doctorInfo')->find($id);

        if (!$doctor) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }

        return view('doctor.edit', compact('doctor'));
    }

    public function update(Request $request, $id)
    {
        $doctor = Doctor::find($id);
        $doctorInfo = DoctorInfo::where('doctor_id', $id)->first();
    
        if (!$doctor || !$doctorInfo) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }
    
        $validator = Validator::make($request->all(), [
            'doctor_Lname' => 'required|string|max:255',
            'doctor_Fname' => 'required|string|max:255',
            'doctor_email' => 'required|string|email|max:255|unique:tbl_doctor,doctor_email,' . $doctor->doctor_id . ',doctor_id',
            'password' => 'nullable|string|min:8|confirmed',
            'doctor_age' => 'required|integer',
            'gender' => 'required|string|max:10',
            'doctor_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone_number' => 'required|string|max:20',
            'speciality' => 'required|string|max:100',
            'experience' => 'required|numeric',
            'edu_background' => 'required|string',
            'work_days' => 'required|array',
            'work_days.*' => 'string',
            'work_start_hour' => 'required|date_format:H:i',
            'work_end_hour' => 'required|date_format:H:i',
            'fellowships' => 'nullable|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
    
        try {
            if ($request->hasFile('doctor_profile')) {
                $file = $request->file('doctor_profile');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('profile_pics'), $fileName);
                $doctor->doctor_profile = 'profile_pics/' . $fileName;
            }
    
            $doctor->doctor_Lname = $request->doctor_Lname;
            $doctor->doctor_Fname = $request->doctor_Fname;
            $doctor->doctor_email = $request->doctor_email;
            if ($request->password) {
                $doctor->password = Hash::make($request->password);
            }
            $doctor->doctor_age = $request->doctor_age;
            $doctor->gender = $request->gender;
            $doctor->phone_number = $request->phone_number;
            $doctor->save();
    
            $doctorInfo->speciality = $request->speciality;
            $doctorInfo->experience = $request->experience;
            $doctorInfo->edu_background = $request->edu_background;
            $doctorInfo->work_days = implode(',', $request->work_days);
            $doctorInfo->work_start_hour = date('H:i', strtotime($request->work_start_hour));
            $doctorInfo->work_end_hour = date('H:i', strtotime($request->work_end_hour));
            $doctorInfo->fellowships = $request->fellowships;
            $doctorInfo->save();
    
            return redirect()->route('doctor.show', $doctor->doctor_id)->with('success', 'Doctor information updated successfully');
        } catch (\Exception $e) {
            Log::error('Error updating doctor information: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->with('error', 'There was an error updating the doctor information. Please try again.');
        }
    }    

    public function destroy($id)
    {
        $doctor = Doctor::find($id);
        if (!$doctor) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }

        try {
            $doctorInfo = DoctorInfo::where('doctor_id', $id)->first();
            if ($doctorInfo) {
                $doctorInfo->delete();
            }
            $doctor->delete();

            return redirect()->route('doctor.index')->with('success', 'Doctor deleted successfully');
        } catch (\Exception $e) {
            Log::error('Error deleting doctor: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->with('error', 'There was an error deleting the doctor. Please try again.');
        }
    }



   
}
