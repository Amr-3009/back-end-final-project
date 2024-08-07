<?php

use App\Http\Controllers\MenuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;

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

// public
Route::get("/menu", [MenuController::class, 'index'])->name('menu.index');
Route::post("/user-register", [UserController::class, 'register'])->name('user.register');
Route::post("/user-login", [UserController::class, 'login'])->name('user.login');
Route::post("/admin-login", [AdminController::class, 'login'])->name('admin.login');

Route::middleware('auth:sanctum')->group(function () {
  // user privilages only
Route::get("/user/{id}", [UserController::class, 'show'])->name('user.show');
Route::put("/user/{id}", [UserController::class, 'update'])->name('user.update');
Route::get("/user-bookings/{user_id}", [BookingController::class, 'show'])->name('user.bookings');
Route::post("/booking", [BookingController::class, 'store'])->name('booking.store');
// admin privilages only
Route::post("/menu", [MenuController::class, 'store'])->name('menu.store');
Route::get("/menu/{id}", [MenuController::class, 'show'])->name('menu.show');
Route::put("/menu/{id}", [MenuController::class, 'update'])->name('menu.update');
Route::delete("/menu/{id}", [MenuController::class, 'destroy'])->name('menu.destroy');
Route::get("/users", [UserController::class, 'index'])->name('users.index');
Route::post("/admin-register", [AdminController::class, 'register'])->name('admin.register');
Route::get("/bookings", [BookingController::class, 'index'])->name('bookings.index');
Route::put("/accept-booking/{id}", [BookingController::class, 'acceptBooking'])->name('booking.accept');
Route::put("/reject-booking/{id}", [BookingController::class, 'rejectBooking'])->name('booking.reject');
});
//.