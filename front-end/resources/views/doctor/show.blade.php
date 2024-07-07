@extends('layout.app')

@section('content')

    <div class="flex max-w-6xl mx-auto mt-20">
        <div class="flex-col basis-1/3 flex-grow-1 justify-center">
            <h1 class="mb-4 font-bold text-xl" >Dr. {{ $doctor->doctor_Fname }} {{ $doctor->doctor_Lname }}</h1>
            <img src="{{ asset($doctor->doctor_profile ?? 'default_profile.png') }}" alt="doctor" class="w-44 h-52 rounded-full border-2" >

            <div class="mt-5">
                <span class="font-semibold" >Speciality: </span> <span class="ml-2" >{{ $doctor->doctorInfo->speciality }}</span>
            </div>

            <div class="mt-2">
                <span class="font-semibold" >Experience: </span> <span class="ml-2" >{{ $doctor->doctorInfo->experience }} years</span>
            </div>

            <div class="mt-2">
                <button class="btn btn-outline btn-info mt-5 rounded-none w-48 transform transition duration-300 ease-in-out hover:scale-105 hover:bg-info hover:text-white" onclick="openMailModal()">
                    Contact
                </button>
            </div>

            
            <!-- Send mail -->
            <!-- <a href="mailto: " class="btn btn-outline btn-info mt-5 rounded-none w-48 transform transition duration-300 ease-in-out hover:scale-105 hover:bg-info hover:text-white"></a> -->

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
                    <button class="btn btn-outline btn-info mt-5 rounded-none w-48" onclick="toggle_schedule('schedule1')">Clinic Hour</button>
                    <a href="/booking-form"><button class="btn btn-outline btn-info mt-5 rounded-none w-48">Make an appointment</button></a>
                </div>

                <div id="schedule1" class="container mx-auto mt-8 p-4 bg-white rounded-lg shadow-md" style="display: none;">
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


     <div id="emailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-30 mx-auto p-5 border w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Send an Email</h3>
                <div class="mt-2 px-7 py-3">
                    <form id="contactForm">
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">To</label>
                            <input type="email" id="email" name="email" value="{{ $doctor->doctor_email }}" readonly class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                            <input type="text" id="subject" name="subject" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                            <textarea id="message" name="message" rows="10" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2" onclick="closeMailModal()">Cancel</button>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

<!-- JavaScript for Modal -->
   <script>
        function openMailModal() {
            document.getElementById('emailModal').classList.remove('hidden');
        }

        function closeMailModal() {
            document.getElementById('emailModal').classList.add('hidden');
        }
        

        document.getElementById('contactForm').addEventListener('submit', function(event) {
            event.preventDefault();
            alert('Email sent successfully!');
            closeMailModal();
        });
    </script>