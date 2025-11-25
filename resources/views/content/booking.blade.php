<x-app>
    <x-slot name="navbar">
        <x-navbar />
    </x-slot>

    <section class="min-h-screen flex items-center justify-center bg-center bg-cover px-4 sm:px-6 lg:px-8"
        style="background-image: url('{{ asset('img/bg/class.png') }}');">

        <div
            x-data="{
                open: {{ (($modalStep ?? null) === 'payment' || ($modalStep ?? null) === 'invoice') ? 'true' : 'false' }},
                showSuccess: false,
                modalStep: '{{ $modalStep ?? 'payment' }}',
                paymentMethod: '',
                selectedMethod: null,
                methods: [
                    { name: 'Mastercard', img: '{{ asset('img/assets/master.png') }}' },
                    { name: 'Visa', img: '{{ asset('img/assets/visa.png') }}' },
                    { name: 'QRIS', img: '{{ asset('img/assets/qris.png') }}' },
                    { name: 'GoPay', img: '{{ asset('img/assets/gopay.png') }}' },
                    { name: 'Shopeepay', img: '{{ asset('img/assets/spay.png') }}' }
                ],
                times: [],
                selectedTime: '{{ old('time') }}',
                updateTimes() {
                    const opt = $refs.userClass.selectedOptions[0];
                    const t1 = opt ? opt.dataset.time1 || '' : '';
                    const t2 = opt ? opt.dataset.time2 || '' : '';
                    const arr = [];
                    if (t1) arr.push(t1);
                    if (t2) arr.push(t2);
                    this.times = arr;
                    if (!this.times.includes(this.selectedTime)) {
                        this.selectedTime = this.times[0] || '';
                    }
                },
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
            <form method="POST" action="{{ route('booking.store') }}" id="bookingForm" class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf
                <input type="text" placeholder="Your Name" x-ref="userName" value="{{ Auth::user()->name ?? '' }}"
                    class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">
                <input type="email" placeholder="Your Email" x-ref="userEmail" value="{{ Auth::user()->email ?? '' }}"
                    class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">
                <input type="tel" placeholder="Your Phone" x-ref="userPhone" value="{{ Auth::user()->phone ?? '' }}"
                    class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">
                <select x-ref="userClass" name="class_id" @change="updateTimes()" x-init="updateTimes()"
                    class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">
                    <option value="">Select Class</option>
                    @foreach(($classes ?? []) as $c)
                    <option value="{{ $c->id }}" @selected(old('class_id')==$c->id) data-time1="{{ $c->time_1 ? substr($c->time_1,0,5) : '' }}" data-time2="{{ $c->time_2 ? substr($c->time_2,0,5) : '' }}">{{ $c->name }} — IDR {{ number_format($c->price, 0, ',', '.') }}</option>
                    @endforeach
                </select>
                @error('class_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror

                <input type="date" x-ref="userDate" name="date" value="{{ old('date') }}"
                    class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">
                @error('date')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror

                {{-- TIME PICKER --}}
                <div class="w-full">
                    <div class="relative ">
                        <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>

                        <select id="time" name="time" x-model="selectedTime" :disabled="times.length === 0"
                            class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300" required>
                            <template x-for="t in times" :key="t">
                                <option :value="t" x-text="t"></option>
                            </template>
                        </select>
                    </div>

                    @error('time')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </form>

            {{-- Book Now Button --}}
            <div class="mt-6 text-end">
                <button type="submit" form="bookingForm"
                    class="bg-pink-300 text-black py-2 px-6 rounded-lg hover:bg-pink-700 transition">
                    Book Now
                </button>
            </div>

            {{-- Payment Modal --}}
            <div x-show="open" x-cloak
                class="fixed inset-0 z-50 bg-black/20 backdrop-blur-sm overflow-y-auto p-4 flex items-center justify-center">

                <div class="bg-white rounded-lg w-full max-w-3xl p-6 relative shadow-lg max-h-[85vh] overflow-y-auto">
                    <p class="my-5 cursor-pointer" @click="modalStep='payment'; showSuccess=false">&leftarrow; Purchase Arrangement</p>

                    {{-- Close --}}
                    <button @click="open = false"
                        class="absolute top-2 right-2 sm:top-4 sm:right-4 text-gray-500 hover:text-gray-700 text-xl sm:text-2xl">
                        &times;
                    </button>

                    {{-- Step: Payment --}}
                    <div x-show="modalStep === 'payment'" x-transition class="p-5">
                        <h2 class="text-xl font-bold font-['syne'] mb-4">{{ isset($invoiceBooking) ? optional($invoiceBooking->class)->name : 'Beginner Floral Arrangement' }}</h2>

                        {{-- Summary Info --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">

                            <div class="flex gap-4 sm:gap-6">
                                <div class="bg-indigo-300 w-16 h-16 sm:w-20 sm:h-20 flex justify-center items-center rounded-xl">
                                    <img src="{{ asset('img/assets/people-outline.png') }}" class="w-6 sm:w-8">
                                </div>
                                <div>
                                    <p>Name</p>
                                    <p>{{ isset($invoiceBooking) ? optional($invoiceBooking->user)->name : (Auth::user()->name ?? '—') }}</p>
                                </div>
                            </div>

                            <div class="flex gap-4 sm:gap-6">
                                <div class="bg-indigo-300 w-16 h-16 sm:w-20 sm:h-20 flex justify-center items-center rounded-xl">
                                    <img src="{{ asset('img/assets/Mail.png') }}" class="w-6 sm:w-8">
                                </div>
                                <div>
                                    <p>Contact</p>
                                    <p>{{ isset($invoiceBooking) ? optional($invoiceBooking->user)->email : (Auth::user()->email ?? '—') }}</p>
                                    <p>{{ isset($invoiceBooking) ? optional($invoiceBooking->user)->phone : (Auth::user()->phone ?? '—') }}</p>
                                </div>
                            </div>

                            <div class="flex gap-4 sm:gap-6">
                                <div class="bg-indigo-300 w-16 h-16 sm:w-20 sm:h-20 flex justify-center items-center rounded-xl">
                                    <img src="{{ asset('img/assets/Calendar.png') }}" class="w-6 sm:w-8">
                                </div>
                                <div>
                                    <p>Date and Time</p>
                                    <p>{{ isset($invoiceBooking) ? optional($invoiceBooking->booking_date)->format('l, d F Y') : '-' }}</p>
                                    <p>{{ isset($invoiceBooking) ? optional($invoiceBooking->booking_date)->format('H:i') : '-' }}</p>
                                </div>
                            </div>

                            <div class="flex gap-4 sm:gap-6">
                                <div class="bg-indigo-300 w-16 h-16 sm:w-20 sm:h-20 flex justify-center items-center rounded-xl">
                                    <img src="{{ asset('img/assets/Group.png') }}" class="w-4 sm:w-5">
                                </div>
                                <div>
                                    <p>Place</p>
                                    <p>{{ isset($invoiceBooking) ? optional($invoiceBooking->class)->location : '—' }}</p>
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
                                <p>{{ isset($invoiceBooking) ? 'IDR '.number_format(optional($invoiceBooking->class)->price ?? 0, 0, ',', '.') : '-' }}</p>
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
                            <form id="paymentForm" method="POST" action="{{ route('booking.pay') }}">
                                @csrf
                                <input type="hidden" name="booking_id" value="{{ $invoiceBooking->id ?? '' }}">
                                <input type="hidden" name="payment_method" :value="paymentMethod">
                            </form>
                            <button x-show="!showSuccess" type="submit" form="paymentForm"
                                class="w-full bg-pink-200 text-black py-2 px-6 rounded-lg hover:bg-pink-300 transition">
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
                                        <p><strong>{{ $invoiceBooking->invoice_no ?? ($invoiceBooking->id ?? '') }}</strong></p>
                                    </div>
                                </div>
                                <div class="flex justify-between">
                                    <div>
                                        <p>Billed To:</p>
                                        <p><strong>{{ optional(optional($invoiceBooking)->user)->name ?? '' }}</strong></p>
                                    </div>
                                    <div>
                                        <p>Issued on</p>
                                        <p class="font-semibold">{{ isset($invoiceBooking) ? optional($invoiceBooking->created_at)->format('F j, Y') : '' }}</p>
                                    </div>
                                </div>
                                <div class="flex justify-between">
                                    <div>
                                        <p>Contact</p>
                                        <p><strong>{{ optional(optional($invoiceBooking)->user)->phone ?? '' }}</strong></p>
                                    </div>
                                    <div>
                                        <p>Payment Due</p>
                                        <p class="font-semibold">{{ isset($invoiceBooking) ? optional($invoiceBooking->booking_date)->format('F j, Y') : '' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-between">
                                <p>Description</p>
                                <div><strong>Total</strong></div>
                            </div>

                            <div class="flex justify-between">
                                <p><strong>{{ optional(optional($invoiceBooking)->class)->name ?? '' }}</strong></p>
                                <div>
                                    <p>{{ isset($invoiceBooking) ? number_format(optional($invoiceBooking->class)->price ?? 0, 0, ',', '.') : '' }}</p>
                                </div>
                            </div>

                            <div class="flex justify-end bg-indigo-50 p-4 gap-4">
                                <div>
                                    <p><strong>Subtotal</strong></p>
                                    <p><strong>Total (IDR)</strong></p>
                                </div>
                                <div>
                                    <p>{{ isset($invoiceBooking) ? number_format(optional($invoiceBooking->class)->price ?? 0, 0, ',', '.') : '' }}</p>
                                    <p><strong>{{ isset($invoiceBooking) ? number_format(optional($invoiceBooking->class)->price ?? 0, 0, ',', '.') : '' }}</strong></p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
</x-app>
