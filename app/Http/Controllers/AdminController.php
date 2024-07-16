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
    public function dashboard(){
        return view ('layouts.app');
    }
    public function createUser(){
        $role=Role::all();
        return view ('admin.create_user',['role'=>$role]);
    }
    public function storeUser(Request $request){
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:8|confirmed',
        // ]);

        $role = Role::where('name','employee')->first();
        // $user = new User;
        // $user->role_id = $role->id;
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = bcrypt($request->password);
        // $user->save();

        // $employee = new Employee;
        // $employee->no_ktp = $request->no_ktp;
        // $employee->telp = $request->telp;

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

        return redirect()->route('admin.create.user')->with('success', 'User created successfully.');
    }
}
