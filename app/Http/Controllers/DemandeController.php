<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Demande;

class DemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|string',
            'budget' => 'required|string',
            'content' => 'required|string',
        ]);

        $validate['author_id'] = Auth::user()->id;
        $validate['municipality'] = $request->municipality;
        $validate['district'] = $request->district;
        $validate['category_id'] = $request->category;
        $validate['date_start'] = $request->date_start;
        $validate['date_end'] = $request->date_end;

        // dd($validate);
        Demande::create($validate);

        return redirect('/home')->with('demande', 'Demande publiée avec succès!');
    }

    public function meContacter($id){
        
        $demande = Demande::find($id);
        return view('professional.meContacter', ['demande'=> $demande]);
    }
}
