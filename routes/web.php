<?php

use App\Http\Controllers\AuthController;
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

Route::get(
    '/', /*function () {
return view('index', [
'device' => Device::find(1),
]);
}*/ [AuthController::class, 'auth']
);

Route::post('/create-device', [AuthController::class, 'createDevice']);
Route::get('/logout', [AuthController::class, 'logout']); //! FOR DEBUG ONLY


Route::get('/devices', function () {
    return view('devices', [
        'device' => Device::find(1),
    ]);
})->middleware('auth');

Route::get('/log', function () {
    return view('log', [
        'device' => Device::find(1),
    ]);
})->middleware('auth');

Route::get('/add-device', function () {
    return view('add-device');
})->middleware('auth');

Route::fallback(function () {
    return redirect('/');
});
