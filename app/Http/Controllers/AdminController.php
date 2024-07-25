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


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index(Request $request){
        $events=[];
        $datas=Booking::with(['aula'])->where('status',true)->get();

        foreach ($datas as $data) {
            $events[]=[
                'title'=>$data->aula->nama,
                'start'=>$data->start,
                'end'=>Carbon::parse($data->end)->addDay(),
            ];
        }
        return view('admin.dashboard', compact('events'));
    }

    public function list(){
        $data=Booking::where('status',true)->get();
        return view ('admin.list_booking',compact('data'));
        // return $data;
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
        $aula =Aula::all();
        return view('admin.create_booking_employee',['aula'=>$aula]);
    }
    public function createEmployee(){
        $role=Role::all();
        return view ('admin.create_employee',['role'=>$role]);
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
}
