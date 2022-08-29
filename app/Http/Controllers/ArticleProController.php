<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{User, Category, Region, Department, Municipality, District};

class ArticleProController extends Controller
{
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
}
