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
            ],
            [
                'title' => 'Festival Budaya',
                'category' => 'festival',
                'ticket_price' => 75000,
                'description' => 'Festival budaya dan kuliner nusantara.',
            ],
            [
                'title' => 'Seminar Teknologi',
                'category' => 'seminar',
                'ticket_price' => 100000,
                'description' => 'Seminar teknologi terkini bersama praktisi.',
            ],
        ];

        foreach ($events as $event) {
            Events::create($event);
        }
    }
}
