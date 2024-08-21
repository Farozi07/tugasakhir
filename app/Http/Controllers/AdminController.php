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

use App\Exports\BookingsExport;
use Maatwebsite\Excel\Facades\Excel;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index(Request $request){
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

            $today = Carbon::today(); // Mendapatkan tanggal hari ini
            $bookingsTrueCount = Booking::where('status', true)->count();
            $bookingsFalseCount = Booking::where('status', false)->count();
            $bookingsCancel = Booking::where('cancellation_requested', true)->count();
        $users = User::all();
        $totalUsers = $users->count() - 1;
        return view('admin.dashboard', compact('events','bookingsTrueCount', 'bookingsFalseCount', 'totalUsers','bookingsCancel'));
    }
    public function listBooking(){
        $booking=Booking::where('status',true)

        ->with(['user' => function($g){
            $g->with('guest');
        }])
        ->whereHas('user',function($u){
            $u->whereHas('guest');
        })->where('end', '>=', Carbon::today())
        ->get();
        return view('admin.list_booking',compact('booking'));
    }
    public function listBookingPending(){
        $booking=Booking::where('status',false)->where('end', '>=', Carbon::today())->get();
        return view('admin.list_booking_pending',compact('booking'));
    }
    public function listBookingDelete($id){
        Booking::where('id',$id)->forceDelete();
        return redirect()->back()->with('success','Berhasil Menghapus Booking');
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
        ->where('end', '>=', Carbon::today())
        ->get();
        return view ('admin.list_booking_employee',['data'=>$data]);
    }

    public function createGuest(){
        return view ('admin.create_guest');
    }
    public function storeGuest(Request $request){
        $role = Role::where('name','guest')->first();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
            'no_ktp' => ['required', 'string', 'regex:/^[0-9]{16}$/'],
            'telp' => 'required|string|min:10|max:15',
            'alamat' => 'required|string|max:500',
        ],[
            'name.required' => 'Nama tidak boleh kosong.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',

            'email.required' => 'Email Tidak Boleh Kosong',
            'email.unique' => 'Email Sudah Digunakan',

            'password.required' => 'Password Tidak Boleh Kosong',

            'no_ktp.required' => 'Nomor KTP tidak boleh kosong.',
            'no_ktp.regex' => 'Nomor KTP harus terdiri dari 16 digit angka.',

            'telp.required' => 'Nomor telepon tidak boleh kosong.',
            'telp.min' => 'Nomor telepon minimal 10 karakter.',
            'telp.max' => 'Nomor telepon tidak boleh lebih dari 15 karakter.',

            'alamat.required' => 'Alamat tidak boleh kosong.',
        ]);
        return $request;

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
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'nama_bidang' => 'required|string',
        ],[
            'email' => 'Kolom E-mail belum diisi',
            'email.unique' => 'Email ini sudah digunakan, silakan gunakan email lain.',
            'password.required' => 'Password Tidak Boleh Kosong',
            'name' => 'Kolom nama belum diisi',
            'nama_bidang' => 'Kolom nama bidang belum diisi',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $role->id,
        ]);

        Employee::create([
            'user_id'=>$user->id,
            'nama_bidang'=>$request->nama_bidang,
            'penanggung_jawab'=>$request->name,
        ]);
        return redirect()->route('admin.create.employee')->with('success', 'Employee created successfully.');
    }
    public function createBookingGuest(){
        $aula =Aula::all();
        $data =User::whereHas('guest')->get();
        return view ('admin.create_booking_guest',['data'=>$data],['aula'=>$aula]);
    }
    public function storeBookingGuest(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
            'aula' => 'required|in:1,2,3',
            'keperluan' => 'required'
        ],[
            'name' => 'Nama Tidak Boleh Kosong',
            'start.required' => 'Tanggal Mulai Tidak Boleh Kosong.',
            'end.required' => 'Tanggal Berakhir Tidak Boleh Kosong.',
            'aula.required' => 'Aula Tidak Boleh Kosong.',
            'keperluan.required' => 'Keperluan Tidak Boleh Kosong.',
        ]);

        $start = $validatedData['start'];
        $end = $validatedData['end'];
        $aula_id = $validatedData['aula'];
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
        }
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
        $validatedData = $request->validate([
            'name' => 'required',
            'start' => ['required', 'date', function ($attribute, $value, $fail) {
                if (Carbon::parse($value)->lt(Carbon::today())) {
                    $fail('Tanggal Mulai tidak boleh kurang dari hari ini.');
                }
            }],
            'end' => ['required', 'date', function ($attribute, $value, $fail) {
                if (Carbon::parse($value)->lt(Carbon::today())) {
                    $fail('Tanggal Berakhir tidak boleh kurang dari hari ini.');
                }
            }, 'after_or_equal:start'],
            'aula' => 'required|in:1,2,3',
            'keperluan' => 'required'
        ],[
            'name.required' => 'Nama Tidak Boleh Kosong',
            'start.required' => 'Tanggal Mulai Tidak Boleh Kosong.',
            'end.required' => 'Tanggal Berakhir Tidak Boleh Kosong.',
            'end.after_or_equal' => 'Tanggal Berakhir harus sama dengan atau setelah Tanggal Mulai.',
            'aula.required' => 'Aula Tidak Boleh Kosong.',
            'keperluan.required' => 'Keperluan Tidak Boleh Kosong.',
        ]);

        $start = $validatedData['start'];
        $end = $validatedData['end'];
        $aula_id = $validatedData['aula'];

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
        }

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
    public function deleteBookingEmployee($id){
        Booking::where('id',$id)->forceDelete();
        return redirect()->back()->with('success','Berhasil Menghapus Kegiatan');
    }

    public function daftarAkun(){
        // return $booking;
        $users = User::whereHas('role', function ($query) {
            $query->where('name', '!=', 'admin');
        })->get();
        return view('admin.list_account',compact('users'));
    }
    public function editAkun(Request $request){
        $user=User::where('id',$request->id)->first();
        if ($request->name != $user->name) {
            $user->name = $request->name;
        }
        if ($request->email != $user->email) {
            $user->email = $request->email;
        }
        if (isset($request->password)) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        switch ($user->role->name) {
            case 'guest':
                $guest=Guest::where('user_id',$user->id)->first();
                $guest->no_ktp=$request->no_ktp;
                $guest->telp=$request->telp;
                $guest->alamat=$request->alamat;
                $guest->save();
                break;
            case 'employee':
                $employee=Employee::where('user_id',$user->id)->first();
                $employee->nama_bidang=$request->nama_bidang;
                $employee->penanggung_jawab=$request->name;
                $employee->save();
                break;
            default:
                # code...
                break;
        }
        return redirect()->back()->with('success','Berhasil Mengubah Data');
    }
    public function deleteAkun($id){
        User::where('id',$id)->forceDelete();
        return redirect()->back()->with('success','Berhasil Menghapus Akun');
    }
    public function export(Request $request)
    {

        $year = $request->input('year', date('Y'));
        return Excel::download(new BookingsExport($year), 'Arsip Pemakaian Aula Tahun ' . $year . '.xlsx');
    }
}
