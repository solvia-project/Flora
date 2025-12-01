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
                days: [],
                selectedDay: '{{ old('day') }}',
                selectedDate: '',
                errors: {},
                invoice: null,
                loading: false,
                init() {
                    this.selectedDate = this.computeDateForDay(this.selectedDay);
                    this.$watch('selectedDay', (v) => { this.selectedDate = this.computeDateForDay(v); this.updateTimes(); });
                },
                updateTimes() {
                    const opt = $refs.userClass.selectedOptions[0];
                    const t1 = opt ? opt.dataset.time1 || '' : '';
                    const t2 = opt ? opt.dataset.time2 || '' : '';
                    const arr = [];
                    if (t1) arr.push({ value: t1, full: false });
                    if (t2) arr.push({ value: t2, full: false });
                    const cls = $refs.userClass.value;
                    const date = this.selectedDate;
                    if (cls && date) {
                        fetch(`{{ route('booking.availability') }}?class_id=${encodeURIComponent(cls)}&date=${encodeURIComponent(date)}`, {
                            headers: { 'Accept': 'application/json' }
                        }).then(r => r.json()).then(data => {
                            if (data && Array.isArray(data.times)) {
                                this.times = data.times;
                                const found = this.times.find(t => t.value === this.selectedTime && !t.full);
                                if (!found) this.selectedTime = '';
                            } else {
                                this.times = arr;
                                if (!this.times.find(t => t.value === this.selectedTime)) this.selectedTime = '';
                            }
                        }).catch(() => {
                            this.times = arr;
                            if (!this.times.find(t => t.value === this.selectedTime)) this.selectedTime = '';
                        });
                    } else {
                        this.times = arr;
                        if (!this.times.find(t => t.value === this.selectedTime)) this.selectedTime = '';
                    }
                },
                updateDays() {
                    const opt = $refs.userClass.selectedOptions[0];
                    const csv = opt ? opt.dataset.days || '' : '';
                    const arr = csv ? csv.split(',').map(s => s.trim().toLowerCase()).filter(Boolean) : [];
                    this.days = arr;
                    if (!this.days.includes(this.selectedDay)) {
                        this.selectedDay = '';
                    }
                    this.selectedDate = this.computeDateForDay(this.selectedDay);
                    this.updateTimes();
                },
                computeDateForDay(day) {
                    const map = { sunday:0, monday:1, tuesday:2, wednesday:3, thursday:4, friday:5, saturday:6 };
                    if (!day || !(day in map)) return '';
                    const today = new Date();
                    const target = map[day];
                    const diff = (target - today.getDay() + 7) % 7;
                    const d = new Date(today.getFullYear(), today.getMonth(), today.getDate() + diff);
                    const y = d.getFullYear();
                    const m = String(d.getMonth() + 1).padStart(2, '0');
                    const dt = String(d.getDate()).padStart(2, '0');
                    return `${y}-${m}-${dt}`;
                },
                formatDate(dt) {
                    if (!dt) return '-';
                    const iso = (dt + '').replace(' ', 'T');
                    const d = new Date(iso);
                    if (isNaN(d)) return dt;
                    return d.toLocaleDateString('en-US', { weekday: 'long', day: '2-digit', month: 'long', year: 'numeric' });
                },
                formatTime(dt) {
                    if (!dt) return '-';
                    const iso = (dt + '').replace(' ', 'T');
                    const d = new Date(iso);
                    if (isNaN(d)) return dt;
                    return d.toLocaleTimeString('en-GB', { hour: '2-digit', minute: '2-digit' });
                },
                formatCurrency(v) {
                    try { return 'IDR ' + new Intl.NumberFormat('id-ID').format(Number(v || 0)); } catch(e) { return 'IDR ' + (v || 0); }
                },
                validateForm() {
                    const name = $refs.userName.value.trim();
                    const email = $refs.userEmail.value.trim();
                    const phone = $refs.userPhone.value.trim();
                    const userClass = $refs.userClass.value;
                    const day = this.selectedDay;
                    const time = this.selectedTime;
                    const date = this.selectedDate;
                    return name && email && phone && userClass && userClass !== 'Select Class' && day && time && date;
                },
                async submitBooking() {
                    this.errors = {};
                    if (!this.validateForm()) {
                        const userClass = $refs.userClass.value;
                        if (!userClass) this.errors.class_id = ['Please select class'];
                        if (!this.selectedDay) this.errors.day = ['Please select day'];
                        if (!this.selectedTime) this.errors.time = ['Please select time'];
                        if (!this.selectedDate) this.errors.date = ['Please select day to compute date'];
                        return;
                    }
                    const form = $refs.bookingForm;
                    const fd = new FormData(form);
                    try {
                        const res = await fetch(form.action, {
                            method: 'POST',
                            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
                            credentials: 'same-origin',
                            body: fd,
                        });
                        if (res.status === 422) {
                            const data = await res.json();
                            this.errors = data.errors || {};
                            return;
                        }
                        if (!res.ok) {
                            return;
                        }
                        const ct = res.headers.get('content-type') || '';
                        if (ct.includes('application/json')) {
                            const data = await res.json();
                            this.invoice = data;
                        }
                        this.open = true;
                        this.modalStep = 'payment';
                    } catch (e) {
                        return;
                    }
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
            <form method="POST" action="{{ route('booking.store') }}" id="bookingForm" x-ref="bookingForm" class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf
                <input type="hidden" name="date" :value="selectedDate">
                <div class="w-full">
                    <input type="text" placeholder="Your Name" x-ref="userName" value="{{ Auth::user()->name ?? '' }}"
                        class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">
                    @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <template x-if="errors.name">
                        <p class="text-red-600 text-sm mt-1" x-text="Array.isArray(errors.name) ? errors.name[0] : errors.name"></p>
                    </template>
                </div>
                <div class="w-full">
                    <input type="email" placeholder="Your Email" x-ref="userEmail" value="{{ Auth::user()->email ?? '' }}"
                        class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">
                    @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <template x-if="errors.email">
                        <p class="text-red-600 text-sm mt-1" x-text="Array.isArray(errors.email) ? errors.email[0] : errors.email"></p>
                    </template>
                </div>
                <div class="w-full">
                    <input type="tel" placeholder="Your Phone" x-ref="userPhone" value="{{ Auth::user()->phone ?? '' }}"
                        class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">
                    @error('phone')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <template x-if="errors.phone">
                        <p class="text-red-600 text-sm mt-1" x-text="Array.isArray(errors.phone) ? errors.phone[0] : errors.phone"></p>
                    </template>
                </div>
                <div class="w-full">
                    <select x-ref="userClass" name="class_id" @change="updateTimes(); updateDays()" x-init="updateTimes(); updateDays()"
                        class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">
                        <option value="">Select Class</option>
                        @foreach(($classes ?? []) as $c)
                        <option value="{{ $c->id }}" @selected(old('class_id')==$c->id) data-time1="{{ $c->time_1 ? substr($c->time_1,0,5) : '' }}" data-time2="{{ $c->time_2 ? substr($c->time_2,0,5) : '' }}" data-days="{{ $c->day ?? '' }}">{{ $c->name }} — IDR {{ number_format($c->price, 0, ',', '.') }}</option>
                        @endforeach
                    </select>
                    @error('class_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <template x-if="errors.class_id">
                        <p class="text-red-600 text-sm mt-1" x-text="Array.isArray(errors.class_id) ? errors.class_id[0] : errors.class_id"></p>
                    </template>
                </div>
                {{-- select day --}}
                <div class="w-full">
                    <select name="day" x-model="selectedDay" :disabled="days.length === 0" :class="{'opacity-60 cursor-not-allowed bg-gray-50': days.length === 0}"
                        class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">
                        <option value="">Select Day</option>
                        <template x-for="d in days" :key="d">
                            <option :value="d" x-text="d.charAt(0).toUpperCase() + d.slice(1)"></option>
                        </template>
                    </select>
                    @error('day')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <template x-if="errors.day">
                        <p class="text-red-600 text-sm mt-1" x-text="Array.isArray(errors.day) ? errors.day[0] : errors.day"></p>
                    </template>
                </div>


                {{-- TIME PICKER --}}
                <div class="w-full">
                    <div class="relative ">
                        <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">

                        </div>

                        <select id="time" name="time" x-model="selectedTime" :disabled="times.length === 0" :class="{'opacity-60 cursor-not-allowed bg-gray-50': times.length === 0}"
                            class="w-full border border-gray-300 py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300" required>
                            <option value="">Select Time</option>
                            <template x-for="t in times" :key="t.value">
                                <option :value="t.value" :disabled="t.full" x-text="t.value + (t.full ? ' (Full)' : '')"></option>
                            </template>
                        </select>
                    </div>

                    @error('time')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <template x-if="errors.time">
                        <p class="text-red-600 text-sm mt-1" x-text="Array.isArray(errors.time) ? errors.time[0] : errors.time"></p>
                    </template>
                </div>

            </form>

            {{-- Book Now Button --}}
            <div class="mt-6 text-end">
                <button type="button" @click.prevent="submitBooking()"
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
                        <h2 class="text-xl font-bold font-['syne'] mb-4" x-text="invoice ? invoice.class.name : '{{ isset($invoiceBooking) ? optional($invoiceBooking->class)->name : 'Beginner Floral Arrangement' }}'"></h2>

                        {{-- Summary Info --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">

                            <div class="flex gap-4 sm:gap-6">
                                <div class="bg-indigo-300 w-16 h-16 sm:w-20 sm:h-20 flex justify-center items-center rounded-xl">
                                    <img src="{{ asset('img/assets/people-outline.png') }}" class="w-6 sm:w-8">
                                </div>
                                <div>
                                    <p>Name</p>
                                    <p x-text="invoice ? invoice.user.name : '{{ isset($invoiceBooking) ? optional($invoiceBooking->user)->name : (Auth::user()->name ?? '—') }}'"></p>
                                </div>
                            </div>

                            <div class="flex gap-4 sm:gap-6">
                                <div class="bg-indigo-300 w-16 h-16 sm:w-20 sm:h-20 flex justify-center items-center rounded-xl">
                                    <img src="{{ asset('img/assets/Mail.png') }}" class="w-6 sm:w-8">
                                </div>
                                <div>
                                    <p>Contact</p>
                                    <p x-text="invoice ? invoice.user.email : '{{ isset($invoiceBooking) ? optional($invoiceBooking->user)->email : (Auth::user()->email ?? '—') }}'"></p>
                                    <p x-text="invoice ? invoice.user.phone : '{{ isset($invoiceBooking) ? optional($invoiceBooking->user)->phone : (Auth::user()->phone ?? '—') }}'"></p>
                                </div>
                            </div>

                            <div class="flex gap-4 sm:gap-6">
                                <div class="bg-indigo-300 w-16 h-16 sm:w-20 sm:h-20 flex justify-center items-center rounded-xl">
                                    <img src="{{ asset('img/assets/Calendar.png') }}" class="w-6 sm:w-8">
                                </div>
                                <div>
                                    <p>Date and Time</p>
                                    <p x-text="invoice ? formatDate(invoice.booking_date) : '{{ isset($invoiceBooking) ? optional($invoiceBooking->booking_date)->format('l, d F Y') : '-' }}'"></p>
                                    <p x-text="invoice ? formatTime(invoice.booking_date) : '{{ isset($invoiceBooking) ? optional($invoiceBooking->booking_date)->format('H:i') : '-' }}'"></p>
                                </div>
                            </div>

                            <div class="flex gap-4 sm:gap-6">
                                <div class="bg-indigo-300 w-16 h-16 sm:w-20 sm:h-20 flex justify-center items-center rounded-xl">
                                    <img src="{{ asset('img/assets/Group.png') }}" class="w-4 sm:w-5">
                                </div>
                                <div>
                                    <p>Place</p>
                                    <p x-text="invoice ? (invoice.class.location || '—') : '{{ isset($invoiceBooking) ? optional($invoiceBooking->class)->location : '—' }}'"></p>
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
                                <p x-text="invoice ? formatCurrency(invoice.class.price) : '{{ isset($invoiceBooking) ? 'IDR '.number_format(optional($invoiceBooking->class)->price ?? 0, 0, ',', '.') : '-' }}'"></p>
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
                                <input type="hidden" name="booking_id" :value="invoice ? invoice.id : '{{ $invoiceBooking->id ?? '' }}'">
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
