<?php

namespace App\Http\Controllers;
use App\Models\Guest;
use App\Models\Booking;
use App\Models\Transaction;
use App\Models\Aula;
use Auth;
use Carbon\Carbon;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function list(){
        $user = Auth::user()->id;
        $bookings = Booking::where('user_id', $user)
        ->with('transaction')
        ->get();
        return view('guest.list',['bookings'=>$bookings]);
    }
    public function listshow($id){
        $bookings = Booking::with('transaction')
        ->where('id',$id)->first();
        // $transaction=Transaction::where('booking_id',$bookings->id);
        $days = Carbon::parse($bookings->start)->diffInDays(Carbon::parse($bookings->end))+1;;
        $pricePerDay = $bookings->aula->price;
        // Menghitung total biaya
        $totalCost = $days * $pricePerDay;
        // return $transaction;
        return view('guest.checkout', compact('bookings','totalCost','days'));
    }
    public function success(Booking $bookings){
        $transaction = Transaction::where('booking_id', $bookings->id)->first();

        // Periksa apakah transaksi ditemukan
        if ($transaction) {
            // Ubah status transaksi menjadi 'success'
            $transaction->status = 'success';
            $transaction->save();
        }
        $bookings->status = true;
        $bookings->save();
        return view('guest.success');

    }
}
