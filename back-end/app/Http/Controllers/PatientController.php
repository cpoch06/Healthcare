<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\PatientInfo;

class PatientController extends Controller
{
    //
    public function index()
    {
        // Fetch all patients
        $patients = Patient::all();
    
        // Fetch all patient info to check existence
        $patientInfos = PatientInfo::all()->keyBy('patient_id');
    
        // Pass the patients and patientInfos to the view
        return view('patients.index', compact('patients', 'patientInfos'));
    }
    

    public function show($id)
    {
        // Fetch a single patient by its ID
        $patient = Patient::findOrFail($id);

        $patient_info = PatientInfo::where('patient_id', $id)->first();

        // Pass the patient data to the view
        return view('patients.show', compact('patient', 'patient_info'));
    }

    public function addInfo($id)
    {
        $patient = Patient::find($id);
        if (!$patient) {
            return redirect()->route('patients.index')->with('error', 'Patient not found');
        }

        return view('patients.add-info', compact('patient'));
    }

    public function storeInfo(Request $request, $id)
    {
        $validatedData = $request->validate([
            'patient_nationality' => 'required|string|max:255',
            'patient_visit' => 'required|date',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'blood_type' => 'required|string|max:3',
            'blood_pressure' => 'required|numeric',
            'symptoms' => 'required|string',
            'patient_info' => 'required|string', 
            'patient_history' => 'required|string',
            'patient_plan' => 'required|string',
            'medications' => 'required|string',
        ]);
    
        $patientInfo = new PatientInfo([
            'patient_nationality' => $validatedData['patient_nationality'],
            'patient_id' => $id,
            'patient_visit' => $validatedData['patient_visit'],
            'weight' => $validatedData['weight'],
            'height' => $validatedData['height'],
            'blood_type' => $validatedData['blood_type'],
            'blood_pressure' => $validatedData['blood_pressure'],
            'symptoms' => $validatedData['symptoms'],
            'patient_info' => $validatedData['patient_info'],
            'patient_history' => $validatedData['patient_history'],
            'patient_plan' => $validatedData['patient_plan'],
            'medications' => $validatedData['medications'],
        ]);
    
        $patientInfo->save();
    
        return redirect()->route('patients.show', $id)->with('success', 'Patient information added successfully');
    }
    
    public function editInfo($id)
    {
        // Fetch a single patient by its ID
        $patient = Patient::findOrFail($id);
    
        // Fetch the patient info
        $patient_info = PatientInfo::where('patient_id', $id)->first();
    
        // Pass the patient
        return view('patients.edit-info', compact('patient', 'patient_info'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'patient_nationality' => 'required|string|max:255',
            'patient_visit' => 'required|date',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'blood_type' => 'required|string|max:3',
            'blood_pressure' => 'required|numeric',
            'symptoms' => 'required|string',
            'patient_info' => 'required|string',
            'patient_history' => 'required|string',
            'patient_plan' => 'required|string',
            'medications' => 'required|string',
        ]);

        $patientInfo = PatientInfo::where('patient_id', $id)->first();
        
        $patientInfo->patient_nationality = $validatedData['patient_nationality'];
        $patientInfo->patient_visit = $validatedData['patient_visit'];
        $patientInfo->weight = $validatedData['weight'];
        $patientInfo->height = $validatedData['height'];
        $patientInfo->blood_type = $validatedData['blood_type'];
        $patientInfo->blood_pressure = $validatedData['blood_pressure'];
        $patientInfo->symptoms = $validatedData['symptoms'];
        $patientInfo->patient_info = $validatedData['patient_info'];
        $patientInfo->patient_history = $validatedData['patient_history'];
        $patientInfo->patient_plan = $validatedData['patient_plan'];
        $patientInfo->medications = $validatedData['medications'];

        $patientInfo->save();

        return redirect()->route('patients.show', $id)->with('success', 'Patient information updated successfully');
    }
}
