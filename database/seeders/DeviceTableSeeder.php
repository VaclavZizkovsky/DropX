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
            'type' => 'Laptop',
            'code' => 542684,
        ]);

        $device2 = Device::create([
            'name' => 'Dell Inspiron 3020',
            'type' => 'Desktop',
            'code' => 203578,
        ]);

        $device3 = Device::create([
            'name' => 'MacBook Air 13 M1',
            'type' => 'Laptop',
            'code' => 486532,
        ]);

        $device4 = Device::create([
            'name' => 'Samsung Galaxy S24 Ultra',
            'type' => 'Mobile',
            'code' => 523684,
        ]);

        $device5 = Device::create([
            'name' => 'iPhone 15 Pro',
            'type' => 'Mobile',
            'code' => 632548,
        ]);

        $device6 = Device::create([
            'name' => 'Mac mini M2 2023',
            'type' => 'Desktop',
            'code' => 984563,
        ]);

        $device1->attach($device2);
        $device1->attach($device4);
        $device1->attach($device5);
        $device3->attach($device5);
        $device4->attach($device5);
    }
}
