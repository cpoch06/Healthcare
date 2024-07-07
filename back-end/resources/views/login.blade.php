<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="flex justify-center items-center h-fit">
        <img src="asset/logo.jpg" class="w-25 h-24" alt="">
    </header>

    <div class="admin-login">
        <div class="text-center">
            <h1 class="font-bold text-2xl pt-10">Admin Login Page</h1>
            <p class="font-semibold text-xl">Sign in to Paragon Hospital Page</p>
        </div>

        <div class="flex flex-col bg-white items-center justify-center max-w-3xl mx-auto mt-16 min-h-fit px-4">
            <h1 class="mt-10 text-xl text-blue-400">Login</h1>

            <form action="{{ route('login') }}" method="post" class="w-4/5 mx-auto">
                @csrf 
                <div class="flex flex-col mt-10">
                    <label for="email" class="items-start">Email</label>
                    <input type="email" name="email" id="email" class="my-6 text-sm sm:text-base placeholder-gray-500 pl-6 pr-4 rounded-lg border border-main w-full py-2 focus:outline-none focus:border-blue-400" placeholder="Enter your email" required> 
                    @error('email')
                        <div class="text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label for="password" class="items-start">Password</label>
                    <input type="password" name="password" id="password" class="my-6 text-sm sm:text-base placeholder-gray-500 pl-6 pr-4 rounded-lg border border-main w-full py-2 focus:outline-none focus:border-blue-400" placeholder="Enter your password" required>
                    <label for="show-password" class="ml-2 flex items-center space-x-1">
                        <input type="checkbox" id="show-password"> 
                        <span>Show Password</span>
                    </label>
                    @error('password')
                        <div class="text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex items-center mb-6 -mt-4">
                    <div class="flex ml-auto">
                        <input type="checkbox" class="mr-1">
                        <span class="inline-flex text-xs sm:text-sm text-main hover:text-blue-700">Remember me</span>
                    </div>
                </div>

                <div class="flex justify-center mb-20">
                    <button type="submit" class="bg-blue-400 text-white font-semibold w-52 py-2 mb-3 px-4 rounded-lg hover:bg-blue-500">Login</button>
                </div>
            </form>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>
</html>
