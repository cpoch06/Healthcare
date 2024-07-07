@extends('layout.app')

@section('content')
<div class="w-full min-h-screen max-w-7xl mx-auto flex items-center justify-center">
    <div class="w-full py-4">
        <div class="bg-white w-auto md:w-2/3 lg:w-1/2 xl:w-[700px] mt-8 mx-auto px-16 py-8 rounded-lg shadow-2xl">
            <h2 class="text-center text-2xl font-bold tracking-wide text-main">Appointment Details</h2>
            <table class="my-8 w-full text-sm">
                <tr>
                    <th class="text-gray-700 text-left py-2">Appointment ID</th>
                    <td class="text-gray-900 py-2 px-6">{{ $appointment->appointment_id }}</td>
                </tr>
                <tr>
                    <th class="text-gray-700 text-left py-2">Patient First Name</th>
                    <td class="text-gray-900 py-2 px-6">{{ $appointment->patient_Fname }}</td>
                </tr>
                <tr>
                    <th class="text-gray-700 text-left py-2">Patient Last Name</th>
                    <td class="text-gray-900 py-2 px-6">{{ $appointment->patient_Lname }}</td>
                </tr>
                <tr>
                    <th class="text-gray-700 text-left py-2">Patient Age</th>
                    <td class="text-gray-900 py-2 px-6">{{ $appointment->patient_age }}</td>
                </tr>
                <tr>
                    <th class="text-gray-700 text-left py-2">Gender</th>
                    <td class="text-gray-900 py-2 px-6">{{ $appointment->gender }}</td>
                </tr>
                <tr>
                    <th class="text-gray-700 text-left py-2">National Card</th>
                    <td class="text-gray-900 py-2 px-6">{{ $appointment->national_card }}</td>
                </tr>
                <tr>
                    <th class="text-gray-700 text-left py-2">Passport</th>
                    <td class="text-gray-900 py-2 px-6">{{ $appointment->passport }}</td>
                </tr>
                <tr>
                    <th class="text-gray-700 text-left py-2">Address</th>
                    <td class="text-gray-900 py-2 px-6">{{ $appointment->address }}</td>
                </tr>
                <tr>
                    <th class="text-gray-700 text-left py-2">Date</th>
                    <td class="text-gray-900 py-2 px-6">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d') }}</td>
                </tr>
                <tr>
                    <th class="text-gray-700 text-left py-2">Time</th>
                    <td class="text-gray-900 py-2 px-6">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}</td>
                </tr>
                <tr>
                    <th class="text-gray-700 text-left py-2">Physician</th>
                    <td class="text-gray-900 py-2 px-6">{{ $appointment->preferred_physician }}</td>
                </tr>
                <tr>
                    <th class="text-gray-700 text-left py-2">Phone Number</th>
                    <td class="text-gray-900 py-2 px-6">{{ $appointment->phone_number }}</td>
                </tr>
                <tr>
                    <th class="text-gray-700 text-left py-2">Symptoms</th>
                    <td class="text-gray-900 py-2 px-6">{{ $appointment->symptoms }}</td>
                </tr>
            </table>

        </div>
    </div>
</div>

@endsection