<?php

namespace App\Http\Controllers;

use App\Models\{Article, Comment, Demande, Like};
use Illuminate\Http\Request;

class AdminController extends Controller
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
        return view('admin.dashbord');
    }
    public function actualityAdmin(){

        $requests = Demande::orderBy('created_at', 'DESC')->simplePaginate(1);
        $articles = Article::orderBy('created_at', 'DESC')->get();
        $comments = Comment::all();
        // dd($requests);
        return view('admin.homeAdmin', [
            'requests'=>$requests,
            'articles'=>$articles,
            'comments'=>$comments,
        ]);
        
    }

    public function liker(){

        $articles = Article::find(request()->id);
        if ($articles->isLikedByUser()) {
           $result = Like::where([
                'user_id' => auth()->user()->id,
                'article_id' => request()->id
            ])->delete();
            if ($result) {
                return response()->json([
                    'count' => Article::find(request()->id)->likes->count(),

                ]);
            }
        }else{
           
            $like = new Like();

            $like->user_id = auth()->user()->id;
            $like->article_id = request()->id;

            $like->save();
            return response()->json([
                'count' => Article::find(request()->id)->likes->count(),

            ]);
        }
    }

    public function contact($id){
        
        $article = Article::find($id);
        return view('admin.contactAdmin', ['article'=> $article]);
    }
}
