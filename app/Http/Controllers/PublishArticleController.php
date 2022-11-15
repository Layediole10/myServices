<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Region;
use App\Models\Category;
use App\Models\District;
use App\Models\Department;
use App\Models\Municipality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{Article, Comment, Demande, Like};

class PublishArticleController extends Controller
{
    public function index(){

        $requests = Demande::orderBy('created_at', 'DESC')->simplePaginate(1);
        $articles = Article::orderBy('created_at', 'DESC')->get();
        $comments = Comment::orderBy('created_at', 'DESC')->get();
        
        // dd($requests);
        return view('professional.homePro', [
            'requests'=>$requests,
            'articles'=>$articles,
            'comments'=>$comments,
        ]);
        
    }

    public function create()
    {
       
        $categories = Category::select('title', 'id')->get();
        $regions = Region::select('name', 'id')->oldest('name')->get();
        $departments = Department::select('name', 'id')->oldest('name')->get();
        $municipalities = Municipality::select('name', 'id')->oldest('name')->get();
        $districts = District::select('name', 'id')->oldest('name')->get();

        return view('admin.user.userCreateArticle', [
            'categories'=>$categories, 
            'regions'=>$regions,
            'departments'=>$departments,
            'municipalities'=>$municipalities,
            'districts'=>$districts,
        ]);
    }

    public function store(Request $request)
    {

        // dd($request->all());
        $valid = $request->validate([
            'title' => 'required|string|max:50',
            'content' => 'required|string',
            
        ]);

        $article = $valid;
        $article['category_id'] = $request->category;
        $article['region'] = $request->region;
        $article['department'] = $request->department;
        $article['municipality'] = $request->municipality;
        $article['district'] = $request->district;
        $article['publish'] = $request->publish?true:false;
        $article['author_id'] = Auth::user()->id;
        $article['occupation'] = $request->occupation;
        $article['contact'] = $request->contact;
       
        $newArticle = Article::create($article);
        // dd($newArticle);
        if ($request->has('images')) {
            foreach($request->file('images')as $image){
                $imageName = 'image-'.time().rand(1,1000).'.'.$image->getClientOriginalExtension();
                $image->move(public_path('articleImages'),$imageName);

                Image::create([
                    'article_id'=>$newArticle->id,
                    'image'=>$imageName
                ]);
            }
        }
        
        return view('admin.article.confirm');  

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
