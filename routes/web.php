<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\UserController;
// use App\Http\Middleware\isAdmin;
// use App\Http\Middleware\isLogin;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'rootPage']);

// Route::get('/greeting', function () {
//     $greeting = 'Halo, selamat datang di website saya, lewat variable';

//     $skills = ['HTML', 'CSS', 'JS'];

//     foreach ($skills as $key => $skill) {
//         echo $skill;
//         echo "<br />";
//         if ($skill === 'CSS') {
//             echo "Saya juga bisa bootstrap";
//             echo "<br />";
//         }
//     }

//     $qParam = request('q');
//     $pageParam = request('page');
//     echo "Judul Berita: $qParam";
//     echo "<br />";
//     echo "Halaman: $pageParam";
// });

// Route::get('/debug', function () {
//     $skills = [
//         [
//             "name" => "HTML",
//         ],
//         [
//             "name" => "CSS",
//         ],
//         [
//             "name" => "Javascript",
//         ],
//     ];

//     dd($skills);
// });

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'getDetail']);
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'delete']);

Route::get('/public-dashboard', [DashboardController::class, 'publicDashboard']);

Route::middleware("is-login")->group(function($router) {
    $router->get('/dashboard', [DashboardController::class, 'index']);

    $router->get('/devices', [DeviceController::class, 'index']);
    $router->get('/devices/create', [DeviceController::class, 'create']);
    $router->get('/devices/edit/{id}', [DeviceController::class, 'edit']);
    $router->post('/devices/store', [DeviceController::class, 'store']);
    $router->put('/devices/update/{id}', [DeviceController::class, 'update']);
    $router->delete('/devices/delete/{id}', [DeviceController::class, 'delete']);
    $router->get('/ubah-password', [UserController::class, 'updatePasswordView']);
    $router->put('/ubah-password', [UserController::class, 'updatePassword']);
});

Route::middleware('is-admin')->group(function($router) {
    $router->get('/sensors', [SensorController::class, 'index']);
    $router->get('/sensors/create', [SensorController::class, 'create']);
    $router->post('/sensors/store', [SensorController::class, 'store']);
    $router->get('/sensors/edit/{id}', [SensorController::class, 'edit']);
    $router->put('/sensors/update/{id}', [SensorController::class, 'update']);
    $router->delete('/sensors/delete/{id}', [SensorController::class, 'delete']);
});
