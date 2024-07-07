@extends('layout.app')

@section('content')
<div class="w-full min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full py-8">
        <div class="bg-white w-4/5 md:w-2/3 lg:w-1/2 xl:w-[600px] 2xl:w-[700px] mt-8 mx-auto px-16 py-8 rounded-lg shadow-2xl">
            <h2 class="text-center text-3xl font-bold tracking-wide text-main">Sign Up</h2>
            <p class="text-center text-sm text-gray-600 mt-2">Already have an account? <a href="/login" class="text-main hover:text-blue-700 hover:underline" title="Sign In">Sign in here</a></p>

                <form class="my-8 text-sm" action="{{ route('signup') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col my-4">
                        <label for="patient_Fname" class="text-gray-700">First Name</label>
                        <input type="text" name="patient_Fname" id="patient_Fname" class="mt-2 p-2 border border-main focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your first name" required>
                    </div>

                    <div class="flex flex-col my-4">
                        <label for="patient_Lname" class="text-gray-700">Last Name</label>
                        <input type="text" name="patient_Lname" id="patient_Lname" class="mt-2 p-2 border border-main focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your last name" required>
                    </div>

                    <div class="flex flex-col my-4">
                        <label for="patient_age" class="text-gray-700">Age</label>
                        <input type="number" name="patient_age" id="patient_age" class="mt-2 p-2 border border-main focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your age" required>
                    </div>

                    <div class="flex flex-col my-4">
                        <span class="text-gray-700">Gender</span>
                        <div class="flex items-center mt-2 space-x-4">
                            <div class="flex items-center">
                                <input type="radio" name="gender" id="male" value="Male" class="mr-2 focus:ring-0 rounded">
                                <label for="male" class="text-gray-700">Male</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" name="gender" id="female" value="Female" class="mr-2 focus:ring-0 rounded">
                                <label for="female" class="text-gray-700">Female</label>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col my-4">
                        <label for="patient_email" class="text-gray-700">Email Address</label>
                        <input type="email" name="patient_email" id="patient_email" class="mt-2 p-2 border border-main focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your email" required>
                    </div>

                    <div class="flex flex-col my-4">
                        <label for="phone_number" class="text-gray-700">Phone Number</label>
                        <input type="tel" name="phone_number" id="phone_number" class="mt-2 p-2 border border-main focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your phone number" required>
                    </div>

                    <div class="flex flex-col my-4">
                        <label for="password" class="text-gray-700">Password</label>
                        <div x-data="{ show: false }" class="relative flex items-center mt-2">
                            <input :type=" show ? 'text' : 'password' " name="password" id="password" class="flex-1 p-2 pr-10 border border-main focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your password" required>
                            <button @click="show = !show" type="button" class="absolute right-2 bg-transparent flex items-center justify-center text-gray-700">
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                                <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex flex-col my-4">
                        <label for="password_confirmation" class="text-gray-700">Password Confirmation</label>
                        <div x-data="{ show: false }" class="relative flex items-center mt-2">
                            <input :type=" show ? 'text' : 'password' " name="password_confirmation" id="password_confirmation" class="flex-1 p-2 pr-10 border border-main focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your password again" required>
                            <button @click="show = !show" type="button" class="absolute right-2 bg-transparent flex items-center justify-center text-gray-700">
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                                <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex flex-col my-4">
                        <label for="patient_profile" class="text-gray-700">Profile Picture</label>
                        <input type="file" name="patient_profile" id="patient_profile" class="mt-2 p-2 border border-main focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" required>
                    </div>

                    <button type="submit" class="w-full mt-4 bg-main text-black hover:text-white p-2 rounded-lg hover:bg-blue-700">Sign Up</button>
                </form>


            <div class="flex justify-center mt-4">
                <a href="login" class="text-xs text-gray-500 hover:text-main">Already Have an Account?</a>
        </div>
    </div>
</div>
@endsection
