@extends('layout.app')

@section('content')

<div class="home flex items-center justify-center">
    <div class="text-center">
        <h1 class='text-4xl font-bold'>Welcome to Paragon Healthcare</h1>
        <p class='text-2xl mt-3'>We are here to provide you with the best healthcare services</p>
        <div class="pt-9">
            <button type="submit" class="w-3/12 px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-700">
                <a href="/">Click for more</a>
            </button>
        </div>
    </div>
</div>

<div class="doctor-area mx-auto max-w-7xl mt-10">
    <h1 class="text-center font-semibold text-blue-500 text-3xl">Our Doctors</h1>

    @if(isset($message))
        <p class="text-center text-red-500">{{ $message }}</p>
    @else
        <div class="flex gap-4 mt-10 items-center justify-center">
            @foreach ($doctors as $doctor)
                <div class="card w-96 bg-base-100 shadow-xl">
                    <figure class="px-10 pt-10">
                        <img src="{{ asset($doctor->doctor_profile ?? 'default_profile.png') }}" alt="doctor" class="rounded-2xl border-2 border-sky-500 h-56 w-52" />
                    </figure>
                    <div class="card-body items-center text-center">
                        <h2 class="card-title">Dr. {{ $doctor->doctor_Fname }} {{ $doctor->doctor_Lname }}</h2>
                        <p>Specialised in <hr class=""/> {{ $doctor->speciality }}</p>
                        <div class="card-actions mt-2">
                            <button class="btn btn-outline btn-primary"><a href="/doctor">Doctor Details</a></button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<div class="patient-review mx-auto max-w-7xl mt-10">
    <h1 class="text-center font-semibold text-blue-500 text-3xl">Patient Reviews</h1>

    @if($reviews->isEmpty())
        <p class="text-center text-red-500">No reviews found</p>
    @else
        <div class="flex gap-4 mt-10 items-center justify-center">
            @foreach ($reviews as $review)
                <div class="card w-96 bg-base-100 shadow-xl image-full">
                    <div class="card-body items-center text-center">
                        <h2 class="card-title">{{ $review->last_name }} {{ $review->first_name }}</h2>
                        <p>{{ $review->message }}</p>
                        <div class="flex items-center">
                            @for ($i = 0; $i < 5; $i++)
                                @if ($i < $review->rating)
                                    <svg class="w-6 h-6 text-yellow-500 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M12 17.27l6.18 3.73-1.64-7.03L21 9.24l-7.19-.61L12 2 10.19 8.63 3 9.24l5.46 4.73L6.82 21z"/>
                                    </svg>
                                @else
                                    <svg class="w-6 h-6 text-gray-300 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M12 17.27l6.18 3.73-1.64-7.03L21 9.24l-7.19-.61L12 2 10.19 8.63 3 9.24l5.46 4.73L6.82 21z"/>
                                    </svg>
                                @endif
                            @endfor
                        </div>
                        <div class="avatar">
                            @if($review->patient)
                                <div class="w-24 rounded-full">
                                    <img src="{{ asset('profile_pics/' . $review->patient->patient_profile ) }}" alt="patient" />
                                </div>
                            @else
                                <div class="w-24 rounded-full">
                                    <img src="{{ asset('default_profile.png') }}" alt="patient" />
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="mt-11 flex justify-center items-center">
        <button class="btn btn-xs btn-primary sm:btn-sm md:btn-md lg:btn-lg"><a href="/testiminal">More Reviews</a></button>
    </div>
</div>

@endsection
