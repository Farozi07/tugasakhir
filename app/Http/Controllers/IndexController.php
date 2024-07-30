<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() {
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
        return view('index',['events'=>$events]);
    }
}
