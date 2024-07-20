<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
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
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('guest.dashboard');
});

Route::get('/', [IndexController::class, 'index'])->name('index');


//Admin
// Route::get('/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');


//Route Menambahkan Data Aula
Route::get('/manual-aula',function(){
    Aula::create(
        [
            'nama' => 'Aula Bhinneka Tunggal Ika',
            'deskripsi' => '100 Orang',
        ]
    );

    Aula::create(
        [
            'nama' => 'Aula Garuda',
            'deskripsi' => '100 S.D 150 Orang',
        ]
    );
    Aula::create(
        [
            'nama' => 'Aula Akcaya',
            'deskripsi' => '40 Orang',
        ]
    );
});

Auth::routes();

