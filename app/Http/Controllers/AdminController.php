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
        // return $role;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $role->id,
        ]);

        Employee::create([
            'user_id'=>$user->id,
            'nama_bidang'=>$request->input('nama_bidang'),
            'penanggung_jawab'=>$request->input('penanggung_jawab'),
        ]);
        // $user =new User([
            // 'name' => $request->no_ktp,
            // 'email' => $request->nama,
            // 'password' => Hash::make($request->password),
            // 'role_id'=>$role->id,
        // ]);
        // $user->save();
        // $employee=new Employee([
            // 'user_id'=>$user->id,
            // 'nama_bidang'=>$request->input('nama_bidang'),
            // 'penanggung_jawab'=>$request->input('penanggung_jawab'),
        // ]);
        // $employee->save();


        return redirect()->route('admin.create.user')->with('success', 'User created successfully.');
    }
}
