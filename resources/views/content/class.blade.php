<x-app>
    <x-slot name="navbar">
        <x-navbar />
    </x-slot>

    <section class="min-h-screen flex items-center justify-center bg-white bg-center bg-cover">
        <div class="mx-auto text-center flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8">
            <h5 class="text-gray-600 underline font-['syne'] font-bold text-xl sm:text-2xl md:text-3xl mt-20 mb-10">
                Find the perfect class for your floral journey
            </h5>
            <div class="flex flex-col justify-evenly gap-4 mx-auto max-w-7xl">
                @forelse(($classes ?? []) as $c)
                    @php
                        $img = $c->image_path
                            ? (str_contains($c->image_path, 'classes/') ? asset('storage/'.$c->image_path) : asset($c->image_path))
                            : asset('img/class/class1.jpg');
                    @endphp
                    <div class="grid grid-cols-3 w-full bg-indigo-200">
                        <div>
                            <img src="{{ $img }}" alt="" class="w-full p-10">
                        </div>
                        <div class="flex p-10">
                            <div>
                                <h1 class="flex flex-col text-start font-['syne'] text-4xl">{{ $c->name }}</h1>
                                <p class="flex flex-col w-32 items-center bg-orange-200 border border-black mt-2 mb-10">IDR {{ number_format($c->price, 0, ',', '.') }}</p>
                                <div class="flex flex-col text-start gap-4">
                                    <p>{{ $c->description }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-between p-10">
                            <div class="">
                                <img src="{{ asset('img/class/png.png') }}" alt="">
                            </div>
                            <div class="flex flex-col justify-between">
                                <div class="flex justify-end">
                                    <img src="{{ asset('img/class/Star.png') }}" alt="">
                                </div>
                                <div class="flex flex-col items-end">
                                    <p>Duration : {{ $c->duration_minutes }} Hours</p>
                                    <p>Starts : {{ optional($c->starts_at)->format('l, d M Y H:i') }}</p>
                                    <p>Location : {{ $c->location }}</p>
                                    <p>Class Slot : {{ rand(0,10) }}/{{ rand(10,15) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">No classes available.</p>
                @endforelse
            </div>
            <div class="my-10">
                <a href="/booking" class="bg-black text-white px-6 py-2">Book Now</a>
            </div>
        </div>
    </section>
</x-app>
