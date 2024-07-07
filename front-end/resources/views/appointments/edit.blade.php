@extends('layout.app')

@section('content')
    <div class="w-full min-h-screen max-w-7xl mx-auto flex items-center justify-center">
        <div class="w-full py-4">
            <div class="bg-white w-auto md:w-2/3 lg:w-1/2 xl:w-[700px] mt-8 mx-auto px-16 py-8 rounded-lg shadow-2xl">
                <h2 class="text-center text-2xl font-bold tracking-wide text-main">Edit Appointment</h2>
                <form class="my-8 text-sm" action="{{ route('appointment.update', $appointment->appointment_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-col my-4">
                        <label for="appointment_date" class="text-gray-700">Date</label>
                        <input type="date" name="appointment_date" id="appointment_date" value="{{ $appointment->appointment_date }}" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900" required>
                    </div>
                    <div class="flex flex-col my-4">
                        <label for="appointment_time" class="text-gray-700">Time</label>
                        <input type="time" name="appointment_time" id="appointment_time" value="{{ $appointment->appointment_time }}" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900" required>
                    </div>

                    <select name="preferred_physician" id="preferred_physician" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900" required>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->doctor_Fname }} {{ $doctor->doctor_Lname }}">Dr. {{ $doctor->doctor_Fname }} {{ $doctor->doctor_Lname }}</option>
                        @endforeach
                    </select>

                    <div class="flex flex-col my-4">
                        <label for="symptoms" class="text-gray-700">Symptoms</label>
                        <textarea name="symptoms" id="symptoms" rows="5" cols="10" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900">{{ $appointment->symptoms }}</textarea>
                    </div>
                    <div class="my-4 flex items-center justify-center space-x-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 rounded-lg px-8 py-2 text-white hover:shadow-xl transition duration-150 uppercase">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
