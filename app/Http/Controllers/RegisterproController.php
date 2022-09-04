<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterProController extends Controller
{

    public function index()
    {
        return view('professional.homePro');
    }

    public function create()
    {
        return view('auth.registerPro');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'contact' => 'required|string',
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

    public function edit($id)
    {
        $user = User::find($id);
        return  view('admin.user.professionalEdited', ['user'=>$user]);
    }


    public function update(Request $request, $id)
    {
        if (Auth::user()->id == $id) {
            $user = User::find($id);
            $validate = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255' ],       
                'contact' => 'required|string',
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3000',
            ]);

            // dd($path);
            $register = $validate;
            $register['name'] = $request->name;
            $register['email'] = $request->email;            
            $register['contact'] = $request->contact;
            
            
            if ($request->file('photo')) {
                $photo = $request->file('photo');
                $photoName = time().'.'.$photo->getClientOriginalExtension();
                $photo->move(public_path('profile'), $photoName);
                $path = '/profile/'.$photoName;
                $register['photo'] = $path;
            }
    
            $user->update($register);
        
            if ($user) {
                return redirect('/professional')->with('compteUpdate', 'Votre compte a été bien mis à jour!');
            
             }else{
                 return back()->with("errorRegister","registration failed")->withInput();
                }
        }
    }
}
