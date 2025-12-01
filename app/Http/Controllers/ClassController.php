<?php

namespace App\Http\Controllers;

use App\Models\WorkshopClass;
use App\Models\Booking;
use Illuminate\Support\Carbon;

class ClassController extends Controller
{
    public function index()
    {
        $classes = WorkshopClass::withCount('bookings')->orderBy('starts_at')->get();
        $slotMap = [];
        foreach ($classes as $c) {
            $allowedTimes = array_values(array_filter([
                $c->time_1 ? substr((string) $c->time_1, 0, 5) : null,
                $c->time_2 ? substr((string) $c->time_2, 0, 5) : null,
            ]));
            $allowedDays = [];
            if ($c->day) {
                $value = (string) $c->day;
                if (ctype_digit($value)) {
                    $names = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
                    $mask = (int) $value;
                    foreach ($names as $i => $n) {
                        if ($mask & (1 << $i)) {
                            $allowedDays[] = $n;
                        }
                    }
                } else {
                    $allowedDays = array_values(array_filter(array_map(function ($d) {
                        return strtolower(trim((string) $d));
                    }, explode(',', $value))));
                }
            }
            if (!$allowedDays || !$allowedTimes) {
                continue;
            }
            $today = Carbon::now()->startOfDay();
            $groups = [];
            foreach ($allowedDays as $dayName) {
                $targetDate = null;
                for ($i = 0; $i < 7; $i++) {
                    $d = $today->copy()->addDays($i);
                    if (strtolower($d->format('l')) === $dayName) {
                        $targetDate = $d;
                        break;
                    }
                }
                if (!$targetDate) {
                    continue;
                }
                $timesInfo = [];
                $dayFull = true;
                foreach ($allowedTimes as $t) {
                    $count = Booking::where('class_id', $c->id)
                        ->whereDate('booking_date', $targetDate->toDateString())
                        ->whereTime('booking_date', $t)
                        ->count();
                    $full = $c->max ? $count >= (int) $c->max : false;
                    if (!$full) {
                        $dayFull = false;
                    }
                    $timesInfo[] = [
                        'value' => $t,
                        'count' => $count,
                        'full' => $full,
                    ];
                }
                $groups[] = [
                    'day' => $dayName,
                    'date' => $targetDate->toDateString(),
                    'display_day' => ucfirst($dayName),
                    'display_date' => $targetDate->format('l, d M Y'),
                    'times' => $timesInfo,
                    'day_full' => $dayFull,
                ];
            }
            if ($groups) {
                $slotMap[$c->id] = [
                    'days' => $groups,
                ];
            }
        }
        return view('content.class', compact('classes', 'slotMap'));
    }
}
