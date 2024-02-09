<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Device;

class DeviceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $device1 = Device::create([
            'name' => 'Lenovo Legion Pro 5 16IRX8',
            'type' => 'laptop',
            'code' => 542684,
        ]);

        $device2 = Device::create([
            'name' => 'HP 24-cr0900nc Black',
            'type' => 'desktop',
            'code' => 203578,
        ]);

        $device3 = Device::create([
            'name' => 'MacBook Air 13 M1',
            'type' => 'laptop',
            'code' => 486532,
        ]);

        $device4 = Device::create([
            'name' => 'Samsung Galaxy S24 Ultra',
            'type' => 'mobile',
            'code' => 523684,
        ]);

        $device5 = Device::create([
            'name' => 'iPhone 15 Pro',
            'type' => 'mobile',
            'code' => 632548,
        ]);

        $device6 = Device::create([
            'name' => 'Mac mini M2 2023',
            'type' => 'desktop',
            'code' => 984563,
        ]);

        $device1->attach($device2);
        $device1->attach($device4);
        $device1->attach($device5);
        $device3->attach($device5);
        $device4->attach($device5);
    }
}
