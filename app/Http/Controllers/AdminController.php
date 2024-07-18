<?php

namespace App\Http\Controllers;
use App\Models\Aula;
use App\Models\Role;
use App\Models\User;
use App\Models\Employee;
use Hash;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index(){
        return view ('admin.dashboard');
    }
    public function createEmployee(){
        $role=Role::all();
        return view ('admin.create_employee',['role'=>$role]);
    }
    public function storeEmployee(Request $request){
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|confirmed',
        //     'nama_bidang'=>'required|string|max:255',
        //     'penanggung_jawab'=>'required|string|max:255',
        // ]);

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

        return redirect()->route('admin.create.employee')->with('success', 'User created successfully.');
    }
}
