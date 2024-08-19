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
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\NotificationController;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index() {
        $bookingsPaid = Booking::where('status', 'true')->get();
        $bookingsUnpaid = Booking::where('status', 'false')->get();
        // Ambil ID pengguna yang sedang login
        $userId = Auth::user()->id;

        // Cek apakah data guest ada
        $guest = Guest::where('user_id', $userId)->first();

        if (!$guest) {
            // Buat data guest baru dengan nilai default jika belum ada
            $guest = new Guest();
            $guest->user_id = $userId;
            $guest->save();

            // Arahkan pengguna ke halaman untuk mengisi data guest
            return redirect()->route('guest.fillData')->with('info', 'Anda perlu mengisi data profil terlebih dahulu.');
        }

        // Cek jika data guest sudah lengkap
        if (!$guest->no_ktp || !$guest->telp || !$guest->alamat) {
            return redirect()->route('guest.fillData')->with('info', 'Anda perlu mengisi data profil terlebih dahulu.');
        }

        // Tampilkan dashboard jika data sudah lengkap
        $events = Booking::with('aula')
            ->where('status',true)
            ->where('end', '>=', Carbon::today())
            ->select('id', 'start', 'end', 'keperluan', 'aula_id')
            ->get()
            ->map(function ($booking) {
                return [
                    'id'=> $booking->id,
                    'title' => $booking->aula->nama,
                    'start' => $booking->start,
                    'end' => Carbon::parse($booking->end),
                    'keperluan'=>$booking->keperluan,
                    'className'=>['bg-'. $booking->aula->category]
                ];
            });
            // return $events;
            $userId = Auth::user()->id;
            // Mengambil booking yang sudah dan belum dibayar berdasarkan user_id
            $bookingsPaid = Booking::where('user_id', $userId)->where('status', '1')->get();
            $bookingsUnpaid = Booking::where('user_id', $userId)->where('status', '0')->get();
            // return $bookingsUnpaid;
        return view('guest.dashboard',['events'=>$events,'bookingsPaid'=>$bookingsPaid,'bookingsUnpaid'=>$bookingsUnpaid]);
    }
    // Menampilkan halaman untuk mengisi data guest
    public function fillData()
    {
        $userId = Auth::user()->id;
        $guest = Guest::where('user_id', $userId)->first();

        // Jika data guest tidak ada, arahkan ke halaman yang sesuai
        if (!$guest) {
            $guest = new Guest();
            $guest->user_id = $userId;
            $guest->save();
        }

        return view('guest.fillData', ['guest' => $guest]);
    }

    public function saveData(Request $request)
    {
        $userId = Auth::user()->id;
        $guest = Guest::where('user_id', $userId)->first();

        if (!$guest) {
            return redirect()->route('guest.fillData')->with('error', 'Data guest tidak ditemukan.');
        }
        // Validasi input
        $request->validate([
            'no_ktp' => 'required|string',
            'telp' => 'required|string',
            'alamat' => 'required|string',
        ]);

        // Update data guest
        $guest->no_ktp = $request->input('no_ktp');
        $guest->telp = $request->input('telp');
        $guest->alamat = $request->input('alamat');
        $guest->save();

        return redirect()->route('guest.dashboard')->with('success', 'Data profil berhasil diperbarui.');
    }
    public function createBooking(){
        $user = Auth::user();
        $userId = Auth::user()->id;
        $guest = Guest::where('user_id', $userId)->first();
        // Cek jika data guest sudah lengkap
        if (!$guest->no_ktp || !$guest->telp || !$guest->alamat) {
            return redirect()->route('guest.fillData')->with('info', 'Anda perlu mengisi data profil terlebih dahulu.');
        }
        // Cek apakah user memiliki booking yang belum dibayar
        $pendingBooking = Booking::where('user_id', $user->id)
                                  ->where('status', false)
                                  ->first();
        if ($pendingBooking) {
            // Redirect ke halaman pembayaran jika ada booking yang belum dibayar
            return redirect()->route('guest.list.booking')->with('error', 'Anda memiliki pesanan yang belum dibayar. Silakan melakukan pembayaran terlebih dahulu.');
        }
        $aula =Aula::all();
        return view('guest.tambahpesanan',['aula'=>$aula]);
    }
    public function  storeBooking(Request $request){
        // Validasi input
        $validatedData = $request->validate([
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
            'aula' => 'required|in:1,2,3',
            'keperluan' => 'required'
        ]);

        $start = $validatedData['start'];
        $end = $validatedData['end'];
        $aula_id = $validatedData['aula'];

        // Cek apakah ada booking yang bertabrakan dengan status true
        $conflictBooking = Booking::where('status', true)
            ->where('aula_id', $aula_id)
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('start', [$start, $end])
                    ->orWhereBetween('end', [$start, $end])
                    ->orWhere(function ($query) use ($start, $end) {
                        $query->where('start', '<=', $start)
                            ->where('end', '>=', $end);
                    });
            })
            ->first();

        if ($conflictBooking) {
            return redirect()->back()->with('error','Aula sudah dipesan pada tanggal tersebut');
            // return response()->json(['error' => 'Aula sudah dipesan pada tanggal tersebut.'], 422);
        }

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
                'order_id' => rand(),
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

        $start = Carbon::parse($booking->start)->translatedFormat('d F Y');
        $end = Carbon::parse($booking->end)->translatedFormat('d F Y');
        $totalCostFormatted = 'Rp ' . number_format($totalCost, 0, ',', '.');
        $message = "Terdapat Permintaan Penyewaan Aula\n" .
                   "Nama: {$booking->user->name}\n".
                   "Aula yang dipesan : {$booking->aula->nama}\n".
                   "Selama : $days Hari\n" .
                   "Dimulai: $start\n".
                   "Selesai: $end\n".
                   "Total Pembayaran: $totalCostFormatted";
        // Kirim notifikasi ke Telegram
        $notificationController = new NotificationController();
        $notificationController->send(new Request(['message' => $message]));

        return redirect()->route('guest.list.booking')->with('success', 'Kegiatan Berhasil ditambahkan. Silahkan melakukan pembayaran segera');
    }
}
