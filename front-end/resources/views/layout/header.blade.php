<header class='header shadow-md max-xl:text-xs'>
    <div class='flex justify-between items-center max-w-7xl mx-auto p-3 max-xl:max-w-5xl max-lg:max-w-4xl max-md:max-w-2xl'>
        
        <a href="/" class="font-bold text-2xl sm:text-xl3 flex flex-wrap hover:underline hover:cursor-pointer">
            <span class='text-sky-500'>Paragon</span>
            <span class='text-sky-700'>Healthcare</span>
        </a>
        
        <ul class='flex text-lg gap-6 max-md:hidden' id="menu">
            
            <li class='hidden sm:inline hover:underline hover:cursor-pointer'><a href="/">Home</a></li>
            
            <li class='hidden sm:inline hover:underline hover:cursor-pointer'><a href="/about">About</a></li>

            <li class='hidden sm:inline hover:underline hover:cursor-pointer'><a href="/doctor">Doctors</a></li>

            @if(Auth::guard('patient')->check())
                <li class='hidden sm:inline hover:underline hover:cursor-pointer'><a href="/appointments">Appointment</a></li>
                <li class='hidden sm:inline hover:underline hover:cursor-pointer'>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="underline bg-transparent border-0 cursor-pointer">Log Out</button>
                    </form>
                </li>
            @elseif(Auth::guard('doctor')->check()) 
                <li class='hidden sm:inline hover:underline hover:cursor-pointer'><a href="/doctor/appointments">Appointments</a></li>
                <li class='hidden sm:inline hover:underline hover:cursor-pointer'>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="underline bg-transparent border-0 cursor-pointer">Log Out</button>
                    </form>
                </li>

            @else
                <li class='hidden sm:inline hover:underline hover:cursor-pointer'>
                    <a href="/login">Log In</a>/<a href="/signup">Sign Up</a>
                </li>
            @endif

        </ul>

        <button class='md:hidden bg-slate-300 rounded-md w-8 h-8' onclick='toggle_menu()'>
            <i class="bi bi-three-dots-vertical"></i>
        </button>

    </div>
</header>

<script>
function toggle_menu() {
    var menu = document.getElementById("menu");
    if (menu.style.display === "none") {
        menu.style.display = "flex";
    } else {
        menu.style.display = "none";
    }
}
</script>
