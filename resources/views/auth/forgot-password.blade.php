<x-app>
    <x-slot name="navbar">
        <x-navbar />
    </x-slot>

    <section class="min-h-screen flex flex-col md:flex-row items-center bg-center bg-cover px-4 py-10 md:p-0"
             style="background-image: url('{{ asset('img/bg/login.png') }}');">

        {{-- Blank space kiri (desktop) --}}
        <div class="hidden md:flex w-1/2"></div>

        {{-- Form Forgot Password --}}
        <div class="w-full md:w-1/2 max-w-md bg-white bg-opacity-90
                    rounded-xl shadow-lg md:mr-20 p-8 md:p-10">

            <h5 class="text-gray-700 font-['Syne'] text-2xl md:text-3xl">
                Forgot Password
            </h5>
            <p class="mt-2 text-gray-600 text-sm md:text-base leading-relaxed">
                No worries! Enter your email and we’ll send you a password reset link.
            </p>

            {{-- Session Status --}}
            @if (session('status'))
                <div class="mt-4 text-green-600 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-4 mt-6">
                @csrf

                {{-- Email Input --}}
                <input
                    name="email" type="email" value="{{ old('email') }}"
                    class="w-full border border-gray-300 py-2.5 px-3 rounded-lg
                           focus:outline-none focus:ring-2 focus:ring-pink-300"
                    placeholder="Your Email" autocomplete="email">

                @error('email')
                    <p class="text-red-500 text-sm -mt-2">{{ $message }}</p>
                @enderror

                {{-- Submit Button --}}
                <button
                    type="submit"
                    class="w-full bg-[#F8CDCD] text-black py-2.5 rounded-lg
                           hover:shadow-lg transition text-sm md:text-base"
                >
                    Send Reset Link
                </button>

            </form>

            {{-- Back to login --}}
            <div class="w-full mt-5 text-center">
                <a href="{{ route('login') }}"
                   class="inline-block w-full bg-white border border-gray-300
                          text-gray-700 py-2.5 rounded-lg hover:shadow transition text-sm md:text-base">
                    Back to Login
                </a>
            </div>

        </div>
    </section>
</x-app>
