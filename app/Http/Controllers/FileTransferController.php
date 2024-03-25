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

        return back()->with('success', 'Files uploaded successfully');
    }

    public function downloadFiles(Request $request, FileTransfer $fileTransfer)
    {
        $transferPath = $fileTransfer->id . '/';

        if (auth()->user()->getTransfers('to', 'sent')->contains('id', $fileTransfer->id)) {
            if ($fileTransfer->files()->count() > 1) {
                $zip = new \ZipArchive();
                $zipName = 'zipdownload.zip';
                // dd($zip->open($transferPath . $zipName, \ZipArchive::CREATE | \ZIPARCHIVE::OVERWRITE));
                if ($zip->open('zipdownload.zip', \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
                    foreach ($fileTransfer->files()->get() as $file) {
                        $fileContent = Storage::disk('local')->get($file->name);

                        $zip->addFromString(basename($file->name), $fileContent);
                    }

                    $zip->close();
                }

                $fileTransfer->updateState('downloaded');
                return response()->download($zipName)->deleteFileAfterSend(true);
            } else {
                $fileTransfer->updateState('downloaded');
                return Storage::download($transferPath . $fileTransfer->files()->first()->name);
            }
        }
    }

    public function rejectTransfer(Request $request, FileTransfer $fileTransfer)
    {
        $fileTransfer->updateState('cancelled');
        return back();
    }
}
