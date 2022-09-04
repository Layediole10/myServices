<?php

namespace App\Http\Controllers;

use App\Models\{Article, Comment, Like};
use Illuminate\Http\Request;

class PublishArticleController extends Controller
{
    public function index(){

        $articles = Article::orderBy('created_at', 'DESC')->get();
        $comments = Comment::all();
        
        return view('professional.homePro', [
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


    public function show($id)
    {
        $article = Article::findOrFail($id);
        $comments = Comment::where('article_id', $id)->get();
        return view('admin.comment.commentArticle', [
            'article' => $article,
            'comments' => $comments
        ]); 
        
    }
}
