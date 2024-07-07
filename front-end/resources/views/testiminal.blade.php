@extends('layout.app')

@section('content')
<h1 class="text-center font-bold text-main text-4xl mt-10">PATIENT TESTIMONIAL</h1>
<p class="text-center text-md text-gray-600 mt-2">Healthcare Service Hospital appreciates your trust and confidence in our medical service</p>

<div class="max-w-7xl mx-auto mt-14 flex justify-center text-center">
    <div class="grid grid-cols-4 gap-4">
        @foreach ($reviews as $review)
        <div class="flex flex-col items-center justify-center rounded-xl bg-white shadow-md">
            <div class="h-52 overflow-hidden rounded-t-xl">
                <img src="{{ asset('asset/profile_pics/' . $review->patient->patient_profile) }}" class="w-full h-52 object-cover" alt="Patient Image">
            </div>
            <div class="p-2">
                <p class="font-medium text-blue-gray-900 text-lg">{{ $review->first_name }} {{ $review->last_name }}</p>
            </div>

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

            <div class="p-2">
                <p class="text-gray-600 text-sm max-w-sm">{{ $review->message }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="my-6 flex items-center justify-center">
    <a href="/review"><button class="bg-sky-500 hover:bg-main rounded-lg px-8 py-2 text-gray-100 hover:shadow-xl transition duration-150 uppercase">Send Us A Review</button></a>
</div>
@endsection
