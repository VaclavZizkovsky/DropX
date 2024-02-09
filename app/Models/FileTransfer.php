<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileTransfer extends Model
{
    use HasFactory;

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
