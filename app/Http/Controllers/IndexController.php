<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use Carbon\Carbon;
use App\Models\Visitor;
use App\Models\Picture;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() {

    $ipAddress = request()->ip();
    $today = Carbon::today()->toDateString();

    // Cek apakah sudah ada kunjungan dari IP yang sama hari ini
    $existingVisitor = Visitor::where('ip_address', $ipAddress)
                              ->whereDate('date', $today)
                              ->first();
    // Jika belum ada, simpan kunjungan baru
    if (!$existingVisitor) {
        Visitor::create([
            'ip_address' => $ipAddress,
            'date' => $today,
        ]);
    }
    // Menghitung total pengunjung hari ini
    $totalVisitorsToday = Visitor::whereDate('date', $today)->count();


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

        $pictures = Picture::inRandomOrder()->limit(5)->get();
        return view('index', [
            'events' => $events,
            'totalVisitorsToday' => $totalVisitorsToday,
            'pictures' => $pictures,
        ]);
    }
    public function info() {
        $ipAddress = request()->ip();
        $today = Carbon::today()->toDateString();

        // Cek apakah sudah ada kunjungan dari IP yang sama hari ini
        $existingVisitor = Visitor::where('ip_address', $ipAddress)
                                  ->whereDate('date', $today)
                                  ->first();
        // Jika belum ada, simpan kunjungan baru
        if (!$existingVisitor) {
            Visitor::create([
                'ip_address' => $ipAddress,
                'date' => $today,
            ]);
        }
        // Menghitung total pengunjung hari ini
        $totalVisitorsToday = Visitor::whereDate('date', $today)->count();

        $aulas = ['Aula Bhinneka Tunggal Ika', 'Aula Garuda', 'Aula Akcaya'];
        $pictures = Picture::whereIn('nama_aula', $aulas)->get()->groupBy('nama_aula');
        $details = [
            'Aula Bhinneka Tunggal Ika' => [
                'capacity' => '100 orang',
                'price' => 'Rp 3.000.000 per hari (maks. 8 jam)',
                'facilities' => 'Kursi rangka stainless/jok busa, sound system, AC, meja panggung, proyektor + layar, whiteboard.',
                'extra_cost' => 'Rp 250.000 per jam untuk setiap kelebihan waktu.',
            ],
            'Aula Garuda' => [
                'capacity' => '150 orang',
                'price' => 'Rp 4.000.000 per hari (maks. 8 jam)',
                'facilities' => 'Kursi rangka stainless, sound system, AC, meja panggung, proyektor + layar, whiteboard.',
                'extra_cost' => 'Rp 300.000 per jam untuk setiap kelebihan waktu.',
            ],
            'Aula Akcaya' => [
                'capacity' => '200 orang',
                'price' => 'Rp 5.000.000 per hari (maks. 8 jam)',
                'facilities' => 'Kursi rangka stainless, sound system, AC, meja panggung, proyektor + layar, whiteboard.',
                'extra_cost' => 'Rp 350.000 per jam untuk setiap kelebihan waktu.',
            ]
        ];

        return view('informasi', compact('pictures', 'details', 'aulas','totalVisitorsToday'));
        // return view ('informasi',['totalVisitorsToday'=>$totalVisitorsToday],['pictures' => $pictures],['aulas' => $aulas]);
    }
}
