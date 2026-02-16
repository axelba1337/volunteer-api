<?php

namespace Database\Seeders;

use App\Models\Event; // Import Model Event
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => 'Donor Darah Nasional',
                'description' => 'Bekerjasama dengan PMI untuk membantu sesama. Satu tetes darah Anda berarti nyawa bagi orang lain.',
                'event_date' => Carbon::now()->addDays(14), // 14 hari dari sekarang
            ],
            [
                'title' => 'Penghijauan Kota Gajah',
                'description' => 'Aksi menanam 1000 pohon di pusat kota untuk mengurangi polusi udara dan mempercantik taman kota.',
                'event_date' => Carbon::now()->addDays(21), // 21 hari dari sekarang
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}