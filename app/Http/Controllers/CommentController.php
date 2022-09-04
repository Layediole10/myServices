<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'content' => 'required|string',
        ]);
        
        $validate['name'] = Auth::user()->name;
        $validate['email'] = Auth::user()->email;
        $validate['content'] = $request->content;
        $validate['article_id'] = $request->article_id;
        // dd($validate);
        Comment::create($validate);
        return back();
    }

    
}
