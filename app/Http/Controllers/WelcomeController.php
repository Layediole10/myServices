<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Article, Comment, Demande, Like, User};

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

   public function rechercheGeneral(){
        $search = request()->input('q');
        $results = Article::where('title', 'like', "%$search%")->orwhere('content', 'like', "%$search%");
        $resultsUser = User::where('name', 'like', "%$search%")->orwhere('email', 'like', "%$search%")->orwhere('contact', 'like', "%$search%");
        // dd($results);
        return view('rechercheGenerale', [
            'results'=>$results,
            'resultsUser'=>$resultsUser,
            
        ]);
   }
}
