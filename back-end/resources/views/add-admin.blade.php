@extends('layout.app')

@section('content')
<div class="w-full min-h-screen flex items-center justify-center">
    <div class="w-full py-8">
        <div class="bg-white w-4/5 md:w-2/3 lg:w-1/2 xl:w-[600px] 2xl:w-[700px] mt-8 mx-auto px-16 py-8 rounded-lg shadow-2xl">

            <h2 class="text-center text-3xl font-bold tracking-wide text-main">Sign Up For Admin</h2>
          
            <form class="my-8 text-sm" action="{{ route('signup') }}" method="post">
                @csrf
            
                <div class="flex flex-col my-4">
                    <label for="patient_profile" class="text-gray-700">Profile Picture</label>
                    <input type="file" name="admin_profile" id="admin_profile" class="mt-2 p-2 border border-main focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" required>
                </div>
                
                <div class="flex flex-col my-4">
                    <label for="name" class="text-gray-700">Name</label>
                    <input type="text" name="name" id="name" class="mt-2 p-2 border border-main focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your name" required>
                </div>

                <div class="flex flex-col my-4">
                    <label for="email" class="text-gray-700">Email Address</label>
                    <input type="email" name="email" id="email" class="mt-2 p-2 border border-main focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your email" required>
                </div>

                <div class="flex flex-col my-4">
                    <label for="password" class="text-gray-700">Password</label>
                    <div class="relative flex items-center mt-2">
                        <input type="password" name="password" id="password" class="flex-1 p-2 pr-10 border border-main focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your password" required>
                    </div>
                </div>

                <div class="flex flex-col my-4">
                    <label for="password_confirmation" class="text-gray-700">Password Confirmation</label>
                    <div class="relative flex items-center mt-2">
                        <input :type="password" name="password_confirmation" id="password_confirmation" class="flex-1 p-2 pr-10 border border-main focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your password again" required>  
                    </div>
                </div>

                <div class="my-4 flex items-center justify-center space-x-4">
                    <button class="bg-sky-500 hover:bg-main rounded-lg px-8 py-2 text-gray-100 hover:shadow-xl transition duration-150 uppercase">Sign Up</button>
                </div>
            </form>

            <div class="flex justify-center items-center mt-6">
                <a href="/login" class="inline-flex items-center font-bold text-blue-500 hover:text-blue-700 text-xs text-center">
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
