<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Expert;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Default Admin User for CMS access
        User::firstOrCreate(
            ['email' => 'admin@bunge.com'],
            [
                'name' => 'Bunge Admin',
                'password' => Hash::make('BungeAdmin2026!'),
            ]
        );

        // 2. Seed Default Fi Asia Event Configuration
        Event::firstOrCreate(
            ['slug' => 'fi-asia-2026'],
            [
                'name' => 'Food Ingredients Asia Indonesia 2026',
                'venue' => 'Jakarta International Expo (JIExpo)',
                'city' => 'Jakarta, Indonesia',
                'hall' => 'Hall D2',
                'booth' => 'Booth D2F22',
                'dates' => '16–18 September 2026',
                'opening_time' => '09:00',
                'closing_time' => '17:00',
                'timezone' => 'WIB',
                'description' => 'Bunge FlexiBetter Event Microsite official exhibition & technical consultation hub.',
                'is_active' => true,
            ]
        );

        // 3. Seed Default Experts
        Expert::firstOrCreate(
            ['name' => 'Chef Bunge Technical Team'],
            [
                'title' => 'Senior Technical Bakery & Fats Specialist',
                'specialist_topic' => 'Functional Butter Solution Integration',
                'description' => 'Expert team in fat crystallization, bakery performance, and cost optimization.',
                'sort_order' => 1,
                'is_active' => true,
            ]
        );
        // 4. Seed Event Dates and 12 Consultation Slots per day
        $this->call(EventDateSeeder::class);
    }
}
