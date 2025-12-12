<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $labels = [];
        $keys = [];
        for ($i = 11; $i >= 0; $i--) {
            $dt = Carbon::now()->subMonths($i);
            $keys[] = $dt->format('Y-m');
            $labels[] = $dt->format('M Y');
        }

        $rows = Booking::join('classes', 'classes.id', '=', 'bookings.class_id')
            ->where('bookings.status', 'paid')
            ->where('bookings.updated_at', '>=', Carbon::now()->subMonths(11)->startOfMonth())
            ->get(['bookings.updated_at', 'classes.price']);
        $map = [];
        foreach ($rows as $r) {
            $ym = Carbon::parse($r->updated_at)->format('Y-m');
            $map[$ym] = ($map[$ym] ?? 0) + (float) $r->price;
        }
        $revenues = array_map(function ($k) use ($map) {
            return (float) ($map[$k] ?? 0);
        }, $keys);

        $top = Booking::join('classes', 'classes.id', '=', 'bookings.class_id')
            ->selectRaw('classes.name as name, COUNT(*) as cnt')
            ->where('bookings.status', 'paid')
            ->groupBy('classes.id', 'classes.name')
            ->orderByDesc('cnt')
            ->limit(5)
            ->get();
        $topLabels = $top->pluck('name')->values()->all();
        $topCounts = $top->pluck('cnt')->map(function ($v) {
            return (int) $v;
        })->values()->all();

        return view('admin.dashboard', [
            'revenueLabels' => $labels,
            'revenueValues' => $revenues,
            'topClassLabels' => $topLabels,
            'topClassCounts' => $topCounts,
        ]);
    }
}
