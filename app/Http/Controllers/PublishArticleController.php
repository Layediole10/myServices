<?php

namespace App\Http\Controllers;

use App\Models\{Article, User, Image};
use Illuminate\Http\Request;

class PublishArticleController extends Controller
{
    public function index(){

        $articles = Article::orderBy('created_at', 'DESC')->get();
        
        return view('professional.homePro', [
            'articles'=>$articles,
        ]);
        
    }
}
