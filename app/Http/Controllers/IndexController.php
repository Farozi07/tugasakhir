<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use Carbon\Carbon;
use App\Models\Visitor;
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
        return view('index',['events'=>$events],['totalVisitorsToday'=>$totalVisitorsToday]);
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
        return view ('informasi',['totalVisitorsToday'=>$totalVisitorsToday]);
    }
}
