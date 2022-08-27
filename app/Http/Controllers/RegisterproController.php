<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterproController extends Controller
{
    public function create()
    {
        return view('auth.registerpro');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'contact' => ['required', 'integer'],
            'role' => ['required', 'string'],
        ]);

        $register = $validate;
        $register['name'] = $request->name;
        $register['email'] = $request->email;
        $register['password'] = Hash::make($request->password);
        $register['contact'] = $request->contact;
        $register['role'] = $request->role;

        User::create($register);
        return redirect('/login');
    }
}
