@extends('layout.app')

@section('content')

    <div class="about flex items-center justify-center">
        <div class="text-center mb-14">
           <a href="/about" class="text-6xl mb-4 text-white font-light max-xl:text-4xl max-lg:text-3xl">About our Hospital</a>
           <hr class="mt-3 w-11/12 ml-3"/>
        </div>
    </div>

    <div class="justify-center mt-10 max-w-7xl mx-auto">
        
        <hr class="mb-7" />
        <h1 class="text-4xl max-xl:text-4xl max-lg:text-3xl text-center" >HISTORY AND BACKGROUND</h1>
        <hr class="mt-7"/>

        <p class="mt-7" >Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
            when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
            It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the 
            release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that
            it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages 
            and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have 
            evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
        </p>
    </div>

    <div class="flex flex-col w-full lg:flex-row mt-10">
        <div class="grid flex-grow">
            <img src="asset/HILmr.png" alt="">
        </div>

        <div class="grid flex-grow items-center max-w-3xl mx-auto ">
            <div class="text-center">
                <h2 class="text-3xl" >Our Location</h2>
                <p class="mt-5" >Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                It has survived not only five centuries</p>
            </div>
        </div>
    </div>

@endsection
