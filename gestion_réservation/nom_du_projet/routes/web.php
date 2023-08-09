<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CalendarController;

use App\Http\Controllers\dashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;

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
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('calendar/index',[CalendarController::class,'index'])->name('calendar.index');
Route::post('calendar',[CalendarController::class,'store'])->name('calendar.store');

Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::delete('calendar/destroy/{id}',[CalendarController::class,'destroy'])->name('calendar.destroy');

Route::get('calendar/show_reservations', [CalendarController::class, 'showReservations'])->name('show.reservations');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
// Route::post('/user/destroy', [ProfileController::class, 'destroy'])->name('user.destroy'); // Vous pouvez ajuster le nom de la route ici si nécessaire

// Afficher toutes les réservations de l'utilisateur
Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');



Route::get('/profile', [ProfileController::class, 'show'])->middleware('auth')->name('profile.show');

Route::put('/reservation/{id}', [CalendarController::class, 'update'])->name('reservation.update');



require __DIR__.'/auth.php';
