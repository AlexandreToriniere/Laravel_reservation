<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ClientsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PrestationController;
use App\Http\Controllers\Frontend\WelcomeController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Frontend\FrontendPrestationController;
use App\Http\Controllers\Frontend\FrontendReservationController;

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


//FrontEnd
Route::get('/reservation/step-one', [FrontendReservationController::class,'stepOne'])->name('reservation.step.one');
Route::post('/reservation/step-one', [FrontendReservationController::class,'storeStepOne'])->name('reservation.store.step.one');
Route::get('/thankyou', [WelcomeController::class, 'thankyou'])->name('thankyou');
Route::get('/prestations', [FrontendPrestationController::class, 'prestation'])->name('prestation');

//BackEnd
Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function(){
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::resource('/categories', CategoryController::class);
    Route::resource('/prestations', PrestationController::class);
    Route::resource('/reservations', ReservationController::class);
    Route::resource('/clients', ClientsController::class);
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
