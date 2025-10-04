<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CameraController;
use App\Http\Middleware\CheckLogin;

use App\Models\Camera;

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
    $cameras = Camera::with('location')->get();
    $result = [];

    foreach ($cameras as $cam) {
        $file = public_path("stream/{$cam->slug}/playlist.m3u8");

        $status = 'offline';
        if (file_exists($file)) {
            $lastModified = filemtime($file);
            if (time() - $lastModified <= 15) {
                $status = 'online';
            }
        }

        $result[] = [
            'name'   => $cam->name,
            'slug'   => $cam->slug,
            'status' => $status,
        ];
    }

    $data = [
        'head' => 'Dashboard',
        'menu' => 'Dashboard',
        'cameras' => $cameras
    ];
    return view('dashboard/index')->with($data);
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/cameras/status', [CameraController::class, 'statusCameras']);
Route::get('/dashboard/cameras/status', [CameraController::class, 'statusCamerasDash']);

Route::group(['middleware' => 'auth'], function () {
    Route::middleware([CheckLogin::class])->group(function () {
        Route::get('/dashboard', function () {
            $cameras = Camera::with('location')->get();
            
            foreach ($cameras as $cam) {
                $file = public_path("stream/{$cam->slug}/playlist.m3u8");

                if (!file_exists($file)) {
                    $statuses[$cam->slug] = 'offline';
                    continue;
                }

                // cek last modified, misalnya kalau lebih dari 15 detik dianggap offline
                $lastModified = filemtime($file);
                if (time() - $lastModified > 15) {
                    $statuses[$cam->slug] = 'offline';
                } else {
                    $statuses[$cam->slug] = 'online';
                }
            }
            
            $data = [
                'head' => 'Dashboard',
                'menu' => 'Dashboard',
                'cameras' => $cameras,
                'status' => $statuses
            ];
            return view('cctv/index')->with($data);
        })->name('dashboard');
    });
    Route::resource('/cctv', CameraController::class);
});
