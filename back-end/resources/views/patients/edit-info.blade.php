@extends('layout.app')

@section('title', 'Edit Patient Information')

@section('content')
    <div class="w-full min-h-screen flex items-center justify-center">
        <div class="w-full py-8">
            <div class="border bg-white w-screen md:w-3/4 sm:w-2/3 lg:w-1/2 xl:w-[800px] mx-auto py-8 px-8 rounded-lg shadow-lg">
                <h2 class="text-center text-3xl font-bold tracking-wide text-main">Edit Patient Information</h2>
                <form class="my-10 text-sm" action="{{ route('patients.update', $patient->patient_id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- This hidden field tells Laravel to use the PUT method -->
                    <div class="flex flex-col my-4">
                        <label for="patient_nationality" class="text-gray-700">Nationality</label>
                        <input type="text" name="patient_nationality" id="patient_national"
                            class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900"
                            placeholder="Enter your nationality" value="{{ $patient_info->patient_nationality }}">
                    </div>
                 
                    <div class="flex flex-col my-4">
                        <label for="patient_visit" class="text-gray-700">Patient-Visit</label>
                        <input type="date" name="patient_visit" id="patient_visit"
                            class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900"
                            required value="{{ $patient_info->patient_visit }}">
                    </div>
                    <div class="grid grid-cols-4 gap-4">
                        <div class="flex flex-col my-4 grid-col-1">
                            <label for="weight" class="text-gray-700">Weight</label>
                            <input type="number" name="weight" id="weight"
                                class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900"
                                placeholder="Enter your Weight" value="{{ $patient_info->weight }}">
                        </div>
                        <div class="flex flex-col my-4 grid-col-1">
                            <label for="height" class="text-gray-700">Height</label>
                            <input type="number" name="height" id="height"
                                class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900"
                                placeholder="Enter your height" value="{{ $patient_info->height }}">
                        </div>

                        <div class="flex flex-col my-4 grid-col-1">
                            <label for="blood_pressure" class="text-gray-700">Blood Pressure</label>
                            <input type="number" name="blood_pressure" id="blood_pressure"
                                class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900"
                                placeholder="Enter blood pressure" value="{{ $patient_info->blood_pressure }}">
                        </div>

                        <div class="flex flex-col my-4 grid-col-1">
                            <label for="blood_type" class="text-gray-700">Blood-Type</label>
                            <select name="blood_type" id="blood_type"
                                class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900">
                                <option value="">Blood Type</option>
                                <option value="O-" {{ $patient_info->blood_type == 'O-' ? 'selected' : '' }}>O-</option>
                                <option value="O+" {{ $patient_info->blood_type == 'O+' ? 'selected' : '' }}>O+</option>
                                <option value="B-" {{ $patient_info->blood_type == 'B-' ? 'selected' : '' }}>B-</option>
                                <option value="B+" {{ $patient_info->blood_type == 'B+' ? 'selected' : '' }}>B+</option>
                                <option value="A-" {{ $patient_info->blood_type == 'A-' ? 'selected' : '' }}>A-</option>
                                <option value="A+" {{ $patient_info->blood_type == 'A+' ? 'selected' : '' }}>A+</option>
                                <option value="AB-" {{ $patient_info->blood_type == 'AB-' ? 'selected' : '' }}>AB-</option>
                                <option value="AB+" {{ $patient_info->blood_type == 'AB+' ? 'selected' : '' }}>AB+</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex flex-col my-4">
                        <label for="symptoms" class="text-gray-700">Symptoms</label>
                        <input type="text" name="symptoms" id="symptoms"
                            class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900"
                            placeholder="Enter your symptoms" value=" {{$patient_info->symptoms}} " ></input>
                    </div>

                    <div class="flex flex-col my-4">
                        <label for="patient_info" class="text-gray-700">Information</label>
                        <textarea name="patient_info" id="patient_info"
                            class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900"
                            placeholder="Enter your history">{{ $patient_info->patient_info }}</textarea>
                    </div>

                    <div class="flex flex-col my-4">
                        <label for="patient_history" class="text-gray-700">History</label>
                        <textarea name="patient_history" id="patient_history"
                            class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900"
                            placeholder="Enter your history">{{ $patient_info->patient_history }}</textarea>
                    </div>
                    <div class="flex flex-col my-4">
                        <label for="patient_plan" class="text-gray-700">Patient-Plan</label>
                        <textarea name="patient_plan" id="patient_plan"
                            class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900"
                            placeholder="Enter your plan">{{ $patient_info->patient_plan }}</textarea>
                    </div>
                    <div class="flex flex-col my-4">
                        <label for="medications" class="text-gray-700">Medication</label>
                        <textarea name="medications" id="medications"
                            class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900"
                            placeholder="Enter your medication">{{ $patient_info->medications }}</textarea>
                    </div>
                    <div class="my-4 flex items-center justify-center space-x-4">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-600 rounded-lg px-8 py-2 text-white hover:shadow-xl transition duration-150 uppercase">Update
                            Information</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
