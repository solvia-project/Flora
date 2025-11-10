<x-app>
    <x-slot name="navbar">
        <x-navbar />
    </x-slot>

    <section class="min-h-screen flex items-center justify-center bg-center bg-cover"
             style="background-image: url('{{ asset('img/bg/dashboard.png') }}');">
        <div class="max-w-7xl mx-auto text-center flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8">

            <h5 class="text-gray-600 mt-3 underline text-xl sm:text-2xl md:text-3xl">
                Your Floral Journey Begins Here
            </h5>

            <h1 class="font-['Syne'] text-3xl sm:text-4xl md:text-5xl lg:text-6xl mt-4">
                Discover the joy of flower arranging — no experience needed, just your passion!
            </h1>

            <div class="mt-8">
                <p class="bg-black text-white py-2 px-6 rounded inline-block text-sm sm:text-base cursor-pointer hover:bg-gray-800 transition">
                    Book Now
                </p>
            </div>
        </div>
    </section>
</x-app>
