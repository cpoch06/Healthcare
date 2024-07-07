@extends('layout.app')

@section('content')

<!-- ADD NEW DOCTOR BUTTON and search for doctor -->
<div class="flex flex-row-reverse mt-10 gap-10">
    <div class="flex flex-row items-center">
        <a href="/add-doctor"><button class="btn btn-primary rounded-none w-48">Add New Doctor</button></a>
    </div>
    <div class="flex flex-row items-center">
        <form action="{{ route('doctor.index') }}" method="GET" class="bg-slate-100 p-3 rounded-lg flex items-center md:text-sm">
            <input type="text" id="search" name="query" placeholder='Search...' class='bg-transparent focus:outline-none w-24 sm:w-64' value="{{ request()->input('query') }}"/>
            <button type='submit' class='text-slate-500'>
                <i class="bi bi-search"></i>
            </button>
        </form>    
    </div>
</div>

<hr class="mt-10 max-w-7xl mx-auto">

<div id="doctors-list">
    @foreach($doctors as $doctor)
    <div class="flex ml-16 mt-12">
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
                <button onclick="openModal('{{ $doctor->doctor_id }}')" class="btn btn-outline btn-error mt-5 rounded-none w-48 hover:text-white">Delete</button>
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
    <div id="deleteModal{{ $doctor->doctor_id }}" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg p-8 shadow-lg w-96">
            <h2 class="text-xl font-semibold mb-4">Confirm Deletion</h2>
            <p>Are you sure you want to delete this doctor?</p>
            <div class="mt-8 flex justify-center gap-4  ">
                <button onclick="closeModal('{{ $doctor->doctor_id }}')" class="bg-gray-500 hover:bg-gray-700 text-white py-2 h-16 w-24 px-4 rounded">Cancel</button>
                <form id="deleteForm{{ $doctor->doctor_id }}" action="{{ route('doctor.destroy', ['id' => $doctor->doctor_id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 h-16 w-24 rounded">Delete</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection

<script>
function openModal(doctorId) {
    document.getElementById('deleteModal' + doctorId).classList.remove('hidden');
}

function closeModal(doctorId) {
    document.getElementById('deleteModal' + doctorId).classList.add('hidden');
}

function toggle_schedule(scheduleId) {
    document.getElementById(scheduleId).classList.toggle('hidden');
}
</script>
