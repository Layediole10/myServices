<?php

namespace App\Http\Controllers;

use App\Models\{Region, Department, Municipality, District, Category, Article, Comment, Image, Like};
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $articles = Article::paginate(5);
       
       return view('admin.article.articleList', [
            'articles' => $articles,
       ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
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
                $imageName = 'image-'.time().rand(1,1000).'.'.$image->getClientOriginalExtension();
                $image->move(public_path('articleImages'),$imageName);

                Image::create([
                    'article_id'=>$newArticle->id,
                    'image'=>$imageName
                ]);
            }
        }
        
        return redirect()->route('articles.index')->with('articleCreated', 'Article crée avec succès!');  

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
        $categories = Category::select('title', 'id')->get();
        $regions = Region::select('name', 'id')->oldest('name')->get();
        $departments = Department::select('name', 'id')->oldest('name')->get();
        $municipalities = Municipality::select('name', 'id')->oldest('name')->get();
        $districts = District::select('name', 'id')->oldest('name')->get();
        return view('admin.article.articleEdited', [
            "article"=>$article,
            'categories'=>$categories, 
            'regions'=>$regions,
            'departments'=>$departments,
            'municipalities'=>$municipalities,
            'districts'=>$districts,
        ]);
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
        $valid = $request->validate([
            'title' => 'required|string|max:50',
            'content' => 'required|string',
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        $articleEdited = $valid;
        $articleEdited['category_id'] = $request->category;
        $articleEdited['region'] = $request->region;
        $articleEdited['department'] = $request->department;
        $articleEdited['municipality'] = $request->municipality;
        $articleEdited['district'] = $request->district;
        $articleEdited['publish'] = $request->publish?true:false;
        $articleEdited['author_id'] = Auth::user()->id;
        $articleEdited['occupation'] = $request->occupation;
        $articleEdited['contact'] = $request->contact;
        $article->update($articleEdited);
        // dd($newArticle);
        if ($request->has('images')) {
            foreach($request->file('images')as $image){
                $imageName = 'image-'.time().rand(1,1000).'.'.$image->getClientOriginalExtension();
                $image->move(public_path('articleImages'),$imageName);

                Image::create([
                    'article_id'=>$article->id,
                    'image'=>$imageName
                ]);
            }
        }


        return redirect()->route('articles.index')->with('update', "L'article n° $article->id a été mis à jour avec succès!");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Image::where('article_id', $id)->delete();
        Comment::where('article_id', $id)->delete();
        Like::where('article_id', $id)->delete();
        $article = Article::find($id);
        $article->delete();
        return back()->with('delete', "L'article n° $article->id a été supprimé avec succès!");
    }

    public function publish($id){
        $articlePublish = Article::find($id);
        $articlePublish->publish = !$articlePublish->publish;
        $message = '';
        if ($articlePublish['publish']) {
            $message = "L'article n° $id publié avec succès!";
        }else{
            $message = "L'article n° $id dépublié avec succès!";
        }

        if ($articlePublish->update()) {
            return redirect()->route('articles.index')->with(["message"=>$message]);
        }
            return back()->with("error","La mise à jour de l'article n° $id échouée!")->withInput();;
    }

    public function view($id){
        $article = Article::find($id);
        $images = $article->images;
        return view('admin.article.viewImage', [
            'images' => $images,
            'article' => $article,
        ]);
    }


    public function search(){
        $search = request()->input('q');
        $results = Article::where('title', 'like', "%$search%")->orwhere('content', 'like', "%$search%")->paginate(5);
        return view('admin.article.searchArticle', ['results'=>$results]);
    }
}
