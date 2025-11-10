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
                        alert('Please fill all required fields!');
                        return false;
                    }
                    return true;
                }
            }"
            class="w-full max-w-4xl bg-white rounded-lg shadow-lg p-8 md:p-12">

            {{-- Title --}}
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-800 text-center">
                Flower Arrangement Form
            </h1>
            <p class="mt-2 text-center text-gray-600">
                Please fill the form below, it will only take 3 minutes
            </p>

            {{-- Form --}}
            <form class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4" @submit.prevent>
                <input type="text" placeholder="Your Name" x-ref="userName" required
                       class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">

                <input type="email" placeholder="Your Email" x-ref="userEmail" required
                       class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">

                <input type="password" placeholder="Your Password" x-ref="userPassword" required
                       class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">

                <select x-ref="userClass" required class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">
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
                        class="bg-pink-600 text-white py-2 px-6 rounded-lg hover:bg-pink-700 transition">
                    Book Now
                </button>
            </div>

            {{-- Payment Modal --}}
            <div x-show="open" x-cloak
                 class="fixed inset-0 flex items-center justify-center z-50 bg-black/20 backdrop-blur-sm">

                <div class="bg-white rounded-lg w-full max-w-md p-6 relative shadow-lg">

                    {{-- Close Modal --}}
                    <button @click="open = false; modalStep='payment'; showSuccess = false"
                            class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>

                    {{-- Step: Payment --}}
                    <div x-show="modalStep === 'payment'" x-transition>
                        <h2 class="text-xl font-bold mb-4">Payment Summary</h2>

                        <div class="grid grid-cols-2 grid-rows-2 gap-4 mb-4">
                            <template x-for="i in 4" :key="i">
                                <div class="flex gap-2 items-center">
                                    <div class="bg-indigo-300 w-20 h-20"></div>
                                    <div>
                                        <p>Name</p>
                                        <p x-text="$refs.userName.value || 'Ucok'"></p>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <hr class="my-5">

                        <div class="mb-4">
                            <h1 class="font-bold">Summary</h1>
                            <hr class="my-2">
                            <div class="flex justify-between">
                                <p>Total</p>
                                <p>Rp.120000</p>
                            </div>
                            <hr class="my-2">
                            <p class="mb-2">Payment Method</p>

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
                            <div x-show="showSuccess" class="mb-4 p-2 bg-green-100 text-green-800 rounded text-center">
                                Successful Payment!
                            </div>

                            {{-- Pay Now Button --}}
                            <button x-show="!showSuccess"
                                    @click.prevent="if(paymentMethod){ showSuccess = true; } else { alert('Please select a payment method!'); }"
                                    class="w-full bg-pink-600 text-white py-2 px-6 rounded-lg hover:bg-pink-700 transition">
                                Pay Now
                            </button>

                            {{-- See Invoice Button --}}
                            <button x-show="showSuccess" @click.prevent="modalStep='invoice'"
                                    class="w-full mt-2 bg-pink-600 text-white py-2 px-6 rounded-lg hover:bg-pink-700 transition">
                                See Invoice
                            </button>
                        </div>
                    </div>

                    {{-- Step: Invoice --}}
                    <div x-show="modalStep === 'invoice'" x-transition>
                        <h2 class="text-xl font-bold mb-4 text-center">Invoice Receipt</h2>
                        <div class="bg-gray-100 p-4 rounded mb-4 space-y-2">
                            <p><strong>Name:</strong> <span x-text="$refs.userName.value || 'Ucok'"></span></p>
                            <p><strong>Email:</strong> <span x-text="$refs.userEmail.value || 'example@mail.com'"></span></p>
                            <p><strong>Class:</strong> <span x-text="$refs.userClass.value || 'Beginner'"></span></p>
                            <p><strong>Date & Time:</strong> <span x-text="$refs.userDate.value || '10 Nov 2025'"></span>,
                                <span x-text="$refs.userTime.value || '09:00'"></span></p>
                            <p><strong>Payment Method:</strong> <span x-text="paymentMethod || 'Mastercard'"></span></p>
                            <p><strong>Total:</strong> Rp.120000</p>
                        </div>
                        <button @click="open = false; modalStep='payment'; showSuccess=false"
                                class="w-full bg-pink-600 text-white py-2 px-6 rounded-lg hover:bg-pink-700 transition">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app>
