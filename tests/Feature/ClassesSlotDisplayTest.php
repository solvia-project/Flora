<?php

namespace Tests\Feature;

use App\Models\WorkshopClass;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class ClassesSlotDisplayTest extends TestCase
{
    public function test_slot_map_shows_per_time_counts(): void
    {
        $class = WorkshopClass::create([
            'name' => 'Display Class',
            'price' => 50000,
            'location' => 'Jakarta',
            'duration_minutes' => 60,
            'max' => 1,
            'day' => 'monday,tuesday',
            'time_1' => '09:00:00',
            'time_2' => '10:00:00',
        ]);

        $user = User::factory()->create();

        $today = Carbon::now()->startOfDay();
        $target = null;
        for ($i = 0; $i < 7; $i++) {
            $d = $today->copy()->addDays($i);
            $name = strtolower($d->format('l'));
            if (in_array($name, ['monday','tuesday'], true)) {
                $target = $d;
                break;
            }
        }

        Booking::create([
            'user_id' => $user->id,
            'class_id' => $class->id,
            'booking_date' => Carbon::parse($target->toDateString() . ' 09:00'),
            'status' => 'pending',
        ]);

        $response = $this->get(route('classes.index'));
        $response->assertStatus(200);
        $response->assertViewHas('slotMap', function ($slotMap) use ($class) {
            return isset($slotMap[$class->id])
                && isset($slotMap[$class->id]['times'])
                && is_array($slotMap[$class->id]['times'])
                && count($slotMap[$class->id]['times']) === 2
                && $slotMap[$class->id]['times'][0]['count'] === 1
                && $slotMap[$class->id]['times'][1]['count'] === 0
                && $slotMap[$class->id]['day_full'] === false;
        });
    }

    public function test_day_full_true_when_all_times_full(): void
    {
        $class = WorkshopClass::create([
            'name' => 'Full Day Class',
            'price' => 50000,
            'location' => 'Jakarta',
            'duration_minutes' => 60,
            'max' => 1,
            'day' => 'monday',
            'time_1' => '09:00:00',
            'time_2' => '10:00:00',
        ]);

        $u1 = User::factory()->create();
        $u2 = User::factory()->create();

        $today = Carbon::now()->startOfDay();
        $target = null;
        for ($i = 0; $i < 7; $i++) {
            $d = $today->copy()->addDays($i);
            if (strtolower($d->format('l')) === 'monday') {
                $target = $d;
                break;
            }
        }

        Booking::create([
            'user_id' => $u1->id,
            'class_id' => $class->id,
            'booking_date' => Carbon::parse($target->toDateString() . ' 09:00'),
            'status' => 'pending',
        ]);
        Booking::create([
            'user_id' => $u2->id,
            'class_id' => $class->id,
            'booking_date' => Carbon::parse($target->toDateString() . ' 10:00'),
            'status' => 'pending',
        ]);

        $response = $this->get(route('classes.index'));
        $response->assertStatus(200);
        $response->assertViewHas('slotMap', function ($slotMap) use ($class) {
            return isset($slotMap[$class->id])
                && ($slotMap[$class->id]['day_full'] === true);
        });
    }
}

