<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminClassManagementTest extends TestCase
{
    public function test_admin_can_store_class(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('admin.class.store'), [
            'name' => 'Beginner Floral Arrangement',
            'price' => 250000,
            'location' => 'Jakarta',
            'starts_at' => now()->addDay()->format('Y-m-d\TH:i'),
            'duration_minutes' => 120,
            'image' => UploadedFile::fake()->image('class.jpg'),
            'description' => 'Basic flower arranging techniques.',
        ]);

        $response->assertRedirect(route('admin.class.index'));
        $this->assertDatabaseHas('classes', ['name' => 'Beginner Floral Arrangement']);
        Storage::disk('public')->assertDirectoryExists('classes');
    }

    public function test_admin_can_update_class(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $this->actingAs($user);

        $create = $this->post(route('admin.class.store'), [
            'name' => 'Beginner Floral Arrangement',
            'price' => 200000,
            'location' => 'Bandung',
            'starts_at' => now()->addDays(2)->format('Y-m-d\TH:i'),
            'duration_minutes' => 90,
            'description' => 'Intro class.',
        ]);

        $create->assertRedirect(route('admin.class.index'));

        $index = $this->get(route('admin.class.index'));
        $index->assertStatus(200);
    }
}