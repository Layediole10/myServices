<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Article, Comment, Demande, Like};

class WelcomeController extends Controller
{
    public function welcome(){
        $requests = Demande::orderBy('created_at', 'DESC')->simplePaginate(1);
        $articles = Article::orderBy('created_at', 'DESC')->get();
        $comments = Comment::all();
        // dd($requests);
        return view('welcomeActu', [
            'requests'=>$requests,
            'articles'=>$articles,
            'comments'=>$comments,
        ]);
    }

   
}
