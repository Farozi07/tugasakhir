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
use App\Http\Controllers\PictureController;
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
    Route::get('/list/booking',[AdminController::class,'listBooking'])->name('admin.list.booking');
    Route::get('/list/booking/pending',[AdminController::class,'listBookingPending'])->name('admin.list.booking.pending');
    Route::get('/list/akun', [AdminController::class, 'daftarAkun'])->name('admin.daftar.akun');
    Route::post('/list/edit/akun', [AdminController::class, 'editAkun'])->name('admin.edit.akun');
    Route::delete('/list/hapus/akun/{id}', [AdminController::class, 'deleteAkun'])->name('admin.hapus.akun');
    Route::get('/pictures', [PictureController::class, 'index'])->name('admin.pictures');
    Route::post('/pictures/upload', [PictureController::class, 'store'])->name('admin.pictures.store');
    Route::put('/pictures/update/{picture}', [PictureController::class, 'update'])->name('admin.pictures.update');
    Route::delete('/pictures/delete/{picture}', [PictureController::class, 'destroy'])->name('admin.pictures.destroy');

    // Route::get('/list/guest',[AdminController::class,'listBookingGuest'])->name('admin.list.booking.guest');
    Route::delete('/list/guest/{id}',[AdminController::class,'listBookingDelete'])->name('admin.list.booking.delete');
    Route::get('/list/cancel',[AdminController::class,'getCancellationRequests'])->name('admin.list.booking.cancel.guest');
    Route::get('/cancel/pesanan', [AdminController::class, 'getCancellationRequests'])->name('admin.cancellationRequests');
    Route::post('/cancel/{id}', [AdminController::class, 'processCancellation'])->name('admin.processCancellation');

    Route::get('/list/employee',[AdminController::class,'listBookingEmployee'])->name('admin.list.booking.employee');

    Route::get('/create/guest',[AdminController::class,'createGuest'])->name('admin.create.guest');
    Route::post('/store/guest',[AdminController::class,'storeGuest'])->name('admin.store.guest');

    Route::get('/create/booking/guest',[AdminController::class,'createBookingGuest'])->name('admin.create.booking.guest');
    Route::post('/store/booking/guest',[AdminController::class,'storeBookingGuest'])->name('admin.store.booking.guest');

    Route::get('/create/employee',[AdminController::class,'createEmployee'])->name('admin.create.employee');
    Route::post('/store/employee',[AdminController::class,'storeEmployee'])->name('admin.store.employee');

    Route::get('/create/booking/employee',[AdminController::class,'createBookingEmployee'])->name('admin.create.booking.employee');
    Route::post('/store/booking/employee',[AdminController::class,'storeBookingEmployee'])->name('admin.store.booking.employee');
    Route::delete('/delete/booking/employee/{id}',[AdminController::class,'deleteBookingEmployee'])->name('admin.delete.booking.employee');

    Route::get('/bookings/export', [AdminController::class, 'export'])->name('admin.booking.export');


});
Route::prefix('employee')->middleware(['auth','role:employee'])->group(function(){
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('employee.dashboard');
});
Route::prefix('guest')->middleware(['auth','role:guest'])->group(function(){
    Route::get('/dashboard', [GuestController::class,'index'])->name('guest.dashboard');
    Route::get('/informasi',[GuestController::class,'info'])->name('guest.info');
    Route::get('/fill-data', [GuestController::class, 'fillData'])->name('guest.fillData');
    Route::post('/save-data', [GuestController::class, 'saveData'])->name('guest.saveData');

    Route::post('/send-notification', 'NotificationController@send');
    Route::get('/create', [GuestController::class,'createBooking'])->name('guest.create.booking');
    Route::post('/store',[GuestController::class,'storeBooking'])->name('guest.store.booking');

    Route::get('/list',[CheckoutController::class,'list'])->name('guest.list.booking');
    Route::post('/list/request-cancellation/{id}', [CheckoutController::class, 'requestCancellation'])->name('guest.req.cancel');
    // Route::get('/list/checkout',[CheckoutController::class,'listshow'])->name('guest.checkout.id');
    // Route::post('/checkout/{id}', [CheckoutController::class, 'process'])->name('guest.checkout-process');
    Route::get('/checkout/success/{p}', [CheckoutController::class, 'success'])->name('guest.transaction.success');
});

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/informasi', [IndexController::class, 'info'])->name('info');

Auth::routes();
