<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FileTransfer;

class FileController extends Controller
{
    public function fileTransfer(){
        return $this->belongsTo(FileTransfer::class);
    }
}
