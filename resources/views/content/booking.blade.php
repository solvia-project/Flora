<x-app>
    <x-slot name="navbar">
        <x-navbar />
    </x-slot>

    <section class="min-h-screen flex items-center justify-center bg-center bg-cover px-4 sm:px-6 lg:px-8"
             style="background-image: url('{{ asset('img/bg/class.png') }}');">

        <div x-data="{
                open: false,
                showSuccess: false,
                modalStep: 'payment',
                paymentMethod: '',
                validateForm() {
                    const name = $refs.userName.value.trim();
                    const email = $refs.userEmail.value.trim();
                    const password = $refs.userPassword.value.trim();
                    const userClass = $refs.userClass.value;

                    if (!name || !email || !password || !userClass || userClass === 'Select Class') {
                        return true;
                    }
                    return true;
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

                <input type="password" placeholder="Your Password" x-ref="userPassword"
                       class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">

                <select x-ref="userClass"  class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">
                    <option>Select Class</option>
                    <option>Beginner</option>
                    <option>Intermediate</option>
                    <option>Advanced</option>
                </select>

                <input type="date" x-ref="userDate" class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">

                <input type="time" x-ref="userTime" min="09:00" max="18:00" value="09:00"
                       class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">
            </form>




            {{-- Book Now Button --}}
            <div class="mt-6 text-end">
                <button type="button"
                        @click="if(validateForm()) { open = true; showSuccess = false; modalStep='payment'; }"
                        class="bg-pink-300 text-black py-2 px-6 rounded-lg hover:bg-pink-700 transition">
                    Book Now
                </button>
            </div>

            {{-- Payment Modal --}}
            <div x-show="open" x-cloak
                 class="fixed inset-0 flex items-center justify-center z-50 bg-black/20 backdrop-blur-sm">

                <div class="bg-white rounded-lg w-full max-w-3xl p-6 relative shadow-lg">
                    <p class="my-5">&leftarrow; Purchase Arrangement</p>
                    {{-- Close Modal --}}
                    <button @click="open = false; modalStep='payment'; showSuccess = false"
                            class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>

                    {{-- Step: Payment --}}
                    <div x-show="modalStep === 'payment'" x-transition class="p-5">
                        <h2 class="text-xl font-bold font-['syne'] mb-4">Beginner Floral Arrangement</h2>

                        <div class="grid grid-cols-2 grid-rows-2 gap-4 mb-4">
                                <div class="flex gap-2 ">
                                    <div class="bg-indigo-300 w-20 h-20"></div>
                                    <div>
                                        <p>Name</p>
                                        <p>Ucok</p>
                                    </div>
                                </div>
                                <div class="flex gap-2 ">
                                    <div class="bg-indigo-300 w-20 h-20"></div>
                                    <div>
                                        <p>Contact</p>
                                        <p>ucok@mail.com</p>
                                        <p>08567878667</p>
                                    </div>
                                </div>
                                <div class="flex gap-2 ">
                                    <div class="bg-indigo-300 w-20 h-20"></div>
                                    <div>
                                        <p>Date and Time</p>
                                        <p>Wednesday, 20 August 2026</p>
                                        <p>11.00 am</p>
                                    </div>
                                </div>
                                <div class="flex gap-2 ">
                                    <div class="bg-indigo-300 w-20 h-20"></div>
                                    <div>
                                        <p>Place</p>
                                        <p>Citraland, Surabaya</p>
                                        <p>Indonesia</p>
                                    </div>
                                </div>
                        </div>

                        <hr class="my-10 text-gray-400/50">

                        <div class="bg-indigo-50 px-5 py-10 rounded-lg">
                            <h1 class="font-bold my-5">Summary</h1>
                            <hr class="my-2 text-gray-400/50">
                            <div class="flex justify-between my-5">
                                <p>Total</p>
                                <p>Rp.120000</p>
                            </div>
                            <hr class="my-2 text-gray-400/50">
                            <p class=" my-5">Payment Method</p>

                            {{-- Payment Dropdown --}}
                            <select x-model="paymentMethod"
                                    class="w-full border border-gray-300 py-2 px-3 rounded-lg mb-4 focus:outline-none focus:ring-2 focus:ring-pink-300">
                                <option value="" disabled selected>Select Payment Method</option>
                                <option value="Mastercard">Mastercard</option>
                                <option value="Visa">Visa</option>
                                <option value="QRIS">QRIS</option>
                                <option value="GoPay">GoPay</option>
                                <option value="OVO">OVO</option>
                            </select>

                            {{-- Successful Payment Message --}}
                            <div x-show="showSuccess" class="mb-4 p-2 bg-green-50 border border-green-200 text-black font-semibold rounded text-center">
                                Successful Payment!
                            </div>

                            {{-- Pay Now Button --}}
                            <button x-show="!showSuccess"
                                    @click.prevent="if(paymentMethod){ showSuccess = true; } else { alert('Please select a payment method!'); }"
                                    class="w-full bg-pink-200 text-black py-2 px-6 rounded-lg hover:bg-pink-300 transition">
                                Pay Now
                            </button>

                            {{-- See Invoice Button --}}
                            <button x-show="showSuccess" @click.prevent="modalStep='invoice'"
                                    class="w-full mt-2 bg-pink-200 text-black py-2 px-6 rounded-lg hover:bg-pink-300 transition">
                                See Invoice
                            </button>
                        </div>
                    </div>

                    {{-- Step: Invoice --}}
                    <div x-show="modalStep === 'invoice'" x-transition>
                        <div class="w-full flex text-center items-center justify-center">
                            <img src="{{ asset('img/logo/logo.png') }}" alt="" class="w-40">
                        </div>
                        <div class="w-full  rounded space-y-2">
                            <div class="bg-gray-100 p-4 mb-4 ">
                                <div class="flex justify-between">
                                    <p><strong>Invoice</strong></p>
                                    <div>
                                    <p>Invoice No.</p>
                                    <p><strong>202501</strong></p>
                                    </div>
                                </div>
                                <div class="flex justify-between">
                                    <div class="flex flex-col">
                                        <p>Billed To:</p>
                                        <p><strong>Client Name</strong></p>
                                    </div>
                                    <div>
                                    <p>Issued on</p>
                                    <p><strong>August 5, 2077</strong></p>
                                    </div>
                                </div>
                                <div class="flex justify-between">
                                    <div class="flex flex-col">
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
                                    <div>
                                        <p>Total</p>
                                    </div>
                                </div>
                                <div class="flex justify-between">
                                        <p><strong>Beginner Floral<br>Arrangement</strong></p>
                                    <div>
                                        <p>4,000.00</p>
                                    </div>
                                </div>
                                <div class="flex justify-end bg-indigo-50 p-4 gap-4">
                                    <div>
                                        <p><strong>Subtotal</strong></p>
                                        <p><strong>Total (USD)</strong></p>
                                    </div>
                                    <div>
                                        <p>4,000.00</p>
                                        <p><strong>4,000.00</strong></p>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app>
