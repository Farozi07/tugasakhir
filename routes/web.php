<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Auth\GitHubController;
use App\Http\Controllers\Auth\GoogleController;
use App\Models\Aula;
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

Route::get('auth/google', [GoogleController::class, 'redirectToProvider'])->name('login.provider.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleProviderCallback'])->name('login.callback.google');

Route::get('auth/github', [GitHubController::class, 'redirectToProvider'])->name('login.provider.github');
Route::get('auth/github/callback', [GitHubController::class, 'handleProviderCallback'])->name('login.callback.github');



Route::get('/home', function(){
    if (Auth::user()->role->name == 'admin') {
        return redirect()->route('admin.dashboard');
    }elseif (Auth::user()->role->name == 'employee') {
        return redirect()->route('employee.dashboard');
    }elseif (Auth::user()->role->name == 'guest') {
        return redirect()->route('guest.dashboard');
    }
});

Route::prefix('admin')->middleware(['auth','role:admin'])->group(function(){
    Route::get('/dashboard', [AdminController::class,'index'])->name('admin.dashboard');
    Route::post('/events', [AdminController::class, 'createEvent'])->name('admin.events.store');
    Route::put('/events/{id}', [AdminController::class, 'updateEvent'])->name('admin.events.update');
    Route::delete('/events/{id}', [AdminController::class, 'deleteEvent'])->name('admin.events.destroy');


    Route::get('/list/guest',[AdminController::class,'listBookingGuest'])->name('admin.list.booking.guest');
    Route::get('/list/employee',[AdminController::class,'listBookingEmployee'])->name('admin.list.booking.employee');


    Route::get('/create/guest',[AdminController::class,'createGuest'])->name('admin.create.guest');
    Route::post('/store/guest',[AdminController::class,'storeGuest'])->name('admin.store.guest');

    Route::get('/create/booking/guest',[AdminController::class,'createBookingGuest'])->name('admin.create.booking.guest');
    Route::post('/store/booking/guest',[AdminController::class,'storeBookingGuest'])->name('admin.store.booking.guest');

    Route::get('/create/employee',[AdminController::class,'createEmployee'])->name('admin.create.employee');
    Route::post('/store/employee',[AdminController::class,'storeEmployee'])->name('admin.store.employee');

    Route::get('/create/booking/employee',[AdminController::class,'createBookingEmployee'])->name('admin.create.booking.employee');
    Route::post('/store/booking/employee',[AdminController::class,'storeBookingEmployee'])->name('admin.store.booking.employee');


});
Route::prefix('employee')->middleware(['auth','role:employee'])->group(function(){
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('employee.dashboard');
});
Route::prefix('guest')->middleware(['auth','role:guest'])->group(function(){
    Route::get('/dashboard', [GuestController::class,'index'])->name('guest.dashboard');
    Route::get('/fill-data', [GuestController::class, 'fillData'])->name('guest.fillData');
    Route::post('/save-data', [GuestController::class, 'saveData'])->name('guest.saveData');

    Route::get('/create', [GuestController::class,'createBooking'])->name('guest.create.booking');
    Route::post('/store',[GuestController::class,'storeBooking'])->name('guest.store.booking');

    Route::get('/list',[CheckoutController::class,'list'])->name('guest.list.booking');
    Route::get('/list/checkout/{id}',[CheckoutController::class,'listshow'])->name('guest.checkout.id');
    Route::post('/checkout/{id}', [CheckoutController::class, 'process'])->name('guest.checkout-process');
    Route::get('/checkout/success/{bookings}', [CheckoutController::class, 'success'])->name('guest.transaction.success');


    Route::get('/product/{id}', [GuestController::class, 'show'])->name('guest.product');
    Route::get('/transactions', [TransactionController::class, 'index'])->name('guest.transactions');
});

Route::get('/', [IndexController::class, 'index'])->name('index');

Auth::routes();

