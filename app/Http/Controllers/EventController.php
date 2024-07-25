<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Models\Booking;

class EventController extends Controller
{
        public function index()
    {
        return view('admin.events');
    }

    public function listEvent(Request $request)
    {
        $start = date('Y-m-d', strtotime($request->start));
        $end = date('Y-m-d', strtotime($request->end));

        $events = Booking::where('start', '>=', $start)
        ->where('end', '<=' , $end)->get()
        ->map( fn ($item) => [
            'id' => $item->id,
            'title' => $item->title,
            'start' => $item->start,
            'end' => date('Y-m-d',strtotime($item->end. '+1 days')),
        ]);

        return response()->json($events);
    }
}
