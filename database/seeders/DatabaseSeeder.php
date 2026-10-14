<?php

namespace Database\Seeders;

use App\Models\Events;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin123@gmail.com',
            'password' => Hash::make('admin123'),
        ]);

        $events = [
            [
                'title' => 'Konser Musik Nusantara',
                'category' => 'musik',
                'ticket_price' => 150000,
                'description' => 'Konser musik dengan musisi tanah air.',
                'image' => 'https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?w=800',
            ],
            [
                'title' => 'Festival Budaya',
                'category' => 'festival',
                'ticket_price' => 75000,
                'description' => 'Festival budaya dan kuliner nusantara.',
                'image' => 'https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?w=800',
            ],
            [
                'title' => 'Seminar Teknologi',
                'category' => 'seminar',
                'ticket_price' => 100000,
                'description' => 'Seminar teknologi terkini bersama praktisi.',
                'image' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800',
            ],
        ];

        foreach ($events as $event) {
            Events::create($event);
        }
    }
}
