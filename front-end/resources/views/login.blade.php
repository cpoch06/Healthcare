@extends('layout.app')

@section('content')

<div class="min-h-screen flex flex-col items-center justify-center bg-gray-100">
  <div class="flex flex-col bg-white shadow-md px-8 sm:px-10 md:px-12 lg:px-14 py-10 rounded-lg w-full max-w-lg">
    <div class="font-medium self-center text-2xl sm:text-3xl uppercase text-main">Login</div>
    <div class="mt-10">
      <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="flex flex-col mb-6">
          <label for="user_type" class="mb-2 text-sm sm:text-base tracking-wide text-gray-600">Login as</label>
          <select id="user_type" name="user_type" class="text-sm sm:text-base pl-3 pr-4 rounded-lg border border-main w-full py-3 focus:outline-none focus:border-blue-400">
            <option value="patient">Patient</option>
            <option value="doctor">Doctor</option>
          </select>
        </div>
        <div class="flex flex-col mb-6">
          <label for="email" class="mb-2 text-sm sm:text-base tracking-wide text-gray-600">Email</label>
          <div class="relative">
            <div class="inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-400">
              <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
              </svg>
            </div>
            <input id="email" type="email" name="email" class="text-sm sm:text-base placeholder-gray-500 pl-12 pr-4 rounded-lg border border-main w-full py-3 focus:outline-none focus:border-blue-400" placeholder="Enter your Email Address" required />
          </div>
        </div>
        <div class="flex flex-col mb-6">
          <label for="password" class="mb-2 text-sm sm:text-base tracking-wide text-gray-600">Password</label>
          <div class="relative">
            <div class="inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-400">
              <span>
                <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                  <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
              </span>
            </div>
            <input id="password" type="password" name="password" class="text-sm sm:text-base placeholder-gray-500 pl-12 pr-10 rounded-lg border border-main w-full py-3 focus:outline-none focus:border-blue-400" placeholder="Password" required />
            <div class="inline-flex items-center justify-center absolute right-0 top-0 h-full w-10 text-gray-400 cursor-pointer">
              <span onclick="togglePasswordVisibility()">
                <svg id="password-icon" class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                  <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.543 7-.2.672-.492 1.31-.866 1.896m-1.666 1.67C18.268 16.057 14.478 19 10 19c-4.478 0-8.268-2.943-9.543-7 .2-.672.492-1.31.866-1.896m1.666-1.67L12 12m0 0l3.535 3.536" />
                </svg>
              </span>
            </div>
          </div>
        </div>
        <div class="flex items-center mb-6 -mt-4">
          <div class="flex ml-auto">
            <input type="checkbox" class="mr-1">
            <span class="inline-flex text-xs sm:text-sm text-main hover:text-blue-700">Remember me</span>
          </div>
        </div>
        <div class="flex w-full">
          <button type="submit" class="flex items-center justify-center focus:outline-none text-white text-sm sm:text-base bg-sky-500 hover:bg-blue-700 rounded py-3 w-full transition duration-150 ease-in">
            <span class="mr-2 uppercase">Login</span>
            <span>
              <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </span>
          </button>
        </div>
      </form>
    </div>
    <div class="flex justify-end mt-4">
      <a href="#" class="text-xs text-gray-500 hover:text-main">Forgot Your Password?</a>
    </div>
    <div class="flex justify-center items-center mt-6">
      <a href="/signup" class="inline-flex items-center font-bold text-blue-500 hover:text-blue-700 text-xs text-center">
        <span>
          <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
            <path d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
          </svg>
        </span>
        <span class="ml-2">Don't Have an account?</span>
      </a>
    </div>
  </div>
</div>

<script>
    function togglePasswordVisibility() {
    const passwordInput = document.getElementById('password');
    const passwordIcon = document.getElementById('password-icon');
    const isPasswordVisible = passwordInput.type === 'text';
    
    if (isPasswordVisible) {
      passwordInput.type = 'password';
      passwordIcon.innerHTML = `
        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.543 7-.2.672-.492 1.31-.866 1.896m-1.666 1.67C18.268 16.057 14.478 19 10 19c-4.478 0-8.268-2.943-9.543-7 .2-.672.492-1.31.866-1.896m1.666-1.67L12 12m0 0l3.535 3.536" />
      `;
    } else {
      passwordInput.type = 'text';
      passwordIcon.innerHTML = `
        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.543 7-.2.672-.492 1.31-.866 1.896m-1.666 1.67C18.268 16.057 14.478 19 10 19c-4.478 0-8.268-2.943-9.543-7 .2-.672.492-1.31.866-1.896m1.666-1.67L12 12m0 0l3.535 3.536" />
      `;
    }
  }
</script>

@endsection
