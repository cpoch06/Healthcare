@extends('layout.app')

@section('content')

    <div class="flex flex-col justify-center mt-9">
        <h1 class="font-semibold text-center text-2xl text-red-500" >Our Doctors</h1>
        <p class="mt-5 text-center" >Our Doctors who are highly expertise in various specialities will 
            provide you with the appropriate treatment</p>

        <hr class="w-64 text-center mx-auto mt-5" >
    </div>

    @foreach($doctors as $doctor)
    <div class="flex max-w-7xl mx-auto mt-12 max-xl:ml-10">
        <div class="flex-col basis-1/3 flex-grow-1 justify-center">
            <h1 class="mb-4 font-bold text-xl" >Dr. {{ $doctor->doctor_Fname }} {{ $doctor->doctor_Lname }}</h1>
            <img src="{{ asset($doctor->doctor_profile ?? 'default_profile.png') }}" alt="doctor" class="w-44 h-52 rounded-full border-2" >
            
            <div class="mt-5">
                <span class="font-semibold" >Speciality: </span> <span class="ml-2" >{{ $doctor->doctorInfo->speciality }}</span>
            </div>

            <a href="{{ route('doctor.show', $doctor->doctor_id) }}"><button class="btn btn-outline btn-info mt-5 rounded-none w-48">Profile</button></a>
            <a href="/chat"><button></button></a>
        </div>

        <div class="flex-col flex-grow basis-2/3">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-xl font-semibold underline">Education</h2>
                <ul class="list-disc list-inside ml-4">
                    @foreach(explode("\n", $doctor->doctorInfo->edu_background) as $edu)
                        <li>{{ $edu }}</li>
                    @endforeach
                </ul>

                <h2 class="text-xl font-semibold mt-5 underline">Fellowship</h2>
                <ul class="list-disc list-inside ml-4">
                    @foreach(explode("\n", $doctor->doctorInfo->fellowships) as $fellowship)
                        <li>{{ $fellowship }}</li>
                    @endforeach
                </ul>

                <h2 class="text-xl font-semibold mt-5 underline">Professional Experiences</h2>
                <ul class="list-disc list-inside ml-4">
                    <li>Instructor, Department of Orthopedic, Chulalongkorn Hospital, Thailand, 2007-2014</li>
                    <li>Spine Surgeon, Department of Orthopedic, Chulalongkorn Hospital, Thailand</li>
                </ul>

                <div class="space-x-4">
                    <button class="btn btn-outline btn-info mt-5 rounded-none w-48" onclick="toggle_schedule('schedule{{ $doctor->doctor_id }}')">Clinic Hour</button>
                    <a href="/booking-form"><button class="btn btn-outline btn-info mt-5 rounded-none w-48">Make an appointment</button></a>
                </div>

                <div id="schedule{{ $doctor->doctor_id }}" class="container mx-auto mt-8 p-4 bg-white rounded-lg shadow-md" style="display: none;">
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="text-left">
                                <th class="px-4 py-2">Day</th>
                                <th class="px-4 py-2">From</th>
                                <th class="px-4 py-2">To</th>
                                <th class="px-4 py-2">Week</th>
                                <th class="px-4 py-2">Center</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(explode(',', $doctor->doctorInfo->work_days) as $day)
                                <tr class="border-t">
                                    <td class="px-4 py-2">{{ $day }}</td>
                                    <td class="px-4 py-2">{{ $doctor->doctorInfo->work_start_hour }}</td>
                                    <td class="px-4 py-2">{{ $doctor->doctorInfo->work_end_hour }}</td>
                                    <td class="px-4 py-2"></td>
                                    <td class="px-4 py-2"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <hr class="mt-10 max-w-7xl mx-auto">
    @endforeach

@endsection
