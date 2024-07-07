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
                            <th class="px-4 py-2 text-gray-600">Appointment ID</th>
                            <th class="px-4 py-2 text-gray-600">Date</th>
                            <th class="px-4 py-2 text-gray-600">Time</th>
                            <th class="px-4 py-2 text-gray-600">Status</th>
                            <th class="px-4 py-2 text-gray-600">Physician</th>
                            <th class="px-4 py-2 text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                            <tr class="border-t">
                                <td class="px-4 py-3">{{ $appointment->appointment_id }}</td>
                                <td class="px-4 py-3">{{ Carbon::parse($appointment->appointment_date)->format('Y-m-d') }}</td>
                                <td class="px-4 py-3">{{ Carbon::parse($appointment->appointment_time)->format('H:i') }} </td>

                                    @if($appointment->appointment_date < Carbon::now())
                                        <td class="px-4 py-3 text-red-500">Expired</td>
                                    @else
                                        <td class="px-4 py-3 text-green-500">Active</td>
                                    @endif

                                <td class="px-4 py-3">{{ $appointment->preferred_physician }}</td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('appointment.show', $appointment->appointment_id) }}" class="text-blue-500 hover:text-blue-700">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

@endsection
