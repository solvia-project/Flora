<x-app>
    <x-slot name="navbar">
        <x-navbar />
    </x-slot>

    <section class="min-h-screen flex items-center justify-center bg-center bg-cover"
             style="background-image: url('{{ asset('img/bg/aboutus.png') }}');">
        <div class="max-w-7xl mx-auto text-center flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8">

            <h5 class="text-gray-600 mt-3 text-xl sm:text-2xl md:text-3xl">
                About<br><span class="underline">FloraLearn</span>
            </h5>
            <div class="flex flex-col gap-2 px-40">
            <p class="bg-white">At FloraLearn, we believe that everyone has the ability to create something beautiful — no matter their background or experience. Inspired by a passion for flowers and creativity, FloraLearn offers welcoming and hands-on flower arrangement classes for anyone who wishes to explore the art of floral design. Our mission is simple: to help you relax, learn new skills, and express yourself through flowers.</p>
            <p class="bg-white">Born from a simple love for flowers and the joy of creativity, FloraLearn has grown from a small passion project into a space where people can connect, create, and find peace in every petal. Each class is designed to be joyful, inspiring, and full of blooming creativity.</p>
            </div>
            <div class="mt-8">
                <p class="bg-black text-white py-2 px-6 rounded inline-block text-sm sm:text-base cursor-pointer hover:bg-gray-800 transition">
                    Book Now
                </p>
            </div>
        </div>
    </section>
    {{-- contact --}}
    <section class="flex flex-col items-center justify-center">
        <h1>Contact Us</h1>
        <p>floralearn@gmail.com</p>
        <p>@floralearn </p>
    </section>
    {{-- meet instructor --}}
    <section class="flex flex-col bg-white justify-center items-center">
        <h1>Meet Our Intructor</h1>
        <div class="w-full flex">
            <img src="{{ asset('img/profile.png') }}" alt="" class="w-20 h-full">
            <div>
                <p>Wonny Aiko – Floral Instructor & Founder of FloraLearn</p>
                <p>With years of experience in floral design, Wonny brings warmth and creativity to every class she teaches. She believes that arranging flowers is not just about technique, but also about expressing emotions and finding calm through art. Her friendly guidance helps each participant discover their own style while enjoying a relaxing, hands-on experience.</p>
            </div>
        </div>
    </section>

</x-app>
