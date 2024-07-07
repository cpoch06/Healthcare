@extends('layout.app')

@section('content')

<div class="flex flex-row-reverse mt-10 gap-10">
    <div class="flex flex-row items-center">
        <a href="/doctors"><button class="btn btn-primary rounded-none w-48">Back to Doctors List</button></a>
    </div>
</div>

<hr class="mt-10 max-w-7xl mx-auto">

<div class="flex ml-16 mt-20">
    <div class="flex-col basis-1/3 flex-grow-1 justify-center">
        <h1 class="mb-4 font-bold text-xl">Dr. {{ $doctor->doctor_Fname }} {{ $doctor->doctor_Lname }}</h1>
        <img src="{{ asset($doctor->doctor_profile ?? 'default_profile.png') }}" alt="doctor" class="w-44 h-52 rounded-full border-2">

        <div class="mt-5">
            <span class="font-semibold">Speciality: </span> <span class="ml-2">{{ $doctor->doctorInfo->speciality }}</span>
        </div>

        <div class="mt-2">
            <span class="font-semibold">Experience: </span> <span class="ml-2">{{ $doctor->doctorInfo->experience }} years</span>
        </div>

        <div class="mt-2">
            <!-- Delete Button -->
            <button onclick="openModal()" class="btn btn-outline btn-error mt-5 rounded-none w-48 hover:text-white">Delete</button>
        </div>
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

            <div class="space-x-4">
                <button class="btn btn-outline btn-info mt-5 rounded-none w-48" onclick="toggle_schedule('schedule{{ $doctor->doctor_id }}')">Clinic Hour</button>
                <a href="/update-doctor/{{ $doctor->doctor_id }}"><button class="btn btn-outline btn-info mt-5 rounded-none w-48">Update Information</button></a>
            </div>

            <div id="schedule{{ $doctor->doctor_id }}" class="container mx-auto mt-8 p-4 bg-white rounded-lg shadow-md hidden">
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

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg p-8 shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Confirm Deletion</h2>
        <p>Are you sure you want to delete Dr. {{ $doctor->doctor_Fname }} {{ $doctor->doctor_Lname }}?</p>
        <div class="mt-8 flex justify-end space-x-4">
            <button onclick="closeModal()" class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">Cancel</button>
            <form action="{{ route('doctor.destroy', $doctor->doctor_id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded">Delete</button>
            </form>
        </div>
    </div>
</div>

@endsection
