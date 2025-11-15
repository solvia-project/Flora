<x-app>
    <x-slot name="navbar">
        <x-navbar />
    </x-slot>

    <section class="min-h-screen flex flex-col md:flex-row items-center bg-center bg-cover"
             style="background-image: url('{{ asset('img/bg/register.png') }}');">

        <div class="hidden md:flex w-3/4"></div>

        {{-- Kotak register kanan --}}
        <div class="w-full md:w-1/2 flex flex-col bg-white bg-opacity-90 p-8 md:p-12 justify-center items-end md:mr-40">

            <div class="flex flex-col md:w-3/4 text-left">
                <h5 class="text-gray-600 font-['Syne'] text-xl sm:text-2xl md:text-3xl">
                    Register
                </h5>
                <p class="mt-2 text-gray-700">
                    Welcome to FloraLearn, we hope your stay with us feels as bright as the morning sun.
                </p>

                {{-- Form Input --}}
                <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-4 mt-6">
                    @csrf
                    <input name="name" type="text" value="{{ old('name') }}" class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300" placeholder="Your Name" autocomplete="name">
                    <input name="email" type="email" value="{{ old('email') }}" class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300" placeholder="Your Email" autocomplete="username">
                    <input name="phone" type="tel" value="{{ old('phone') }}" class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300" placeholder="Your Phone" autocomplete="tel">
                    <input name="password" type="password" class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300" placeholder="Your Password" autocomplete="new-password">
                    <input name="password_confirmation" type="password" class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300" placeholder="Confirm Password" autocomplete="new-password">
                    <div class="w-full mt-4 text-center ">
                        <button name="register" type="submit" class="w-full bg-[#F8CDCD] text-black py-2 px-6 rounded text-sm sm:text-base hover:shadow-lg transition">
                            Register
                        </button>
                    </div>
                </form>

                {{-- Tombol Register --}}
                <div class="w-full mt-2 text-center ">
                    <a href="{{ route('login') }}" class="inline-block w-full mt-3 bg-white border border-gray-300 text-gray-700 py-2 px-6 rounded text-sm sm:text-base hover:shadow-lg transition text-center">
                        Sign in
                    </a>
                    <p class="mt-4">Already have an account? <a href="{{ route('login') }}" class="underline">Login</a></p>
                </div>
            </div>

        </div>
    </section>
</x-app>
