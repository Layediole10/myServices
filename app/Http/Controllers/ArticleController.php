<?php

namespace App\Http\Controllers;

use App\Models\{Region, Department, Municipality, District, Category, Article, Image};
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // if(!$request->session()->has('index')) {
        //     $request->session()->put('index', Str::random(30));
        // }

        $categories = Category::select('title', 'id')->get();
        $regions = Region::select('name', 'id')->oldest('name')->get();
        $departments = Department::select('name', 'id')->oldest('name')->get();
        $municipalities = Municipality::select('name', 'id')->oldest('name')->get();
        $districts = District::select('name', 'id')->oldest('name')->get();

        return view('admin.article.create', [
            'categories'=>$categories, 
            'regions'=>$regions,
            'departments'=>$departments,
            'municipalities'=>$municipalities,
            'districts'=>$districts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
                $imageName = $valid['title'].'-image-'.time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('articleImages'),$imageName);

                $articleCreate = Image::create([
                    'article_id'=>$newArticle->id,
                    'image'=>$imageName
                ]);
            }
        }
        dd($articleCreate);  

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
