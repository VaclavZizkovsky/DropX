<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Device extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'code'
    ];

    protected function deviceOneTwo()
    {
        return $this->belongsToMany(Device::class, 'device_device', 'device1_id', 'device2_id');
    }

    protected function deviceTwoOne()
    {
        return $this->belongsToMany(Device::class, 'device_device', 'device2_id', 'device1_id');
    }

    public function devices()
    {
        return $this->deviceOneTwo()->get()->merge($this->deviceTwoOne()->get())->unique('id');
    }

    public function attach(Device $device)
    {
        if ($this->devices()->contains('id', $device->getKey())) {
            return;
        }

        $this->deviceOneTwo()->attach($device->getKey());
    }

    public function detach(Device $device)
    {
        if ($this->devices()->contains('id', $device->getKey())) {
            // Detach the relationship in both ways.
            $this->deviceOneTwo()->detach($device->getKey());
            $this->deviceTwoOne()->detach($device->getKey());
        }
    }

    public function fileTransfers()
    {
        $sent = $this->sentFileTransfers();
        $recieved = $this->recievedFileTransfers()->toBase();
        return $sent->union($recieved)->orderBy('created_at');
    }

    public function sentFileTransfers()
    {
        return $this->hasMany(FileTransfer::class, 'from_device_id');
    }

    public function recievedFileTransfers()
    {
        return $this->hasMany(FileTransfer::class, 'to_device_id');
    }

    public function typeIcon()
    {
        $iconHtml = '';
        switch ($this->type) {
            case 'Desktop':
                $iconHtml = 'fa-computer';
                break;
            case 'Mobile':
                $iconHtml = 'fa-mobile-screen-button';
                break;
        }
        return $iconHtml;
    }
}

