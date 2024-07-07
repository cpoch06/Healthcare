@extends('layout.app')

@section('content')

<div class="w-full min-h-screen flex items-center justify-center">
    <div class="w-full py-8">
        <div class="border bg-white w-screen md:w-3/4 sm:w-2/3 lg:w-1/2 xl:w-[800px] mx-auto py-8 px-8 rounded-lg shadow-lg">
            <h2 class="text-center text-3xl font-bold tracking-wide text-main">Edit Doctor Information</h2>
            
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-500 text-white p-4 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-500 text-white p-4 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('doctor.update', $doctor->doctor_id) }}" method="POST" class="my-10 text-sm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="flex flex-col my-4">
                    <label for="last-name" class="text-gray-700">Last Name</label>
                    <input type="text" name="doctor_Lname" id="last-name" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900" value="{{ $doctor->doctor_Lname }}">
                </div>
                <div class="flex flex-col my-4">
                    <label for="first-name" class="text-gray-700">First Name</label>
                    <input type="text" name="doctor_Fname" id="first-name" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900" value="{{ $doctor->doctor_Fname }}">
                </div>
                <div class="flex flex-col my-4">
                    <label for="age" class="text-gray-700">Age</label>
                    <input type="number" name="doctor_age" id="age" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900" value="{{ $doctor->doctor_age }}">
                </div>
                <div class="flex flex-col my-4">
                    <span class="text-gray-700">Gender</span>
                    <div class="flex items-center mt-2">
                        <input type="radio" name="gender" id="male" value="Male" class="mr-2 focus:ring-2 focus:ring-main rounded" {{ $doctor->gender == 'Male' ? 'checked' : '' }}>
                        <label for="male" class="text-gray-700 mr-4">Male</label>
                        <input type="radio" name="gender" id="female" value="Female" class="mr-2 focus:ring-2 focus:ring-main rounded" {{ $doctor->gender == 'Female' ? 'checked' : '' }}>
                        <label for="female" class="text-gray-700">Female</label>
                    </div>
                </div>
                <div class="flex flex-col my-4">
                    <label for="email" class="text-gray-700">Email Address</label>
                    <input type="email" name="doctor_email" id="email" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900" value="{{ $doctor->doctor_email }}">
                </div>
                <div class="flex flex-col my-4">
                    <label for="password" class="text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900" placeholder="Enter new password if you want to change it">
                </div>
                <div class="flex flex-col my-4">
                    <label for="password_confirmation" class="text-gray-700">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900" placeholder="Confirm new password">
                </div>

                <div class="flex flex-col my-4">
                    <label for="doctor_profile" class="text-gray-700">Profile</label>
                    <input type="file" name="doctor_profile" id="doctor_profile" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900">
                </div>

                <div class="flex flex-col my-4">
                    <label for="phone" class="text-gray-700">Phone Number</label>
                    <input type="text" name="phone_number" id="phone" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900" value="{{ $doctor->phone_number }}">
                </div>

                <div class="flex flex-col my-4">
                    <label for="specialist" class="text-gray-700">Specialist</label>
                    <input type="text" name="speciality" id="specialist" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900" value="{{ $doctor->doctorInfo->speciality }}">
                </div>
                <div class="flex flex-col my-4">
                    <label for="experience" class="text-gray-700">Experience</label>
                    <input type="number" name="experience" id="experience" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900" value="{{ $doctor->doctorInfo->experience }}">
                </div>
                <div class="flex flex-col my-4">
                    <label for="education" class="text-gray-700">Educational Background</label>
                    <textarea name="edu_background" placeholder="Enter your educational background" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900" id="education" cols="30" rows="5">{{ $doctor->doctorInfo->edu_background }}</textarea>
                </div>
                <div class="flex flex-col my-4">
                    <label for="work_days" class="text-gray-700">Work Days</label>
                    <div class="flex flex-wrap mt-2">
                        @php
                            $work_days = explode(',', $doctor->doctorInfo->work_days);
                        @endphp
                        @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                            <div class="flex items-center mr-4 mb-2">
                                <input type="checkbox" name="work_days[]" id="{{ strtolower($day) }}" value="{{ $day }}" class="mr-2 focus:ring-2 focus:ring-main rounded" {{ in_array($day, $work_days) ? 'checked' : '' }}>
                                <label for="{{ strtolower($day) }}" class="text-gray-700">{{ $day }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="flex flex-col my-4">
                    <label for="work_hours" class="text-gray-700">Work Hours</label>
                    <div class="flex items-center mt-2">
                        <input type="time" name="work_start_hour" id="work_start_hour" class="mr-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900" value="{{ $doctor->doctorInfo->work_start_hour }}">
                        <span class="text-gray-700 mr-2">to</span>
                        <input type="time" name="work_end_hour" id="work_end_hour" class="mr-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900" value="{{ $doctor->doctorInfo->work_end_hour }}">
                    </div>
                </div>
                <div class="flex flex-col my-4">
                    <label for="fellowships" class="text-gray-700">Fellowships</label>
                    <textarea name="fellowships" placeholder="Enter your fellowships" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-main rounded text-sm text-gray-900" id="fellowships" cols="30" rows="5">{{ $doctor->doctorInfo->fellowships }}</textarea>
                </div>
                <div class="my-4 flex items-center justify-center space-x-4">
                    <button type="submit" class="bg-sky-500 hover:bg-main-dark rounded-lg px-8 py-2 text-white hover:shadow-xl transition duration-150 uppercase">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
