<x-app>
    <x-slot name="navbar">
        <x-navbar />
    </x-slot>

    <section class="min-h-screen flex items-center justify-center bg-white bg-center bg-cover">

        <div class="mx-auto text-center flex flex-col items-center justify-center
                    px-4 sm:px-6 lg:px-8 w-full">

            <h5 class="text-gray-600 underline font-['syne'] font-bold
                       text-lg sm:text-xl md:text-2xl lg:text-3xl
                       mt-20 mb-10">
                Find the perfect class for your floral journey
            </h5>

            <div class="flex flex-col gap-8 mx-auto w-full max-w-7xl">

                @forelse(($classes ?? []) as $c)
                    @php
                        $img = $c->image_path
                            ? (str_contains($c->image_path, 'classes/') ? asset('storage/'.$c->image_path) : asset($c->image_path))
                            : asset('img/class/class1.jpg');
                    @endphp

                    <!-- CARD CLASS -->
                    <div class="grid grid-cols-1 md:grid-cols-3 w-full bg-indigo-200 rounded-lg overflow-hidden shadow-sm">

                        <!-- LEFT IMAGE -->
                        <div>
                            <img src="{{ $img }}" alt=""
                                 class="w-full h-full object-cover p-6 md:p-10">
                        </div>

                        <!-- CENTER TEXT -->
                        <div class="flex p-6 md:p-10">
                            <div>
                                <h1 class="text-start font-['syne']
                                           text-2xl sm:text-3xl md:text-4xl">
                                    {{ $c->name }}
                                </h1>

                                <p class="w-32 text-center bg-orange-200 border border-black
                                          mt-2 mb-8 text-sm sm:text-base">
                                    IDR {{ number_format($c->price, 0, ',', '.') }}
                                </p>

                                <div class="text-start text-sm sm:text-base leading-relaxed">
                                    <p>{{ $c->description }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- RIGHT DATA -->
<div class="flex p-6 md:p-10 gap-4">

    <!-- Left Icon Full Height -->
    <div class="hidden md:flex h-full items-stretch">
        <img src="{{ asset('img/class/png.png') }}"
             alt=""
             class="h-full object-contain">
    </div>

    <!-- Right Info -->
    <div class="flex flex-col justify-between w-full">

        <div class="flex justify-end">
            <img src="{{ asset('img/class/Star.png') }}" alt="" class="w-8 h-8 object-contain">
        </div>

        <div class="flex flex-col items-end space-y-2 text-sm sm:text-base">

            <p>Duration : {{ $c->duration_minutes }} Hours</p>
            <p>Location : {{ $c->location }}</p>

            @php $info = ($slotMap[$c->id] ?? null); @endphp

            @if($info && isset($info['days']))
                <div dir="rtl" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 w-full">

    @foreach($info['days'] as $d)
        <div dir="ltr" class="border p-2 rounded bg-gray-50 text-right">
            <div class="font-semibold">
                {{ $d['display_day'] }}
            </div>

            <div class="flex flex-col items-end gap-1 mt-1">
                @foreach(($d['times'] ?? []) as $t)
                    <div class="text-sm">
                        {{ $t['value'] }} :
                        {{ $t['count'] }}/{{ $c->max ?? '-' }}
                        @if($c->max && $t['full'])
                            <span class="text-red-500">(Full)</span>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

</div>

            @else
                <p>
                    Class Slot : {{ $c->bookings_count }}/{{ $c->max ?? '-' }}
                    @if($c->max && $c->bookings_count == $c->max)
                        (Full)
                    @endif
                </p>
            @endif

        </div>

    </div>

</div>


                    </div>
                    <!-- END CARD -->

                @empty
                    <p class="text-center">No classes available.</p>
                @endforelse

            </div>

            <!-- Button -->
            <div class="my-10">
                <a href="/booking" class="bg-black text-white px-6 py-2 text-sm sm:text-base rounded">
                    Book Now
                </a>
            </div>

        </div>
    </section>
</x-app>
