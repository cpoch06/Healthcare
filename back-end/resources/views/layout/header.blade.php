<header class="ml-72 shadow-md flex flex-row justify-between max-lg:ml-20 max-md:ml-10">
    <a href="/home"><img src="asset/logo.jpg" class="w-24 h-20 ml-8" alt=""></a>

    <div class="flex flex-row items-center">
        <form action="#" method="" class="bg-slate-100 p-3 rounded-lg flex items-center md:text-sm">
            <input type="text" placeholder='Search...' class='bg-transparent focus:outline-none w-24 sm:w-64'/>
            <button type='submit' class='text-slate-500'>
                <i class="bi bi-search"></i>
            </button>
        </form>    
    </div>

    <div class="flex flex-row items-center">
        <i class="bi bi-envelope mr-5 hover:cursor-pointer max-lg:hidden"></i>
        <i class="bi bi-bell mr-5 hover:cursor-pointer" onclick="toggle_notis()"></i>

        <div class="flex flex-row items-center mr-5">
            <img src="asset/human-men-icon.webp" class="w-10 h-10 rounded-full hover:cursor-pointer" alt="">
            <span class="text-slate-700 font-semibold ml-5">Admin</span>
        </div>  
    </div>


</header>