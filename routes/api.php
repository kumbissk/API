<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\PersonneController;
use Faker\Provider\ar_EG\Person;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register'])->name('register.api');
Route::post('login', [AuthController::class, 'login'])->name('login.api');

// Route::get('/register', [AuthController::class, 'register'])->name('register.api');

Route::get('listeUtilisateurs', [AuthController::class, 'index'])->name('index.api');

Route::get('listeUtilisateurs/{id}', [AuthController::class, 'findOneUser'])->name('findOneUser.api');

Route::put('listeUtilisateurs/{id}', [AuthController::class, 'update'])->name('update.api');

Route::post('personnes', [PersonneController::class, 'store'])->name('store.api');

Route::get('personnes', [PersonneController::class, 'allPersonne'])->name('allPersonne.api');

Route::get('personnes/{id}', [PersonneController::class, 'show'])->name('show.api');

Route::delete('personnes/{id}', [PersonneController::class, 'destroy'])->name('destroy.api');

Route::delete('listeUtilisateurs/{id}', [AuthController::class, 'destroy'])->name('destroy.api');

Route::middleware('auth:api')->group(function(){
    Route::get('get-user', [AuthController::class, 'userInfo'])->name('get-user.api');
});

