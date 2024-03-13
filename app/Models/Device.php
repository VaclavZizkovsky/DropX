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

    public function detach(Device $device, $connectionState)
    {
        if ($this->getConnections('all', $connectionState)->contains('id', $device->id)) {
            $this->deviceOneTwo()->detach($device->id);
            $this->deviceTwoOne()->detach($device->id);
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

    public function getTransfers($type, $states)
    {
        if (is_string($states)) {
            $states = [$states];
        }
        $transfers = collect();
        foreach ($states as $state) {
            $statedTransfers = new Collection();
            switch ($type) {
                case 'from':
                    $statedTransfers = $this->hasMany(FileTransfer::class, 'from_device_id')->where('state', $state)->orderBy('created_at', 'desc')->get();
                    break;

                case 'to':
                    $statedTransfers = $this->hasMany(FileTransfer::class, 'to_device_id')->where('state', $state)->orderBy('created_at', 'desc')->get();
                    break;

                case 'all':
                    $statedTransfers = $this->hasMany(FileTransfer::class, 'from_device_id')->where('state', $state)->union($this->hasMany(FileTransfer::class, 'to_device_id')->where('state', $state)->toBase())->orderBy('created_at', 'desc')->get();
                    break;

                default:
                    break;
            }

            $transfers = $transfers->merge($statedTransfers);
        }
        return $transfers;
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

