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

        if ($authDevice->getConnections('all', ['cancelled', 'connected', 'pending'])->where('id', $deviceToConnect->id)->count() > 0) {
            return back()->withInput()->withErrors([
                'code' => 'Connection request already exists.',
            ]);
        }

        if ($authDevice != $deviceToConnect) {
            $authDevice->attach($deviceToConnect);
            return back()->with('success', 'Request sent! Accept it in other device.');
        }

        return back()->withInput()->withErrors([
            'code' => 'Cannot connect same device you dumbass.',
        ]);
    }

    public function acceptRequest(Request $request, Device $fromDevice)
    {
        $authDevice = auth()->user();
        $authDevice->updateConnectionStatus($fromDevice, 'connected');
        return back()->with('success', 'Device successfully connected.');
    }

    public function declineRequest(Request $request, Device $fromDevice)
    {
        $authDevice = auth()->user();
        $authDevice->updateConnectionStatus($fromDevice, 'cancelled');
        return back()->with('success', 'Request cancelled.');
    }

    public function cancelRequest(Request $request, Device $toDevice)
    {
        $authDevice = auth()->user();
        if ($authDevice->getConnections('from', 'pending')->contains('id', $toDevice->id)) {
            $authDevice->detach($toDevice, 'pending');
            return back()->with('success', 'Connection request cancelled.');
        }
    }

    public function disconnect(Request $request, Device $fromDevice)
    {
        $authDevice = auth()->user();
        $authDevice->detach($fromDevice, 'connected');
        return back()->with('success', 'Device successfully disconnected.');
    }
}
