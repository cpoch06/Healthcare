@php
use Carbon\Carbon;
@endphp

@extends('layout.app')

@section('content')

    <div class="min-h-96 flex items-center justify-center bg-gray-100">
        <div class=" w-full max-w-6xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-8">
            <h2 class="text-center text-3xl font-semibold text-gray-800">My Appointments</h2>
            @if (session('success'))
                <div class="bg-green-500 text-white p-3 rounded mt-4 mb-6">
                    {{ session('success') }}
                </div>
            @endif
            @if($appointments->isEmpty())
                <div class="text-center text-gray-600 mt-6">No appointments found.</div>
            @else
                <table class="w-full text-left text-sm mt-8">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b-2 border-gray-200">Patient Name</th>
                            <th class="py-2 px-4 border-b-2 border-gray-200">Appointment Date</th>
                            <th class="py-2 px-4 border-b-2 border-gray-200">Appointment Time</th>
                            <th class="py-2 px-4 border-b-2 border-gray-200">Symptoms</th>
                            <th class="py-2 px-4 border-b-2 border-gray-200">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                            <tr>
                                <td class="py-2 px-4 border-b">
                                    {{ $appointment->patient_Lname }} {{ $appointment->patient_Fname }}
                                </td>
                                <td class="py-2 px-4 border-b">{{  Carbon::parse($appointment->appointment_date)->format('Y-m-d') }}</td>
                                <td class="py-2 px-4 border-b">{{ Carbon::parse($appointment->appointment_time)->format('H:i') }}</td>
                                <td class="py-2 px-4 border-b">{{ $appointment->symptoms }}</td>
                                <td class="py-2 px-4 border-b">
                                    <a href="{{ route('doctor.appointment', $appointment->appointment_id) }}" class="text-blue-500 hover:underline">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
