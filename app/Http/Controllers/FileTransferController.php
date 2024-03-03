<?php

namespace App\Http\Controllers;

use App\Models\FileTransfer;
use App\Models\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileTransferController extends Controller
{
    public function uploadFiles(Request $request)
    {
        $request->validate([
            'files' => 'required',
            'device' => 'required'
        ]);

        if (auth()->user()->getConnections('all', 'connected')->where('id', $request->device)->count() < 1) {
            return back();
        }

        $files = $request->file('files');
        $transferData = [
            'from_device_id' => auth()->user()->id,
            'to_device_id' => $request->device,
            'state' => 'sent'
        ];
        $transfer = FileTransfer::create($transferData);

        foreach ($files as $file) {
            if ($file->getSize() > 0 && $file->isValid()) {
                $fileData = [
                    'name' => $file->getClientOriginalName(),
                    'file_transfer_id' => $transfer->id
                ];
                File::create($fileData);
                $file->storeAs($transfer->id, $file->getClientOriginalName());
            }
        }
        return back()->with('success', 'Files have been uploaded successfully');
    }
}
