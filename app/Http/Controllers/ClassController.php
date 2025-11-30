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
            $nextDate = null;
            $nextDay = null;
            for ($i = 0; $i < 7; $i++) {
                $d = $today->copy()->addDays($i);
                $name = strtolower($d->format('l'));
                if (in_array($name, $allowedDays, true)) {
                    $nextDate = $d;
                    $nextDay = $name;
                    break;
                }
            }
            if (!$nextDate) {
                continue;
            }
            $timesInfo = [];
            $dayFull = true;
            foreach ($allowedTimes as $t) {
                $count = Booking::where('class_id', $c->id)
                    ->whereDate('booking_date', $nextDate->toDateString())
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
            $slotMap[$c->id] = [
                'day' => $nextDay,
                'date' => $nextDate->toDateString(),
                'display_day' => ucfirst($nextDay),
                'display_date' => $nextDate->format('l, d M Y'),
                'times' => $timesInfo,
                'day_full' => $dayFull,
            ];
        }
        return view('content.class', compact('classes', 'slotMap'));
    }
}
