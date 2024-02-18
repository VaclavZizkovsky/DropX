<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Device;

class DeviceController extends Controller
{
    public function connectionRequest(Request $request)
    {
        $deviceValues = $request->validate([
            'code' => ['required', 'regex:/[0-9]{6}/'],
        ]);

        $deviceToConnect = Device::where('code', $deviceValues['code'])->first();
        if ($deviceToConnect == null) {
            return back()->withInput()->withErrors([
                'code' => 'Check the entered code, please.',
            ]);
        }
        $authDevice = auth()->user();


        if ($authDevice->devices()->where('id', $deviceToConnect->id)->count() > 0) {
            return back()->withInput()->withErrors([
                'code' => 'Connection already exists.',
            ]);
        }

        if ($authDevice->pendingConnections()->where('id', $deviceToConnect->id)->count() > 0 || $deviceToConnect->pendingConnections()->where('id', $authDevice->id)->count() > 0 || $deviceToConnect->cancelledConnections()->where('id', $authDevice->id)->count() > 0) {
            return back()->withInput()->withErrors([
                'code' => 'Connection request already exists.',
            ]);
        }

        if ($authDevice != $deviceToConnect) {
            $authDevice->attach($deviceToConnect);
            return redirect('/devices');
        }

        return back()->withInput()->withErrors([
            'code' => 'Something went wrong.',
        ]);
    }

    public function acceptRequest(Request $request, Device $fromDevice)
    {
        $authDevice = auth()->user();
        $authDevice->updateConnectionStatus($fromDevice, 'connected');
        return redirect('/devices');
    }

    public function declineRequest(Request $request, Device $fromDevice)
    {
        $authDevice = auth()->user();
        $authDevice->updateConnectionStatus($fromDevice, 'cancelled');
        return redirect('/devices');
    }

    public function disconnect(Request $request, Device $fromDevice)
    {
        $authDevice = auth()->user();
        $authDevice->detach($fromDevice);
        return redirect('/devices');
    }
}
