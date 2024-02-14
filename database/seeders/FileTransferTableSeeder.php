<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Device;
use App\Models\FileTransfer;
use App\Http\Controllers\FileTransferController;
use App\Models\File;

class FileTransferTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fileTransfer1 = FileTransfer::create([
            'state' => 'sent',
            'to_device_id' => 1,
            'from_device_id' => 4,
        ]);

        $fileTransfer2 = FileTransfer::create([
            'state' => 'sent',
            'to_device_id' => 2,
            'from_device_id' => 1,
        ]);

        $file1 = File::create([
            'name' => 'document.pdf',
            'file_transfer_id' => $fileTransfer1->id,
        ]);

        $file2 = File::create([
            'name' => 'music.mp3',
            'file_transfer_id' => $fileTransfer1->id,
        ]);

        $file3 = File::create([
            'name' => 'document1.docx',
            'file_transfer_id' => $fileTransfer1->id,
        ]);

        $file4 = File::create([
            'name' => 'app.exe',
            'file_transfer_id' => $fileTransfer2->id,
        ]);

    }
}
