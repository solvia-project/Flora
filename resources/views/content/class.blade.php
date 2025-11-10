<x-app>
    <x-slot name="navbar">
        <x-navbar />
    </x-slot>

    <section class="min-h-screen flex items-center justify-center bg-center bg-cover" style="background: url('{{ asset('img/bg/class.png') }}')">
        <div class="mx-auto text-center flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8">
            <h5 class="text-gray-600 underline font-['syne'] font-bold text-xl sm:text-2xl md:text-3xl mt-20 mb-10">
                Find the perfect class for your floral journey
            </h5>
            <div class="flex flex-col justify-evenly gap-4">
                {{-- class 1 --}}
                <div class="flex w-full bg-indigo-200">
                    <img src="{{ asset('img/class/class1.jpg') }}" alt="" class="w-72 m-10">
                    <div class=" m-10">
                        <h1 class="flex flex-col items-start font-['syne'] text-4xl">Beginner Floral Arrangement</h1>
                        <p class="flex flex-col w-32 items-center bg-orange-200 border border-black mt-2 mb-10">IDR 250.000</p>
                        <div class="flex flex-col items-start gap-4">
                            <p>A perfect class for beginner who want to learn the basic techniques</p>
                                <ul class="flex flex-col items-start space-y-1 text-gray-700 list-disc list-inside">
                                    <li>First-timers, no experience</li>
                                    <li>Basic flower arranging, knowing tools & flowers</li>
                                    <li>1 small bouquet — you can bring home the bouquet you create at the end of the class</li>
                                </ul>

                        </div>
                    </div>
                    <img src="{{ asset('img/class/png.png') }}" alt="">
                    <div class="flex flex-col justify-between m-10">
                        <div  class="flex justify-end">
                            <img src="{{ asset('img/class/Star.png') }}" alt="">
                        </div>
                        <div class="flex flex-col items-end">
                            <p>Duration : 2 Hours</p>
                            <p>Wednesday - at 11.00 or 16.00</p>
                            <p>Location : Citraland, Surabaya</p>
                        </div>
                    </div>
                </div>
                {{-- class 2 --}}
                <div class="flex w-full bg-indigo-200">
                    <img src="{{ asset('img/class/class1.jpg') }}" alt="" class="w-72 m-10">
                    <div class=" m-10">
                        <h1 class="flex flex-col items-start font-['syne'] text-4xl">Wedding Floral Arrangement</h1>
                        <p class="flex flex-col w-32 items-center bg-orange-200 border border-black mt-2 mb-10">IDR 330.000</p>
                        <div class="flex flex-col items-start gap-4">
                            <p>An intermediate-level class focused on floral designs for weddings</p>
                                <ul class="flex flex-col items-start space-y-1 text-gray-700 list-disc list-inside">
                                    <li>Those who already know basics flower arranging and want to explore bridal bouquets</li>
                                    <li>Learn how to create elegant bridal bouquets</li>
                                    <li>You will complete your own medium sized wedding floral arrangement and bring it home after class.</li>
                                </ul>

                        </div>
                    </div>
                    <img src="{{ asset('img/class/png.png') }}" alt="">
                    <div class="flex flex-col justify-between m-10">
                        <div  class="flex justify-end">
                            <img src="{{ asset('img/class/Star.png') }}" alt="">
                            <img src="{{ asset('img/class/Star.png') }}" alt="">
                        </div>
                        <div class="flex flex-col items-end">
                            <p>Duration : 2 Hours</p>
                            <p>Wednesday - at 11.00 or 16.00</p>
                            <p>Location : Citraland, Surabaya</p>
                        </div>
                    </div>
                </div>
                {{-- class 3 --}}
                <div class="flex w-full bg-indigo-200">
                    <img src="{{ asset('img/class/class1.jpg') }}" alt="" class="w-72 m-10">
                    <div class=" m-10">
                        <h1 class="flex flex-col items-start font-['syne'] text-4xl">Creative Flower Art Arrangement</h1>
                        <p class="flex flex-col w-32 items-center bg-orange-200 border border-black mt-2 mb-10">IDR 550.000</p>
                        <div class="flex flex-col items-start gap-4">
                            <p>An advanced class exploring artistic and unique flowers arragements</p>
                                <ul class="flex flex-col items-start space-y-1 text-gray-700 list-disc list-inside mx-10">
                                    <li>Ideal for those who love experimenting with colors and styles, and want to express creativity through flowers.</li>
                                    <li>Learn to combine flowers with artistic, using uncommon flowers</li>
                                    <li>Your own artistic floral piece arranged in a decorative vase can be taken home</li>
                                </ul>

                        </div>
                    </div>
                    <img src="{{ asset('img/class/png.png') }}" alt="">
                    <div class="flex flex-col justify-between m-10">
                        <div  class="flex justify-end">
                            <img src="{{ asset('img/class/Star.png') }}" alt="">
                            <img src="{{ asset('img/class/Star.png') }}" alt="">
                            <img src="{{ asset('img/class/Star.png') }}" alt="">
                        </div>
                        <div class="flex flex-col items-end">
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
