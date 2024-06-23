<?php

use App\Http\Controllers\MenuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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


Route::get("/menu", [MenuController::class, 'index'])->name('menu.index');
Route::post("/menu", [MenuController::class, 'store'])->name('menu.store');
Route::get("/menu/{id}", [MenuController::class, 'show'])->name('menu.show');
Route::put("/menu/{id}", [MenuController::class, 'update'])->name('menu.update');
Route::delete("/menu/{id}", [MenuController::class, 'destroy'])->name('menu.destroy');
Route::get("/users", [UserController::class, 'index'])->name('users.index');

Route::post("/user-register", [UserController::class, 'register'])->name('user.register');
Route::post("/user-login", [UserController::class, 'login'])->name('user.login');



//.