<x-app>
    <x-slot name="navbar">
        <x-navbar />
    </x-slot>

    <section class="min-h-screen flex items-center justify-center bg-center bg-cover px-4 sm:px-6 lg:px-8"
             style="background-image: url('{{ asset('img/bg/class.png') }}');">

        <div
            x-data="{
                open: false,
                showSuccess: false,
                modalStep: 'payment',
                paymentMethod: '',
                selectedMethod: null,
                methods: [
                    { name: 'Mastercard', img: '{{ asset('img/assets/master.png') }}' },
                    { name: 'Visa', img: '{{ asset('img/assets/visa.png') }}' },
                    { name: 'QRIS', img: '{{ asset('img/assets/qris.png') }}' },
                    { name: 'GoPay', img: '{{ asset('img/assets/gopay.png') }}' },
                    { name: 'Shopeepay', img: '{{ asset('img/assets/spay.png') }}' }
                ],
                validateForm() {
                    const name = $refs.userName.value.trim();
                    const email = $refs.userEmail.value.trim();
                    const phone = $refs.userPhone.value.trim();
                    const userClass = $refs.userClass.value;
                    return name && email && phone && userClass && userClass !== 'Select Class';
                }
            }"
            class="w-full max-w-4xl bg-white rounded-lg shadow-lg p-8 md:p-12">

            {{-- Title --}}
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-['syne'] font-bold text-gray-800 text-center">
                Flower Arrangement Form
            </h1>
            <p class="mt-2 text-center text-gray-600">
                Please fill the form below, it will only take 3 minutes
            </p>

            {{-- Form --}}
            <form class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4" @submit.prevent>
                <input type="text" placeholder="Your Name" x-ref="userName"
                       class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">
                <input type="email" placeholder="Your Email" x-ref="userEmail"
                       class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">
                <input type="phone" placeholder="Your Phone" x-ref="userPhone"
                       class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">
                <select x-ref="userClass"
                        class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">
                    <option>Select Class</option>
                    <option>Beginner</option>
                    <option>Intermediate</option>
                    <option>Advanced</option>
                </select>
                <input type="date" x-ref="userDate"
                       class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">
                <input type="time" x-ref="userTime" min="09:00" max="18:00" value="09:00"
                       class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">
            </form>

            {{-- Book Now Button --}}
            <div class="mt-6 text-end">
                <button type="button"
                        @click="if(validateForm()) { open = true; showSuccess = false; modalStep='payment'; } else { alert('Please fill out all fields!'); }"
                        class="bg-pink-300 text-black py-2 px-6 rounded-lg hover:bg-pink-700 transition">
                    Book Now
                </button>
            </div>

            {{-- Payment Modal --}}
            <div x-show="open" x-cloak
                 class="fixed inset-0 flex items-center justify-center z-50 bg-black/20 backdrop-blur-sm px-4">

                <div class="bg-white rounded-lg w-full
                            max-w-lg md:max-w-2xl lg:max-w-3xl
                            max-h-[90vh] overflow-y-auto
                            p-4 sm:p-6 md:p-8 relative shadow-lg">

                    <p class="my-5 cursor-pointer text-sm sm:text-base"
                       @click="modalStep='payment'; showSuccess=false">
                        &leftarrow; Purchase Arrangement
                    </p>

                    {{-- Close --}}
                    <button @click="open = false"
                            class="absolute top-2 right-2 sm:top-4 sm:right-4 text-gray-500 hover:text-gray-700 text-xl sm:text-2xl">
                        &times;
                    </button>

                    {{-- Step: Payment --}}
                    <div x-show="modalStep === 'payment'" x-transition class="p-2 sm:p-2">
                        <h2 class="text-lg sm:text-xl md:text-2xl font-bold font-['syne'] mb-4">
                            Beginner Floral Arrangement
                        </h2>

                        {{-- Summary Info --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">

                            <div class="flex gap-4 sm:gap-6">
                                <div class="bg-indigo-300 w-16 h-16 sm:w-20 sm:h-20 flex justify-center items-center rounded-xl">
                                    <img src="{{ asset('img/assets/people-outline.png') }}" class="w-6 sm:w-8">
                                </div>
                                <div>
                                    <p class="text-sm sm:text-base"><strong>Name</strong></p>
                                    <p class="text-sm sm:text-base">Glody</p>
                                </div>
                            </div>

                            <div class="flex gap-4 sm:gap-6">
                                <div class="bg-indigo-300 w-16 h-16 sm:w-20 sm:h-20 flex justify-center items-center rounded-xl">
                                    <img src="{{ asset('img/assets/Mail.png') }}" class="w-6 sm:w-8">
                                </div>
                                <div>
                                    <p class="text-sm sm:text-base"><strong>Contact</strong></p>
                                    <p class="text-sm sm:text-base">goldy@mail.com</p>
                                    <p class="text-sm sm:text-base">08567878667</p>
                                </div>
                            </div>

                            <div class="flex gap-4 sm:gap-6">
                                <div class="bg-indigo-300 w-16 h-16 sm:w-20 sm:h-20 flex justify-center items-center rounded-xl">
                                    <img src="{{ asset('img/assets/Calendar.png') }}" class="w-6 sm:w-8">
                                </div>
                                <div>
                                    <p class="text-sm sm:text-base"><strong>Date and Time</strong></p>
                                    <p class="text-sm sm:text-base">Wednesday, 20 August 2026</p>
                                    <p class="text-sm sm:text-base">11.00 am</p>
                                </div>
                            </div>

                            <div class="flex gap-4 sm:gap-6">
                                <div class="bg-indigo-300 w-16 h-16 sm:w-20 sm:h-20 flex justify-center items-center rounded-xl">
                                    <img src="{{ asset('img/assets/Group.png') }}" class="w-4 sm:w-5">
                                </div>
                                <div>
                                    <p class="text-sm sm:text-base"><strong>Place</strong></p>
                                    <p class="text-sm sm:text-base">Citraland, Surabaya</p>
                                    <p class="text-sm sm:text-base">Indonesia</p>
                                </div>
                            </div>

                        </div>

                        <hr class="my-10 text-gray-400/50">

                        {{-- Summary Card --}}
                        <div class="bg-indigo-50 p-6 sm:p-8 rounded-lg">

                            <h1 class="font-bold my-5 text-lg">Summary</h1>

                            <hr class="my-2 text-gray-400/50">

                            <div class="flex justify-between my-5 text-sm sm:text-base">
                                <p>Total</p>
                                <p>IDR 120.000</p>
                            </div>

                            <hr class="my-2 text-gray-400/50">

                            <p class="my-5 text-sm sm:text-base">Payment Method</p>

                            {{-- Unified Dropdown --}}
                            <div class="relative w-full mb-10" x-data="{ dropdownOpen: false }">
                                <button
                                    @click="dropdownOpen = !dropdownOpen"
                                    class="w-full border border-gray-300 py-2 px-3 rounded-lg flex items-center justify-between text-sm sm:text-base">
                                    <template x-if="!selectedMethod">
                                        <span>Select Payment Method</span>
                                    </template>
                                    <template x-if="selectedMethod">
                                        <div class="flex items-center space-x-2">
                                            <img :src="selectedMethod.img" class="w-5 h-5 sm:w-6 sm:h-6">
                                            <span x-text="selectedMethod.name"></span>
                                        </div>
                                    </template>
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <div x-show="dropdownOpen" @click.outside="dropdownOpen = false"
                                    class="absolute mt-2 w-full bg-white border border-gray-200 rounded-lg shadow-lg z-50">

                                    <template x-for="method in methods" :key="method.name">
                                        <button
                                            @click="selectedMethod = method; paymentMethod = method.name; dropdownOpen = false"
                                            class="flex items-center w-full px-4 py-2 hover:bg-pink-100 text-sm sm:text-base">
                                            <img :src="method.img" class="w-auto h-5 sm:h-6 mr-3">
                                            <span x-text="method.name"></span>
                                        </button>
                                    </template>

                                </div>
                            </div>

                            {{-- Success Message --}}
                            <div x-show="showSuccess"
                                 class="mb-4 p-2 bg-green-50 border border-green-200 text-black font-semibold rounded text-center text-sm sm:text-base">
                                Successful Payment!
                            </div>

                            {{-- Pay Now --}}
                            <button x-show="!showSuccess"
                                    @click.prevent="if(paymentMethod){ showSuccess = true; } else { alert('Please select a payment method!'); }"
                                    class="w-full bg-pink-200 text-black py-2 px-6 rounded-lg hover:bg-pink-300 transition text-sm sm:text-base">
                                Pay Now
                            </button>

                            {{-- See Invoice --}}
                            <button x-show="showSuccess" @click.prevent="modalStep='invoice'"
                                    class="w-full mt-2 bg-pink-200 text-black py-2 px-6 rounded-lg hover:bg-pink-300 transition text-sm sm:text-base">
                                See Invoice
                            </button>
                        </div>
                    </div>

                    {{-- Step: Invoice --}}
                    <div x-show="modalStep === 'invoice'" x-transition class="p-2 sm:p-4">

                        <div class="w-full flex text-center items-center justify-center">
                            <img src="{{ asset('img/logo/logo.png') }}" alt="" class="w-40">
                        </div>

                        <div class="w-full rounded space-y-2 text-sm sm:text-base">

                            <div class="bg-gray-100 p-4 mb-4">
                                <div class="flex justify-between">
                                    <p><strong>Invoice</strong></p>
                                    <div>
                                        <p>Invoice No.</p>
                                        <p><strong>202501</strong></p>
                                    </div>
                                </div>
                                <div class="flex justify-between">
                                    <div>
                                        <p>Billed To:</p>
                                        <p><strong>Client Name</strong></p>
                                    </div>
                                    <div>
                                        <p>Issued on</p>
                                        <p><strong>August 5, 2077</strong></p>
                                    </div>
                                </div>
                                <div class="flex justify-between">
                                    <div>
                                        <p>Contact</p>
                                        <p><strong>081382498127</strong></p>
                                    </div>
                                    <div>
                                        <p>Payment Due</p>
                                        <p><strong>August 12, 2077</strong></p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-between">
                                <p><strong>Description</strong></p>
                                <div><p>Total</p></div>
                            </div>

                            <div class="flex justify-between">
                                <p><strong>Beginner Floral<br>Arrangement</strong></p>
                                <div><p>4,000.00</p></div>
                            </div>

                            <div class="flex justify-end bg-indigo-50 p-4 gap-4">
                                <div>
                                    <p><strong>Subtotal</strong></p>
                                    <p><strong>Total (USD)</strong></p>
                                </div>
                                <div>
                                    <p>5,000.00</p>
                                    <p><strong>5,000.00</strong></p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
</x-app>
