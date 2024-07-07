@extends('layout.app')

@section('content')
<div class="flex justify-center items-center min-h-full mt-8">
    <div class="w-full max-w-xl bg-white mt-8 mx-auto px-8 py-8 rounded-lg shadow-md">
        <h2 class="text-center text-2xl font-bold tracking-wide text-main mb-6">Leave Us A Review</h2>

        <form class="text-sm" action="{{ route('review_post') }}" method="post">
            @csrf
            <div class="grid grid-cols-2 gap-x-4">
                <div class="flex flex-col my-2">
                    <label for="last_name" class="text-gray-700">Last Name</label>
                    <input type="text" required name="last_name" id="last_name" class="mt-2 p-2 border border-main focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your last name">
                </div>
                <div class="flex flex-col my-2">
                    <label for="first_name" class="text-gray-700">First Name</label>
                    <input type="text" required name="first_name" id="first_name" class="mt-2 p-2 border border-main focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your first name">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-x-4">
                <div class="flex flex-col my-2 items-start">
                    <span for="gender" class="text-gray-700">Gender</span>
                    <div>
                        <input type="radio" name="gender" id="male" value="male" class="mr-2 focus:ring-0 rounded">
                        <label for="male" class="text-gray-700">Male</label>
                    </div>
                    <div>
                        <input type="radio" name="gender" id="female" value="female" class="mr-2 focus:ring-0 rounded">
                        <label for="female" class="text-gray-700">Female</label>
                    </div>
                </div>
                <div class="flex flex-col my-2">
                    <label for="email" class="text-gray-700">Email Address</label>
                    <input type="email" required name="email" id="email" class="mt-2 p-2 border border-main focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your email">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-x-4">
                <div class="flex flex-col my-2">
                    <label for="phone_number" class="text-gray-700">Phone Number</label>
                    <input type="text" required name="phone_number" id="phone_number" class="mt-2 p-2 border border-main focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your phone number">
                </div>
                <div class="flex flex-col my-2">
                    <label for="rating" class="text-gray-700">How do you rate our services?</label>
                    <div class="rating mt-2">
                        <input type="radio" name="rating" value="1" class="mask mask-star-2 bg-sky-500" />
                        <input type="radio" name="rating" value="2" class="mask mask-star-2 bg-sky-500" />
                        <input type="radio" name="rating" value="3" class="mask mask-star-2 bg-sky-500" />
                        <input type="radio" name="rating" value="4" class="mask mask-star-2 bg-sky-500" />
                        <input type="radio" name="rating" value="5" class="mask mask-star-2 bg-sky-500" checked />
                    </div>
                </div>
            </div>

            <div class="my-2">
                <label for="message" class="text-gray-700">Message</label>
                <textarea name="message" id="message" required placeholder="Message" class="mt-2 p-2 border border-main focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900 w-full h-32"></textarea>
            </div>

            <div class="flex items-center justify-center mt-6">
                <button type="submit" class="bg-sky-500 hover:bg-main rounded-lg px-8 py-2 text-gray-100 hover:shadow-xl transition duration-150 uppercase">Submit</button>
            </div>
        </form>
    </div>
</div>

@endsection
