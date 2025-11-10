<x-app>
    <x-slot name="navbar">
        <x-navbar />
    </x-slot>

    <section class="min-h-screen flex items-center justify-center bg-center bg-cover" style="background: url('{{ asset('img/bg/class.png') }}')">
        <div class="mx-auto text-center flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8">
            <h5 class="text-gray-600 underline text-xl sm:text-2xl md:text-3xl mt-20 mb-10">
                Find the perfect class for your floral journey
            </h5>
            <div class="flex flex-col justify-evenly gap-4">
                {{-- class 1 --}}
                <div class="flex bg-indigo-200">
                    <img src="{{ asset('img/class/class1.jpg') }}" alt="" class="w-72 m-10">
                    <div class="m-10">
                        <h2>Beginner Floral Arrangement</h2>
                        <p>IDR 250.000</p>
                        <div>
                            <p>A perfect class for beginner who want to learn the basic techniques</p>
                            <ul>
                                <li>tes</li>
                                <li>tes</li>
                                <li>tes</li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex flex-col justify-between m-10">
                        <p>star</p>
                        <div>
                            <p>Duration : 2 Hours</p>
                            <p>Wednesday - at 11.00 or 16.00</p>
                            <p>Location : Citraland, Surabaya</p>
                        </div>
                    </div>
                </div>
                {{-- class 1 --}}
                <div class="flex bg-indigo-200">
                    <img src="{{ asset('img/class/class2.jpg') }}" alt="" class="w-72 m-10">
                    <div class="m-10">
                        <h2>Beginner Floral Arrangement</h2>
                        <p>IDR 250.000</p>
                        <div>
                            <p>A perfect class for beginner who want to learn the basic techniques</p>
                            <ul>
                                <li>tes</li>
                                <li>tes</li>
                                <li>tes</li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex flex-col justify-between m-10">
                        <p>star</p>
                        <div>
                            <p>Duration : 2 Hours</p>
                            <p>Wednesday - at 11.00 or 16.00</p>
                            <p>Location : Citraland, Surabaya</p>
                        </div>
                    </div>
                </div>
                {{-- class 1 --}}
                <div class="flex bg-indigo-200">
                    <img src="{{ asset('img/class/class3.jpg') }}" alt="" class="w-72 m-10">
                    <div class="m-10">
                        <h2>Beginner Floral Arrangement</h2>
                        <p>IDR 250.000</p>
                        <div>
                            <p>A perfect class for beginner who want to learn the basic techniques</p>
                            <ul>
                                <li>tes</li>
                                <li>tes</li>
                                <li>tes</li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex flex-col justify-between m-10">
                        <p>star</p>
                        <div>
                            <p>Duration : 2 Hours</p>
                            <p>Wednesday - at 11.00 or 16.00</p>
                            <p>Location : Citraland, Surabaya</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-10">
                <button class="bg-black text-white px-6 py-2">Book Now</button>
            </div>
        </div>
    </section>
</x-app>
