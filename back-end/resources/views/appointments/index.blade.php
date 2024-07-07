@extends('layout.app')

@section('content')
    <div class="overflow-x-auto sm:px-6 lg:px-8">
        <div class="w-full max-w-7xl mx-auto mt-16 px-4">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Appointment List</h2>
                <table class="table-auto w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="p-4 text-left">No</th>
                            <th class="p-4 text-left">Name</th>
                            <th class="p-4 text-left">Patient Id</th>
                            <th class="p-4 text-left">Date</th>
                            <th class="p-4 text-left">Time</th>
                            <th class="p-4 text-left">Process</th>
                            <th class="p-4 text-left">Info</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $index => $appointment)
                            <tr class="border-b">
                                <th class="p-4">{{ $index + 1 }}</th>
                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="mask mask-squircle w-12 h-12">
                                                @if($appointment->patient && $appointment->patient->patient_profile)
                                                    <img src="{{ asset('asset/profile_pics/' . $appointment->patient->patient_profile) }}" alt="patient" />
                                                @else
                                                    <img src="{{ asset('asset/default-profile.png') }}" alt="default" />
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-bold">
                                                @if($appointment->patient)
                                                    {{ $appointment->patient->patient_Fname }} {{ $appointment->patient->patient_Lname }}
                                                @else
                                                   {{ $appointment->patient_Fname }} {{ $appointment->patient_Lname }}
                                                @endif
                                            </div>
                                            <div class="text-sm opacity-50">
                                               {{ $appointment->patient->patient_email ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4">{{ $appointment->patient_id ?? 'N/A' }}</td>
                                <td class="p-4">{{ $appointment->appointment_date ? $appointment->appointment_date->format('d/M/Y') : 'N/A' }}</td>
                                <td class="p-4">{{ $appointment->appointment_time ? $appointment->appointment_time->format('H:i') : 'N/A' }}</td>
                                <td class="p-4">
                                    @php
                                        $appointmentDateTime = $appointment->appointment_date ? $appointment->appointment_date->toDateString() . ' ' . $appointment->appointment_time->toTimeString() : null;
                                    @endphp

                                    @if ($appointment->status == 1)
                                        <img src="{{ asset('asset/verify-icon.png') }}" class="w-10 h-10 ml-5" alt="">
                                    @else
                                        <img src="{{ asset('asset/delete-x-icon.webp') }}" class="w-10 h-10 ml-5" alt="">
                                    @endif
                                </td>

                                <td class="p-4">
                                    @if($appointment->patient)
                                        <a href="{{ route('patients.show', $appointment->patient_id) }}">
                                            <button class="btn btn-ghost btn-xs">Info</button>
                                        </a>
                                    @else
                                        <button class="btn btn-ghost btn-xs" disabled>Info</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
@endsection
