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

            <div class="flex justify-center px-6">

                <a href="{{ route('appointment.edit', $appointment->appointment_id) }}" class="items-center btn btn-outline btn-primary mt-5 rounded-none w-48 hover:text-white">Edit</a>
                <button onclick="openModal()" class="items-center btn btn-outline btn-error mt-5 rounded-none w-48 hover:text-white">Delete</button>

            </div>
        </div>
    </div>
</div>

<div id="modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white w-1/3 p-8 rounded-lg shadow-lg">
        <h2 class="text-center text-2xl font-bold text-main">Delete Appointment</h2>
        <p class="text-center text-gray-700 mt-4">Are you sure you want to delete this appointment?</p>
        <div class="flex justify-center mt-8">
            <button onclick="closeModal()" class="btn btn-outline w-24 ml-4">Cancel</button>

            <form action="{{ route('appointment.cancel', $appointment->appointment_id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-error w-24">Delete</button>
            </form>
           
        </div>
    </div>


@endsection
