<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\WorkshopClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $classes = WorkshopClass::orderBy('starts_at')->get();
        $invoiceBooking = null;
        $id = session('invoice_booking_id');
        if ($id) {
            $invoiceBooking = Booking::with(['class', 'user'])->find($id);
        }
        $modalStep = session('modal_step', 'none');
        return view('content.booking', compact('classes', 'invoiceBooking', 'modalStep'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => ['required', 'exists:classes,id'],
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i'],
        ]);

        $class = WorkshopClass::find((int) $request->class_id);
        $allowedTimes = array_values(array_filter([
            $class && $class->time_1 ? substr((string) $class->time_1, 0, 5) : null,
            $class && $class->time_2 ? substr((string) $class->time_2, 0, 5) : null,
        ]));
        if (!in_array($request->time, $allowedTimes, true)) {
            return back()->withInput()->withErrors(['time' => 'Time is not available for the selected class']);
        }

        $bookingDate = Carbon::parse($request->date.' '.$request->time);

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'class_id' => (int) $request->class_id,
            'booking_date' => $bookingDate,
            'status' => 'pending',
        ]);

        $booking->invoice_no = 'INV-'.now()->format('Ymd').'-'.str_pad((string) $booking->id, 6, '0', STR_PAD_LEFT);
        $booking->save();

        return redirect()->route('booking.index')->with(['invoice_booking_id' => $booking->id, 'modal_step' => 'payment']);
    }

    public function pay(Request $request)
    {
        $request->validate([
            'booking_id' => ['required', 'exists:bookings,id'],
            'payment_method' => ['required', 'in:Mastercard,Visa,QRIS,GoPay,Shopeepay'],
        ]);

        $booking = Booking::with(['class', 'user'])->findOrFail((int) $request->booking_id);
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $booking->status = 'paid';
        $booking->save();

        return redirect()->route('booking.index')->with(['invoice_booking_id' => $booking->id, 'modal_step' => 'invoice']);
    }
}
