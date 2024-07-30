<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Models\Booking;

class EventController extends Controller
{
    public function index()
    {
        $data=Booking::select([
            'id',
            'keperluan as title',
            'start',
            'end',
        ])->where('status',true)->get();
        // $data=response()->json(Booking::all());
        // return response()->json($data);
        // return $data;
        return view('admin.events',['data'=>$data]);
    }
    public function store(Request $request)
    {
        $booking = Booking::create($request->all());
        return response()->json($booking);
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update($request->all());
        return response()->json($booking);
    }

    public function destroy($id)
    {
        Booking::destroy($id);
        return response()->json(['message' => 'Booking deleted successfully']);
    }
}
