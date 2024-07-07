@extends('layout.app')

@section('content')
<div class="w-full min-h-screen max-w-7xl mx-auto flex items-center justify-center">
    <div class="w-full py-4">
        <div class="bg-white w-auto md:w-2/3 lg:w-1/2 xl:w-[700px] mt-8 mx-auto px-16 py-8 rounded-lg shadow-2xl">
            <h2 class="text-center text-2xl font-bold tracking-wide text-main">Make an Appointment</h2>

            <!-- @if(Auth::guard('patient')->check())
                <p class="text-green-500">You are logged in as: {{ Auth::guard('patient')->user()->patient_email }}</p>
            @else
                <p class="text-red-500">You are not logged in.</p>
            @endif -->

            <form class="my-8 text-sm" action="{{ route('appointment_post') }}" method="POST">
                @csrf
                @if(Auth::guard('patient')->check())
                    <input type="hidden" name="patient_Fname" value="{{ Auth::guard('patient')->user()->patient_Fname }}">
                    <input type="hidden" name="patient_Lname" value="{{ Auth::guard('patient')->user()->patient_Lname }}">
                    <input type="hidden" name="patient_age" value="{{ Auth::guard('patient')->user()->patient_age }}">
                    <input type="hidden" name="gender" value="{{ Auth::guard('patient')->user()->gender }}">
                    <input type="hidden" name="phone_number" value="{{ Auth::guard('patient')->user()->phone_number }}">
                @else
                    <div class="flex flex-col my-4">
                        <label for="patient_Fname" class="text-gray-700">First Name</label>
                        <input type="text" name="patient_Fname" id="patient_Fname" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900" placeholder="Enter your first name" required>
                    </div>
                    <div class="flex flex-col my-4">
                        <label for="patient_Lname" class="text-gray-700">Last Name</label>
                        <input type="text" name="patient_Lname" id="patient_Lname" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900" placeholder="Enter your last name" required>
                    </div>
                    
                    <div class="flex flex-col my-4">
                        <label for="patient_age" class="text-gray-700">Age</label>
                        <input type="number" name="patient_age" id="patient_age" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900" placeholder="Enter your age" required>
                    </div>
                    <div class="flex flex-col my-4">
                        <label for="phone_number" class="text-gray-700">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900" placeholder="Enter your phone number">
                    </div>
                    <div class="flex flex-col my-4">
                        <span class="text-gray-700">Gender</span>
                        <div class="flex items-center mt-2">
                            <input type="radio" name="gender" id="male" value="Male" class="mr-2 focus:ring-2 focus:ring-main rounded">
                            <label for="male" class="text-gray-700 mr-4">Male</label>
                            <input type="radio" name="gender" id="female" value="Female" class="mr-2 focus:ring-2 focus:ring-main rounded">
                            <label for="female" class="text-gray-700">Female</label>
                        </div>
                    </div>
                @endif

                <div class="flex flex-col my-4">
                    <label for="address" class="text-gray-700">Address</label>
                    <textarea name="address" id="address" rows="3" cols="10" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900" placeholder="Enter your address"></textarea>
                </div>
                <div class="flex flex-col my-4">
                    <label for="id_type" class="text-gray-700">Identification Type</label>
                    <select name="id_type" id="id_type" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900" required>
                        <option value="national_card">National Card ID</option>
                        <option value="passport">Passport ID</option>
                    </select>
                </div>
                <div class="flex flex-col my-4">
                    <label for="id_number" class="text-gray-700">Identification Number</label>
                    <input type="text" name="id_number" id="id_number" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900" placeholder="Enter your identification number" required>
                </div>
                <div class="flex flex-col my-4">
                    <label for="appointment_date" class="text-gray-700">Date</label>
                    <input type="date" name="appointment_date" id="appointment_date" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900" required>
                </div>
                <div class="flex flex-col my-4">
                    <label for="appointment_time" class="text-gray-700">Time</label>
                    <input type="time" name="appointment_time" id="appointment_time" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900" required>
                </div>
                <div class="flex flex-col my-4">
                    <label for="preferred_physician" class="text-gray-700">Preferred Physician</label>
                    <select name="preferred_physician" id="preferred_physician" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900" required>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->doctor_Fname }} {{ $doctor->doctor_Lname }}">Dr. {{ $doctor->doctor_Fname }} {{ $doctor->doctor_Lname }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col my-4">
                    <label for="symptoms" class="text-gray-700">Symptoms</label>
                    <textarea name="symptoms" id="symptoms" rows="5" cols="10" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900" placeholder="Enter your symptoms"></textarea>
                </div>
                <div class="flex items-center my-4">
                    <input type="checkbox" name="agree" id="agree" class="mr-2 focus:ring-2 focus:ring-main rounded">
                    <label for="agree" class="text-gray-700">I accept the <a href="#" class="text-main hover:text-blue-700 hover:underline">terms</a> and <a href="#" class="text-main hover:text-blue-700 hover:underline">privacy policy</a></label>
                </div>
                <div class="my-4 flex items-center justify-center space-x-4">
                    <button type="submit" class="bg-sky-500 hover:bg-sky-600 rounded-lg px-8 py-2 text-white hover:shadow-xl transition duration-150 uppercase">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
