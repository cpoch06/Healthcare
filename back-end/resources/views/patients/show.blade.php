@extends('layout.app')

@section('content')
    
<div class="p-5 mt-10 max-w-5xl mx-auto">
    <div class="flex flex-row max-lg:flex-col max-lg:text-center">
        <img src="{{ asset('asset/profile_pics/' . $patient->patient_profile) }}" alt="patient" class="rounded-full h-40 w-40 object-cover cursor-pointer self-center mt-2"/>
        <div class="ml-10 max-lg:mt-10">
            <h2 class="text-2xl font-semibold text-gray-800">{{ $patient->patient_Fname }} {{ $patient->patient_Lname }}</h2>
            <div class="text-sm text-gray-500">{{ $patient_info->patient_nationality }}</div>
            <div class="mt-5">
                <div class="flex flex-row gap-5 max-lg:justify-center">
                    <div>
                        <div class="text-sm text-gray-500">Patient Id</div>
                        <div class="text-lg font-semibold"> {{$patient->patient_id}} </div>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">Last Visit</div>
                        <div class="text-lg font-semibold"> {{$patient_info->patient_visit }} </div>
                    </div>

                    <div>
                        <div class="text-sm text-gray-500">Age</div>
                        <div class="text-lg font-semibold"> {{$patient->patient_age}} </div>
                    </div>
                </div>

                <div class="mt-5">
                    <div class="text-sm text-gray-500">Gender</div>
                    <div class="text-lg font-semibold"> {{ $patient->gender  }} </div>
                </div>  
            </div>  
        </div>

        <div class="ml-20 max-lg:mt-5 max-xl:ml-10 ">
            <div class="flex flex-row gap-5 max-lg:justify-center">
                <div>
                    <div class="text-sm text-gray-500">Height</div>
                    <div class="text-lg font-semibold"> {{ $patient_info->height }} cm </div>
                </div>
                <div>
                    <div class="text-sm text-gray-500">Weight</div>
                    <div class="text-lg font-semibold"> {{ $patient_info->weight }} kg</div>
                </div>
            </div>

            <div class="mt-5">
                <div class="text-sm text-gray-500">Blood Group</div>
                <div class="text-lg font-semibold"> {{ $patient_info->blood_type }} </div>
            </div>
        </div>

        <div class="ml-20 mt-5 max-xl:ml-10 flex-row" >
       
                <div>
                    <div class="text-xl">130/{{$patient_info->blood_pressure}}</div>
                    <div class="text-sm text-gray-500">Blood Pressure</div>
                </div>
        </div>
    </div>
    <div class="patient-tab ">
        <div class="mt-6 border-b border-gray-200 ">
            <nav class="flex gap-10 items-center justify-center font-bold max-xl:gap-5 max-md:gap-0 max-sm:text-sm">
            <button class="tab-button text-gray-600 py-4 px-6 block hover:cursor-pointer hover:bg-sky-500 hover:text-blue-500 focus:outline-none active" data-tab="info">Patient Info</button>
            <button class="tab-button text-gray-600 py-4 px-6 block hover:cursor-pointer hover:bg-sky-500 hover:text-blue-500 focus:outline-none" data-tab="history">Patient History</button>
            <button class="tab-button text-gray-600 py-4 px-6 block hover:cursor-pointer hover:bg-sky-500 hover:text-blue-500 focus:outline-none" data-tab="plans">Plans</button>

            <button class="tab-button text-gray-600 py-4 px-6 block hover:cursor-pointer hover:bg-sky-500 hover:text-blue-500 focus:outline-none" data-tab="medications">Medications</button>
            </nav>
        </div>
        <div class="content text-center text-xl mx-8 max-xl:text-lg max-lg:text-md max-sm:text-sm max-sm:mx-5">
            <div id="info" class="tab-content active p-6">
                <p> {{ $patient_info->patient_info }} 
                </p>
            </div>
            <div id="history" class="tab-content p-6">
                <p> {{ $patient_info->patient_history }} </p>
            </div>
            <div id="plans" class="tab-content p-6">
                <p>{{ $patient_info->patient_plan }}</p>
            </div>
            <div id="medications" class="tab-content p-6">
                <p> {{ $patient_info->medications }}</p>
            </div>
        </div>
        </div>
    </div>
            
</div>

<script>

    document.querySelectorAll('.tab-button').forEach(button => {
    button.addEventListener('click', () => {
      // Remove  active from all buttons
      document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
      // Add active to the clicked button
      button.classList.add('active');
      
      // Remove active from all tab content
      document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
      // Add active to the corresponding tab content
      const tabContentId = button.getAttribute('data-tab');
      document.getElementById(tabContentId).classList.add('active');
    });
  });

</script>
@endsection