<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfessionalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * admin home
     */
    public function index()
    {
        return view('professional.homeprof');
    }
}
