<?php

namespace App\Http\Controllers;
use App\Models\Aula;
use App\Models\User;
use App\Models\Role;
use App\Models\Guest;
use App\Models\Booking;
use Auth;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index() {
        return view('guest.dashboard');
    }
    public function createBooking(){
        $aula =Aula::all();
        return view('guest.tambahpesanan',['aula'=>$aula]);
    }
    public function  storeBooking(Request $request){
        $user = Auth::user()->id;
        Booking::create([
            'user_id'=>$user,
            'aula_id' => $request->aula,
            'start' => $request->start,
            'end' => $request->end,
            'keperluan' => $request->keperluan,
            'status' => false,
        ]);
        return redirect()->route('guest.booking')->with('success', 'Kegiatan Berhasil di Request.');
    }
}
