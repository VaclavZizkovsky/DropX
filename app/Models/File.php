<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'file_transfer_id'
    ];

    public function fileTransfer()
    {
        return $this->belongsTo(FileTransfer::class);
    }
}
