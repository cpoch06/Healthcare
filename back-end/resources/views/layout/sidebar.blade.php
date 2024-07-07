<div class="side-bar fixed top-0 bottom-0 lg:left-0 p-2 w-[300px] overflow-y-auto text-center max-lg:w-1/12">
        <div class="text-slate-700 text-xl flex flex-col">
            <div class="p-2.5 mt-1 flex items-center">      
                <i class="bi bi-app-indicator px-2 py-1 bg-sky-600 rounded-md"></i>
                <h1 class="font-bold text-slate-700 text-[15px] ml-3 max-lg:hidden"><a href="/home">Paragon Healthcare</a></h1>   
            </div>
            <hr class="my-2 text-slate-600">

            <div class="p-2.5 m5-3 flex items-center rounded px-4 duration-300 cursor-pointer hover:bg-sky-600 text-white">
                <a href="/home">
                    <i class="bi bi-house-fill text-slate-700"></i>
                    <span class="text-[15px] font-bold ml-2 text-slate-700 max-lg:hidden">Home</span>
                </a>
            </div>

            <div class="p-2.5 m5-3 flex items-center rounded px-4 duration-300 cursor-pointer hover:bg-sky-600 text-white">
                <a href="/doctors">
                    <i class="bi bi-people text-slate-700"></i>
                    <span class="text-[15px] font-bold ml-2 text-slate-700 max-lg:hidden">Doctors</span>
                </a>
            </div>

            <div class="p-2.5 m5-3 flex items-center rounded px-4 duration-300 cursor-pointer hover:bg-sky-600 text-white">
                <a href="/patients">
                <i class="bi bi-person-heart text-slate-700"></i>
                    <span class="text-[15px] font-bold ml-2 text-slate-700 max-lg:hidden">Patients</span>
                </a>
            </div>

            <div class="p-2.5 m5-3 flex items-center rounded px-4 duration-300 cursor-pointer hover:bg-slate-600 text-white">
                <a href="/appointment">
                <i class="bi bi-calendar3 text-slate-700"></i>
                    <span class="text-[15px] font-bold ml-2 text-slate-700 max-lg:hidden">Appointments</span>
                </a>
            </div>

            <hr class="my-4 text-slate-700">

            <div class="p-2.5 m5-3 flex items-center rounded-,d px-4 duration-300 cursor-pointer hover:bg-slate-600 text-white">
            <a href="{{ route('profile.show', ['id' => Auth::user()->admin_id]) }}">
                    <i class="bi bi-person text-slate-700"></i>
                    <span class="text-[15px] ml-2 text-slate-700 max-lg:hidden">Profile</span>
                </a>
            </div>

            

            <div class="p-2.5 m5-3 flex items-center rounded-,d px-4 duration-300 cursor-pointer hover:bg-slate-600 text-white">
                <form action="{{route('logout') }}" method="post">
                    @csrf
                    <button type="submit">
                        <i class="bi bi-box-arrow-left text-slate-700"></i>
                        <span class="text-[15px] ml-2 text-slate-700 max-lg:hidden">Log out</span>

                    </button>
                </form>
            </div>
        </div>
    </div>