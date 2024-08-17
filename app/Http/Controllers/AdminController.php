<?php

namespace App\Http\Controllers;
use App\Models\Aula;
use App\Models\Role;
use App\Models\User;
use App\Models\Employee;
use App\Models\Guest;
use App\Models\Booking;
use Hash;
use Carbon\Carbon;
use Auth;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index(Request $request){
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
        return view('admin.dashboard',['events'=>$events]);
    }

    public function listBookingGuest(){
        $data=Booking::where('status',true)
        ->with(['user' => function($g){
            $g->with('guest');
        }])
        ->whereHas('user',function($u){
            $u->whereHas('guest');
        })
        ->get();
        // return $data;
        return view ('admin.list_booking_guest',['data'=>$data]);
    }
    public function getCancellationRequests(){
        $data = Booking::where('cancellation_requested', true)
        ->with(['user' => function($query) {
            $query->with('guest');
        }])
        ->whereHas('user', function($query) {
            $query->whereHas('guest');
        })
        ->get();
        // return $data;
        return view('admin.list_cancellation_requests', ['data' => $data]);
    }

    public function processCancellation(Request $request, $id){
        $booking = Booking::findOrFail($id);

        if ($request->action == 'approve') {
            // Hapus booking jika pembatalan disetujui
            $booking->delete();
            return redirect()->back()->with('success', 'Booking telah dibatalkan dan dihapus.');
        } else {
            // Tolak permintaan pembatalan
            $booking->cancellation_requested = false;
            $booking->cancellation_reason = null;
            $booking->save();
        return redirect()->back()->with('success', 'Booking sudah diterima dan dihapus.');
        }
    }

    public function listBookingEmployee(){
        $data=Booking::with(['user' => function($g){
            $g->with('employee');
        }])
        ->whereHas('user',function($u){
            $u->whereHas('employee');
        })
        ->get();
        return view ('admin.list_booking_employee',['data'=>$data]);
    }

    public function createGuest(){
        return view ('admin.create_guest');
    }
    public function storeGuest(Request $request){
        $role = Role::where('name','guest')->first();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $role->id,
        ]);

        Guest::create([
            'user_id'=>$user->id,
            'no_ktp'=>$request->no_ktp,
            'telp'=>$request->telp,
            'alamat'=>$request->alamat,
        ]);

        return redirect()->route('admin.create.guest')->with('success', 'Guest created successfully.');
    }
    public function createEmployee(){
        return view ('admin.create_employee');
    }
    public function storeEmployee(Request $request){
        $role = Role::where('name','employee')->first();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $role->id,
        ]);

        Employee::create([
            'user_id'=>$user->id,
            'nama_bidang'=>$request->nama_bidang,
            'penanggung_jawab'=>$request->penanggung_jawab,
        ]);
        return redirect()->route('admin.create.employee')->with('success', 'Employee created successfully.');
    }
    public function createBookingGuest(){
        $aula =Aula::all();
        $data =User::whereHas('guest')->get();
        return view ('admin.create_booking_guest',['data'=>$data],['aula'=>$aula]);
    }
    public function storeBookingGuest(Request $request){
        $booking=Booking::create([
            'user_id'=>$request->name,
            'aula_id' => $request->aula,
            'start' => $request->start,
            'end' => $request->end,
            'keperluan' => $request->keperluan,
            'status' => true,
        ]);
        return redirect()->route('admin.create.booking.guest')->with('success', 'Kegiatan Berhasil Ditambahkan.');
    }
    public function createBookingEmployee(){
        $data =User::whereHas('employee')->get();
        $aula =Aula::all();
        return view ('admin.create_booking_employee',['data'=>$data],['aula'=>$aula]);

    }
    public function storeBookingEmployee(Request $request){
        Booking::create([
            'user_id'=>$request->name,
            'aula_id' => $request->aula,
            'start' => $request->start,
            'end' => $request->end,
            'keperluan' => $request->keperluan,
            'status' => true,
        ]);
        return redirect()->route('admin.create.booking.employee')->with('success', 'Kegiatan Berhasil di Tambahkan.');
    }
}
