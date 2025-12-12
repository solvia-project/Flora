<x-app>
    <x-slot name="navbar">
        <x-navbar />
    </x-slot>

    <section
        class="min-h-screen flex flex-col md:flex-row items-center justify-center
               bg-center bg-cover px-4 py-10 md:p-0"
        style="background-image: url('{{ asset('img/bg/login.png') }}');"
    >

        {{-- Left spacing (desktop only) --}}
        <div class="hidden md:flex w-1/2"></div>

        {{-- Right Login Box --}}
        <div class="w-full md:w-1/2 max-w-md bg-white bg-opacity-90
                    rounded-xl shadow-lg md:mr-20 p-8 md:p-10">

            <h5 class="text-gray-700 font-['Syne'] text-2xl md:text-3xl">
                Login
            </h5>
            <p class="mt-2 text-gray-600 text-sm md:text-base">
                Welcome back! We’re glad you’re feeling beautiful today.
                Login to continue.
            </p>

            {{-- Form --}}
            <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-4 mt-6">
                @csrf

                <input
                    name="email" type="email" value="{{ old('email') }}"
                    class="w-full border border-gray-300 py-2.5 px-3 rounded-lg
                           focus:outline-none focus:ring-2 focus:ring-pink-300"
                    placeholder="Email" autocomplete="username"
                >

                <input
                    name="password" type="password"
                    class="w-full border border-gray-300 py-2.5 px-3 rounded-lg
                           focus:outline-none focus:ring-2 focus:ring-pink-300"
                    placeholder="Password" autocomplete="current-password"
                >

                <button
                    type="submit"
                    class="w-full bg-[#F8CDCD] text-black py-2.5 rounded-lg
                           hover:shadow-lg transition text-sm md:text-base"
                >
                    Login
                </button>
            </form>

            {{-- Register + Forgot Password --}}
            <div class="mt-5 text-center">

                <a href="{{ route('register') }}"
                   class="inline-block w-full bg-white border border-gray-300
                          text-gray-700 py-2.5 rounded-lg hover:shadow transition text-sm md:text-base"
                >
                    Create account
                </a>

                <p class="mt-4 text-sm">
                    <a href="{{ route('password.request') }}" class="hover:underline">
                        Forgot Password?
                    </a>
                </p>

            </div>

        </div>
    </section>
</x-app>

