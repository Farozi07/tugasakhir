<?php

namespace App\Http\Controllers;
use App\Models\Aula;
use App\Models\User;
use App\Models\Role;
use App\Models\Guest;
use App\Models\Booking;
use App\Models\Transaction;
use Auth;
use Carbon\Carbon;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index() {
        $products = Booking::all();
        // return $products;
        return view('guest.dashboard', compact('products'));
    }
    public function show($id)
    {
        $products = Booking::all();

        $product = collect($products)->firstWhere('id', $id);
        // return $product;
        return view('guest.product', compact('product'));
    }
    public function createBooking(){
        $aula =Aula::all();
        return view('guest.tambahpesanan',['aula'=>$aula]);
    }
    public function  storeBooking(Request $request){

        $user = Auth::user()->id;
        $booking=Booking::create([
            'user_id'=>$user,
            'aula_id' => $request->aula,
            'start' => $request->start,
            'end' => $request->end,
            'keperluan' => $request->keperluan,
            'status' => false,
        ]);
        $days = Carbon::parse($booking->start)->diffInDays(Carbon::parse($booking->end))+1;;
        $pricePerDay = $booking->aula->price;
        // Menghitung total biaya
        $totalCost = $days * $pricePerDay;

        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        $transaction=Transaction::create([
            'booking_id'=>$booking->id,
            'price'=>$totalCost,
            'status'=>'pending',
        ]);
        $params = array(
            'transaction_details' => array(
                'order_id' => $booking->id,
                'gross_amount' => $totalCost,
            ),
            'customer_details'=> array(
                'first_name'=>$booking->user->name,
                'email'=>$booking->user->email,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $transaction->snap_token=$snapToken;
        $transaction->save();
        return redirect()->route('guest.create.booking')->with('success', 'Kegiatan Berhasil di Request.');
    }
}
