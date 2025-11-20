<nav class="bg-white py-3 shadow-sm border border-b border-gray-200">
    <div class="container mx-auto flex justify-between items-center px-4">
        {{-- Logo --}}
        <a href="/" class="font-bold text-lg  flex items-center">
            <img src="{{ asset('img/logo/logo.png') }}" alt="Logo" class="h-8 mr-2">
        </a>

        {{-- Hamburger button untuk mobile --}}
        <button id="burger" class="md:hidden text-gray-700 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        {{-- Menu --}}
        <div id="menu" class="hidden md:flex md:items-center md:space-x-6">
            <ul class="flex flex-col md:flex-row md:space-x-4 space-y-2 md:space-y-0 mt-4 md:mt-0">
                <li><a href="/" class="hover:text-pink-600">Home</a></li>
                <li><a href="/about" class="hover:text-pink-600">About Us</a></li>
                <li><a href="/classes" class="hover:text-pink-600">Class List</a></li>
                <li><a href="/booking" class="hover:text-pink-600">Booking</a></li>
            </ul>
            @guest
                <a href="{{ route('login') }}" class="bg-pink-200 py-2 px-6 mt-2 md:mt-0 rounded hover:bg-pink-300 transition">
                    Login
                </a>
            @endguest
            @auth
                <form method="POST" action="{{ route('logout') }}" class="mt-2 md:mt-0">
                    @csrf
                    <button type="submit" class="bg-pink-200 py-2 px-6 rounded hover:bg-pink-300 transition">
                        Logout
                    </button>
                </form>
            @endauth
        </div>
    </div>
</nav>

<script>
    const burger = document.getElementById('burger');
    const menu = document.getElementById('menu');

    burger.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
</script>
