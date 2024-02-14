<?php

use App\Models\Device;
use App\Models\FileTransfer;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index', [
        'device' => Device::find(1),
    ]);
});

Route::get('/devices', function () {
    return view('devices', [
        'device' => Device::find(1),
    ]);
});

Route::get('/log', function () {
    return view('log', [
        'device' => Device::find(1),
    ]);
});

Route::get('/add-device', function () {
    return view('add-device');
});

Route::fallback(function () {
    return redirect('/');
});
