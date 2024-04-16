<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\FileTransferController;
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


Route::get('/devices', function () {
    return view('devices');
})->middleware('auth');

Route::get('/log', function () {
    return view('log');
})->middleware('auth');

Route::post('/add-device', [DeviceController::class, 'connectionRequest'])->middleware('auth');
Route::put('/accept-connection/{fromDevice}', [DeviceController::class, 'acceptRequest'])->middleware('auth');
Route::delete('/decline-connection/{fromDevice}', [DeviceController::class, 'declineRequest'])->middleware('auth');
Route::delete('/cancel-connection/{toDevice}', [DeviceController::class, 'cancelRequest'])->middleware('auth');
Route::delete('/delete-connection/{fromDevice}', [DeviceController::class, 'disconnect'])->middleware('auth');

Route::post('/upload', [FileTransferController::class, 'uploadFiles'])->middleware('auth');
Route::post('/download/{fileTransfer}', [FileTransferController::class, 'downloadFiles'])->middleware('auth');
Route::delete('/decline-transfer/{fileTransfer}', [FileTransferController::class, 'rejectTransfer'])->middleware('auth');

Route::fallback(function () {
    return redirect('/');
});
