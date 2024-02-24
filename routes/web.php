<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeviceController;
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

Route::get('/', [AuthController::class, 'auth']);

Route::post('/create-device', [AuthController::class, 'createDevice']);
Route::delete('/delete-device', [AuthController::class, 'deleteDevice'])->middleware('auth');
Route::get('/logout', [AuthController::class, 'logout']); //! FOR DEBUG ONLY


Route::get('/devices', function () {
    return view('devices');
})->middleware('auth');

Route::get('/log', function () {
    return view('log');
})->middleware('auth');

Route::post('/add-device', [DeviceController::class, 'connectionRequest']);
Route::put('/accept-connection/{fromDevice}', [DeviceController::class, 'acceptRequest']);
Route::delete('/decline-connection/{fromDevice}', [DeviceController::class, 'declineRequest']);
Route::delete('/delete-connection/{fromDevice}', [DeviceController::class, 'disconnect']);

Route::fallback(function () {
    return redirect('/');
});
