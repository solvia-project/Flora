<x-app>
    <x-slot name="navbar">
        <x-navbar />
    </x-slot>

    <section class="min-h-screen flex flex-col md:flex-row items-center bg-center bg-cover"
             style="background-image: url('{{ asset('img/bg/login.png') }}');">

        <div class="hidden md:flex w-3/4"></div>

        {{-- Kotak register kanan --}}
        <div class="w-full md:w-1/2 flex flex-col bg-white bg-opacity-90 p-8 md:p-12 justify-center items-end md:mr-40">

            <div class="flex flex-col md:w-3/4 text-left">
                <h5 class="text-gray-600 font-['Syne'] text-xl sm:text-2xl md:text-3xl">
                    Login
                </h5>
                <p class="mt-2 text-gray-700">
                    Welcome back, we are glad you’re feeling beautiful today. Login to continue
                </p>

                {{-- Form Input --}}
                <div class="flex flex-col gap-4 mt-6">
                    <input type="email" class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300" placeholder="Email">
                    <input type="password" class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300" placeholder="Password">
                    <div class="flex items-center">
                        <input id="link-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="link-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember me.</label>
                    </div>
                </div>

                {{-- Tombol Register --}}
                <div class="w-full mt-8 text-center ">
                    <button class="bg-[#F8CDCD] text-black py-2 px-6 rounded text-sm sm:text-base hover:shadow-lg transition" onclick="window.location.href='/about'">
                        Login
                    </button>
                    <p class="mt-4"> <a href="/login" class="hover:underline">Forgot Password?</a></p>
                </div>
            </div>

        </div>
    </section>
</x-app>
