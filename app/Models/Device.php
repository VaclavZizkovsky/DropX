<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Collection;

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
        return $this->deviceOneTwo()->wherePivot('state', 'connected')->get()->merge($this->deviceTwoOne()->wherePivot('state', 'connected')->get())->unique('id');
    }

    public function attach(Device $device)
    {
        if ($this->devices()->contains('id', $device->getKey())) {
            return;
        }

        $this->deviceOneTwo()->attach($device->getKey(), ['state' => 'pending']);
    }

    public function detach(Device $device)
    {
        if ($this->devices()->contains('id', $device->getKey())) {
            // Detach the relationship in both ways.
            $this->deviceOneTwo()->detach($device->getKey());
            $this->deviceTwoOne()->detach($device->getKey());
        }
    }

    public function updateConnectionStatus(Device $device, string $status)
    {
        $pendingConnection = $this->getConnections('all', 'pending')->where('id', $device->id)->first();
        $cancelledConnection = $this->getConnections('to', 'cancelled')->where('id', $device->id)->first();
        if ($pendingConnection != null || $cancelledConnection != null) {
            $this->deviceTwoOne()->updateExistingPivot($device->id, ['state' => $status]);
        }
        return false;
    }

    public function getConnections($type, $states)
    {
        if (is_string($states)) {
            $states = [$states];
        }
        $connections = collect();
        foreach ($states as $state) {
            $statedConnections = new Collection();
            switch ($type) {
                case 'from':
                    $statedConnections = $this->deviceOneTwo()->wherePivot('state', $state)->get();
                    break;

                case 'to':
                    $statedConnections = $this->deviceTwoOne()->wherePivot('state', $state)->get();
                    break;

                case 'all':
                    $statedConnections = $this->deviceOneTwo()->wherePivot('state', $state)->get()->merge($this->deviceTwoOne()->wherePivot('state', $state)->get())->unique('id');
                    break;

                default:
                    break;
            }
            $connections = $connections->merge($statedConnections);
        }
        return $connections;
    }
    // public function pendingConnections()
    // {
    //     return $this->deviceTwoOne()->wherePivot('state', 'pending')->get();
    // }

    // public function cancelledConnections()
    // {
    //     return $this->deviceOneTwo()->wherePivot('state', 'cancelled')->get()->merge($this->deviceTwoOne()->wherePivot('state', 'cancelled')->get())->unique('id');
    // }

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

