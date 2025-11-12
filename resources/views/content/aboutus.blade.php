<x-app>
    <x-slot name="navbar">
        <x-navbar />
    </x-slot>

    {{-- ABOUT SECTION --}}
    <section class="min-h-screen flex items-center justify-center bg-center bg-cover"
             style="background-image: url('{{ asset('img/bg/aboutus.png') }}');">
        <div class="max-w-5xl mx-auto text-center flex flex-col items-center justify-center px-6 py-16 space-y-10">

            {{-- Cloud Heading --}}
            <div class="relative w-full flex justify-center items-center">
                <img src="{{ asset('img/cloud1.png') }}" alt="Cloud" class="w-96 z-0">
                <p class="absolute inset-0 flex flex-col items-center justify-center font-[syne] mt-10 text-gray-700 text-4xl sm:text-5xl md:text-6xl font-semibold z-10 text-center">
                    About<br><span class="underline">FloraLearn</span>
                </p>
            </div>


            {{-- About Text --}}
            <div class="flex flex-col gap-6 bg-white/80 backdrop-blur-sm p-6 rounded-2xl shadow-lg max-w-3xl text-gray-700 text-justify">
                <p>
                    At <span class="font-semibold">FloraLearn</span>, we believe that everyone has the ability to create something beautiful — no matter their background or experience.
                    Inspired by a passion for flowers and creativity, FloraLearn offers welcoming and hands-on flower arrangement classes for anyone who wishes to explore the art of floral design.
                    Our mission is simple: to help you relax, learn new skills, and express yourself through flowers.
                </p>
                <p>
                    Born from a simple love for flowers and the joy of creativity, FloraLearn has grown from a small passion project into a space where people can connect, create, and find peace in every petal.
                    Each class is designed to be joyful, inspiring, and full of blooming creativity.
                </p>
            </div>
        </div>
    </section>

    {{-- CONTACT SECTION --}}
    <section class="flex flex-col items-center justify-center py-4 bg-indigo-50 text-center">
        <h1 class="text-3xl font-semibold font-[syne] text-gray-800 mb-2">Contact Us</h1>
        <a class="text-gray-600">📧 floralearn@gmail.com</a>
        <a class="text-gray-600">📱 @floralearn</a>
    </section>

    {{-- MEET INSTRUCTOR SECTION --}}
    <section class="flex flex-col items-center justify-center py-16 bg-white text-center space-y-10">
        <div class="w-full flex items-center h-14 bg-indigo-200 ">
            <h1 class="w-full text-3xl font-semibold font-[syne] text-gray-800 bg-pink-200">Meet Our Instructor</h1>
        </div>
        <div class="flex flex-col md:flex-row items-center gap-8 max-w-5xl mx-auto px-6">
            <img src="{{ asset('img/profile.png') }}" alt="Instructor" class="w-full object-cover">
            <div class="text-gray-700 text-justify">
                <p class="font-semibold text-lg mb-2">Wonny Aiko – Floral Instructor & Founder of FloraLearn</p>
                <p>
                    With years of experience in floral design, Wonny brings warmth and creativity to every class she teaches.
                    She believes that arranging flowers is not just about technique, but also about expressing emotions and finding calm through art.
                    Her friendly guidance helps each participant discover their own style while enjoying a relaxing, hands-on experience.
                </p>
            </div>
        </div>
    </section>
</x-app>
