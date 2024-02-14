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

    public function fromDevice()
    {
        return $this->belongsTo(Device::class, 'from_device_id');
    }

    public function toDevice()
    {
        return $this->belongsTo(Device::class, 'to_device_id');
    }
}
