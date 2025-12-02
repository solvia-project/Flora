<x-app>
    <x-slot name="navbar">
        <x-navbar />
    </x-slot>

    <section class="min-h-screen flex items-center justify-center bg-center bg-cover"
             style="background-image: url('{{ asset('img/bg/dashboard.png') }}');">

        <div class="max-w-7xl mx-auto text-center flex flex-col items-center justify-center
                    px-4 sm:px-6 lg:px-8 py-10">

            <h5 class="text-gray-600 mt-3 underline
                       text-lg sm:text-xl md:text-2xl lg:text-3xl">
                Your Floral Journey Begins Here
            </h5>

            <h1 class="font-['Syne']
                       text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl
                       mt-4 max-w-3xl leading-snug">
                Discover the joy of flower arranging — no experience needed, just your passion!
            </h1>

            <div class="mt-8">
                <a href="/booking"
                   class="bg-black text-white py-2 px-6 rounded inline-block
                          text-sm sm:text-base hover:bg-gray-800 transition">
                    Book Now
                </a>
            </div>

        </div>
    </section>
</x-app>
