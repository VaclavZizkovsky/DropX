<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Device;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function createDevice(Request $request)
    {
        $deviceValues = $request->validate([
            'name' => ['required', 'regex:/^\S.*$/'],
            'type' => ['required',],
        ]);

        strip_tags($deviceValues['name']);
        if ($deviceValues['type'] != 'Mobile') {
            $deviceValues['type'] = 'Desktop';
        }

        $deviceValues['code'] = $this->generateUniqueCode();

        $device = Device::create($deviceValues);
        Auth::login($device, true);
        return redirect('/');
    }

    protected function generateUniqueCode()
    {
        $code = random_int(100000, 999999);

        if (Device::where('code', $code)->exists()) {
            return $this->generateUniqueCode();
        }
        return $code;
    }

    public function auth()
    {
        if (Auth::check()) {
            return view('index');
        } else {
            return view('welcome');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function deleteDevice(Request $request)
    {
        auth()->user()->delete();
        return redirect('/');
    }
}
