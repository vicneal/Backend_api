<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
//Route::get('/usuario/{email}',[UsuarioController::class,'getUser']);

// Route::group([

//     // 'middleware' => 'api',
//     'prefix' => 'auth'

// ], function () {
//     Route::post('login', [AuthController::class, 'login']);
//     Route::post('logout', [AuthController::class, 'logout']);
//     Route::post('refresh', [AuthController::class, 'refresh']);
//     Route::post('me', [AuthController::class, 'me']);
//     Route::post('register', [AuthController::class, 'register']);
// });

Route::group([

    // 'middleware' => 'api',
    'prefix' => 'auth'

], function () {
    Route::post('login', [UsuarioController::class, 'login']);
    Route::post('logout', [UsuarioController::class, 'logout']);
    Route::post('refresh', [UsuarioController::class, 'refresh']);
    Route::post('me', [UsuarioController::class, 'me']);
    Route::post('register', [UsuarioController::class, 'register']);
});

Route::get('listRol',[RolController::class,'index']);
Route::put('/roles/{id}/estado', [RolController::class,'updateEstado']);
Route::post('addRol',[RolController::class,'store']);
