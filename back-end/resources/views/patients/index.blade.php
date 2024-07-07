@extends('layout.app')

@section('content')
    <div class="overflow-x-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto mt-16">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Patient List</h2>
            <table class="min-w-full border-collapse bg-white">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-4 text-left">No</th>
                        <th class="p-4 text-left">Name</th>
                        <th class="p-4 text-left">Patient Id</th>
                        <th class="p-4 text-left">Last Visit</th>
                        <th class="p-4 text-left">Action</th>
                        <th class="p-4 text-left">Info</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($patients as $index => $patient)
                        <tr class="border-b">
                            <th class="p-4">{{ $index + 1 }}</th>
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <div class="avatar">
                                        <div class="mask mask-squircle w-12 h-12">
                                            <img src="{{ asset('asset/profile_pics/' . $patient->patient_profile) }}" alt="patient" />
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-bold">{{ $patient->patient_Fname }} {{ $patient->patient_Lname }}</div>
                                        <div class="text-sm opacity-50">{{ $patient->address }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">{{ $patient->patient_id }}</td>
                            <td class="p-4">{{ $patient->last_visit ? $patient->last_visit->format('d/M/Y') : 'N/A' }}</td>
                            <td class="p-4">
                                <a href="{{ route('patients.show', $patient->patient_id) }}"><button class="btn btn-ghost btn-xs">Details</button></a>
                            </td>
                            <td class="p-4">
                                @if (isset($patientInfos[$patient->patient_id]))
                                    <a href="{{ route('patients.edit-info', $patient->patient_id) }}"><button class="btn btn-ghost btn-xs">Edit Info</button></a>
                                @else
                                    <a href="{{ route('patients.add-info', $patient->patient_id) }}"><button class="btn btn-ghost btn-xs">Add Info</button></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

    
        </div>
    </div>
@endsection
