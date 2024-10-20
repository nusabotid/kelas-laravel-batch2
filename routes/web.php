<?php

use App\Http\Controllers\ProductController;
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
