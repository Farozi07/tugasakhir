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
        $bookings = Booking::where('user_id', Auth::id())->get();
        // return $bookings;
        return view('guest.list',['bookings'=>$bookings]);
    }
    public function listshow($id){
        $bookings = Booking::where('id',$id)
        ->with('transaction')
        ->first();
        $days = Carbon::parse($bookings->start)->diffInDays(Carbon::parse($bookings->end))+1;;
        $pricePerDay = $bookings->aula->price;
        // Menghitung total biaya
        $totalCost = $days * $pricePerDay;
        // return $bookings;
        return view('guest.checkout', compact('bookings','totalCost','days'));
    }
}
