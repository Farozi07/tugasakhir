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
        $guest = Guest::where('user_id', $user)->first();
        // Cek jika data guest sudah lengkap
        if (!$guest->no_ktp || !$guest->telp || !$guest->alamat) {
            return redirect()->route('guest.fillData')->with('info', 'Anda perlu mengisi data profil terlebih dahulu.');
        }
        $bookings = Booking::where('user_id', $user)
        ->orderBy('id', 'asc')
        ->with('transaction')
        ->get();
        // return $bookings;
        return view('guest.list',['bookings'=>$bookings]);
    }
    public function requestCancellation(Request $request, $id){
        $booking = Booking::findOrFail($id);
        $booking->cancellation_requested = true;
        $booking->cancellation_reason = $request->cancellation_reason;
        $booking->save();

        // Update jumlah permintaan pembatalan pada pengguna
        $user = $booking->user;
        $user->increment('cancellation_request_count');

        // Prepare message for Telegram
        $start = Carbon::parse($booking->start)->format('d M Y');
        $end = Carbon::parse($booking->end)->format('d M Y');
        $days = Carbon::parse($booking->start)->diffInDays(Carbon::parse($booking->end))+1;

        $message = "Terdapat Permintaan Pembatalan Booking Aula\n" .
                "Nama: {$booking->user->name}\n" .
                "Aula yang dipesan: {$booking->aula->nama}\n" .
                "Selama: $days Hari\n" .
                "Dimulai: $start\n" .
                "Selesai: $end\n" .
                "Alasan Pembatalan: {$booking->cancellation_reason}";
        // return $message;
        $notificationController = new NotificationController();
        $notificationController->send(new Request(['message' => $message]));
        return redirect()->back()->with('success', 'Permintaan pembatalan telah dikirim ke admin.');
    }
    // public function listshow($id){
    //     $bookings = Booking::with('transaction')
    //     ->where('id',$id)->first();
    //     // $transaction=Transaction::where('booking_id',$bookings->id);
    //     $days = Carbon::parse($bookings->start)->diffInDays(Carbon::parse($bookings->end))+1;;
    //     $pricePerDay = $bookings->aula->price;
    //     // Menghitung total biaya
    //     $totalCost = $days * $pricePerDay;
    //     // return $transaction;
    //     return view('guest.checkout', compact('bookings','totalCost','days'));
    // }
    public function success(Booking $p){
        $transaction = Transaction::where('booking_id', $p->id)->first();

        // Periksa apakah transaksi ditemukan
        if ($transaction) {
            // Ubah status transaksi menjadi 'success'
            $transaction->status = 'success';
            $transaction->save();
        }
        $p->status = true;
        $p->save();
        return view('guest.success');

    }
}
