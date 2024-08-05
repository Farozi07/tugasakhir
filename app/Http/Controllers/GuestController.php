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

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index() {
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
            ->where('start', '>=', Carbon::today())
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
        return view('guest.dashboard',['events'=>$events]);
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
        // Validasi input
        $validatedData = $request->validate([
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
            'aula' => 'required|exists:aulas,id',
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
        return redirect()->route('guest.create.booking')->with('success', 'Kegiatan Berhasil di Request.');
    }
}
