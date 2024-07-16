<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
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
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.dashboard');
    Route::get('/create',[AdminController::class,'createUser'])->name('admin.create.user');
    Route::post('/store',[AdminController::class,'storeUser'])->name('admin.store.user');

});
Route::prefix('employee')->middleware(['auth','role:employee'])->group(function(){
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('employee.dashboard');
});
Route::prefix('guest')->middleware(['auth','role:guest'])->group(function(){
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('guest.dashboard');
});
Route::get('/', function () {
    return view('welcome');
});


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

